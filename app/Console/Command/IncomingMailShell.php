<?php

App::uses('Travel', 'Model');
App::uses('CakeEmail', 'Network/Email');

App::uses('ComponentCollection', 'Controller');
App::uses('Controller', 'Controller');
App::uses('TravelLogicComponent', 'Controller/Component');

require_once("PlancakeEmailParser.php");

class IncomingMailShell extends AppShell {   
    
    private $TravelLogic;
    
    private static $MAX_MATCHING_OFFSET = 0.2;
    
    public $uses = array('Locality', 'DriverLocality', 'TravelByEmail', 'User', 'LocalityThesaurus');

    public function main() {
        $this->out('IncomingMail shell reporting.');
    }

    public function process() {
        $sender = $this->args[0];
        $origin = $this->args[1];
        $destination = $this->args[2];
        $description = $this->args[3];
        
        $this->do_process($sender, $origin, $destination, $description);
    }
    
    public function process2() {
        /*CakeLog::write('viaje_por_correo', 'Email Received');
        $this->out('Email Received');*/
        
        $stdin = fopen('php://stdin', 'r');
        $emailParser = new PlancakeEmailParser(stream_get_contents($stdin));
        fclose($stdin);
        
        // TODO: Verificar el formato del to, segun lo que me dijo Manuel
        $target = $emailParser->getTo();        
        $to = $target[0];
        $to = str_replace('<', '', $to);
        $to = str_replace('>', '', $to);
        /*CakeLog::write('viaje_por_correo', 'to: '.$to);
        $this->out('to: '.$to);*/
        
        if($to === 'viajes@yotellevo.ahiteva.net') {
            
            $text = $emailParser->getHeader('From');
            preg_match('#\<(.*?)\>#', $text, $match);
            $sender = $match[1];
            if($sender == null || strlen($sender) == 0) $sender = $text;
            //$sender = $emailParser->getHeader('From');
            /*CakeLog::write('viaje_por_correo', 'sender: '.$sender);
            $this->out('sender: '.$sender);*/
            
            $subject = trim($emailParser->getSubject());
            $subject = str_replace("'", "", $subject);
            $subject = str_replace('"', "", $subject);
            /*CakeLog::write('viaje_por_correo', 'subject: '.$subject);
            $this->out('subject: '.$subject);*/

            // TODO: Verificar que origen y destino se pudieron sacar del asunto
            $parseOK = preg_match('/(?<from>.+)-(?<to>.+)/', $subject, $matches);
            if($parseOK) {
                $origin = trim($matches['from']);
                $destination = trim($matches['to']);
                /*CakeLog::write('viaje_por_correo', 'origin: '.$origin);
                $this->out('origin: '.$origin);
                CakeLog::write('viaje_por_correo', 'destination: '.$destination);
                $this->out('destination: '.$destination);*/

                $description = h($emailParser->getPlainBody()); // h() para escapar los caracteres html
                /*CakeLog::write('viaje_por_correo', 'body: '.$description);
                $this->out('body: '.$description);*/

                /*$now = date("Y-m-d H:i:s");
                $log = fopen('/tmp/email_receiver.log', 'a');
                fprintf($log, "($now) $sender ($origin => $destination)\n");
                fclose($log);*/

                $this->do_process($sender, $origin, $destination, $description);
            } else {
                $this->out('Fail');
                if(Configure::read('enqueue_mail')) {
                    ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                            $sender,
                            array('subject' => $subject), 
                            array(
                                'template'=>'travel_by_email_wrong_subject',
                                'format'=>'html',
                                'subject'=>'Anuncio de Viaje abortado (ORIGEN-DESTINO incorrectos)',
                                'config'=>'no_responder')
                            );

                    //$this->out('email enqueued');
                } else {
                    $Email = new CakeEmail('no_responder');
                    $Email->template('travel_by_email_wrong_subject')
                    ->viewVars(array('subject' => $subject))
                    ->emailFormat('html')
                    ->to($sender)
                    ->subject('Anuncio de Viaje abortado (ORIGEN-DESTINO incorrectos)');
                    try {
                        $Email->send();
                    } catch ( Exception $e ) {
                        // TODO: What to do here?
                    }
                } 
            }
            
        } else if($target === 'info@yotellevo.ahiteva.net') {
            // TODO
        }    
    }
    
    private function do_process($sender, $origin, $destination, $description) {
        $shortest = -1;
        $closest = array();
        $perfectMatch = false;
        
        $localities = $this->Locality->getAsList();
        foreach ($localities as $province => $municipalities) {            
            foreach ($municipalities as $munId=>$munName) {
                
                $result = $this->match($origin, $destination, $munName, $shortest);
                if($result != null && !empty ($result)) {
                    $closest = $result + array('locality_id'=>$munId);                    
                    $shortest = $closest['distance'];
                    
                    if($shortest == 0) {
                        $perfectMatch = true;
                        break;
                    }
                }
            }
            
            if($perfectMatch) break;
        }
        
        if(!$perfectMatch) { // Si no hay match perfecto, ver si hay un mejor matcheo con el tesauro
            $thesaurus = $this->LocalityThesaurus->find('all');
            foreach ($thesaurus as $t) {
                
                $target = $t['LocalityThesaurus']['fake_name'];
                //$this->out($t['LocalityThesaurus']['fake_name']);
                
                $result = $this->match($origin, $destination, $target, $shortest);
                if($result != null && !empty ($result)) {
                    $closest = $result + array('locality_id'=>$t['LocalityThesaurus']['locality_id']);
                    $shortest = $closest['distance'];
                    
                    if($shortest == 0) {
                        $perfectMatch = true;
                        break;
                    }
                }
            }
        }
        
        $datasource = $this->TravelByEmail->getDataSource();
        $datasource->begin();
        $OK = true;
        
        $user = $this->User->findByUsername($sender);
            
        if($user == null || empty ($user)) {
            $user = array('User');
            $user['User']['username'] = $sender;
            $user['User']['password'] = 'email123';// TODO
            $user['User']['role'] = 'regular';
            $user['User']['active'] = true;
            $user['User']['email_confirmed'] = true;
            $user['User']['register_type'] = 'email';
            if($this->User->save($user)) {
                $userId = $this->User->getLastInsertID();
            } else {
                $OK = false;
            }

        } else {
            $userId = $user['User']['id'];
            
            if(!$user['User']['email_confirmed']) {
                
                $user['User']['email_confirmed'] = true;
                $this->User->id = $userId;
                $OK = $this->User->saveField('email_confirmed', '1');
            }
        }
        
        if($OK && $closest != null && !empty ($closest)) {
            $this->out(print_r($closest, true));
            
            $travel = array('TravelByEmail');
            $travel['TravelByEmail']['user_origin'] = $origin;
            $travel['TravelByEmail']['user_destination'] = $destination;
            $travel['TravelByEmail']['description'] = $description;
            $travel['TravelByEmail']['matched'] = $closest['name'];
            $travel['TravelByEmail']['locality_id'] = $closest['locality_id'];
            $travel['TravelByEmail']['where'] = $closest['direction'] == 0? $destination : $origin;
            $travel['TravelByEmail']['direction'] = $closest['direction'];
            $travel['TravelByEmail']['user_id'] = $userId;
            $travel['TravelByEmail']['state'] = Travel::$STATE_CONFIRMED;
            $travel['User'] = $user['User'];
            
            
            $this->TravelLogic =& new TravelLogicComponent(new ComponentCollection());
            $result = $this->TravelLogic->confirmTravel('TravelByEmail', $travel);
            
            $OK = $result['success'];
            
        } else {
            $OK = false;
        }
        
        $travelText = '('.$origin.' - '.$destination.' : '.$sender.')';
        
        if($OK) {
            $datasource->commit();
            CakeLog::write('viaje_por_correo', $travelText.' Mejor coincidencia: '.  $closest['name'].' -> '.(1.0 - $shortest/strlen($closest['name'])).' [ACEPTADO]');
            
            if(Configure::read('enqueue_mail')) {
                ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                        $sender,
                        array('travel' => $travel), 
                        array(
                            'template'=>'travel_by_email_match',
                            'format'=>'html',
                            'subject'=>'Creado Anuncio de Viaje ('.$origin.'-'.$destination.')',
                            'config'=>'no_responder')
                        );
                
                //$this->out('email enqueued');
            } else {
                $Email = new CakeEmail('no_responder');
                $Email->template('travel_by_email_match')
                ->viewVars(array('travel' => $travel))
                ->emailFormat('html')
                ->to($sender)
                ->subject('Creado Anuncio de Viaje ('.$origin.'-'.$destination.')');
                try {
                    $Email->send();
                } catch ( Exception $e ) {
                    // TODO: What to do here?
                }
            }
        } else {
            $datasource->rollback();
            CakeLog::write('viaje_por_correo', $travelText.' [NO ACEPTADO]');
            
            $this->out('Fail');
            if(Configure::read('enqueue_mail')) {
                ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                        $sender,
                        array(
                            'user_origin' => $origin, 
                            'user_destination' => $destination,
                            'localities' =>$localities,
                            'thesaurus' => $thesaurus
                            ), 
                        array(
                            'template'=>'travel_by_email_no_match',
                            'format'=>'html',
                            'subject'=>'Anuncio de Viaje abortado ('.$origin.'-'.$destination.')',
                            'config'=>'no_responder')
                        );
                
                //$this->out('email enqueued');
            } else {
                $Email = new CakeEmail('no_responder');
                $Email->template('travel_by_email_no_match')
                ->viewVars(array(
                    'user_origin' => $origin, 
                    'user_destination' => $destination,
                    'localities' =>$localities,
                    'thesaurus' => $thesaurus
                ))
                ->emailFormat('html')
                ->to($sender)
                ->subject('Anuncio de Viaje abortado');
                try {
                    $Email->send();
                } catch ( Exception $e ) {
                    // TODO: What to do here?
                }
            } 
        }
    }
    
    private function match($origin, $destination, $target, $shortestSoFar) {
        $closest = null;
        
        $levOrigin = levenshtein(strtoupper($target), strtoupper($origin));
        $levDestination = levenshtein(strtoupper($target), strtoupper($destination));

        $percentOrigin = $levOrigin/strlen($target);
        $percentDestination = $levDestination/strlen($target);

        // Calculate only if inside offset
        if($percentOrigin > IncomingMailShell::$MAX_MATCHING_OFFSET && 
           $percentDestination > IncomingMailShell::$MAX_MATCHING_OFFSET) return null;
            
        // Check for an exact match
        if ($levOrigin == 0 || $levDestination == 0) {
            $direction = $levOrigin == 0? 0 : 1;

            // Closest locality (exact match)
            $shortestSoFar = 0;
            $closest = array('name'=>$target, 'direction'=>$direction, 'distance'=>$shortestSoFar);                
            return $closest;
        }

        if ($levOrigin < $shortestSoFar || $shortestSoFar < 0) {
            // set the closest match, and shortest distance
            $shortestSoFar = $levOrigin;
            $closest = array('name'=>$target, 'direction'=>0, 'distance'=>$shortestSoFar);                
        }
        if ($levDestination < $shortestSoFar || $shortestSoFar < 0) {
            // set the closest match, and shortest distance
            $shortestSoFar = $levDestination;
            $closest = array('name'=>$target, 'direction'=>1, 'distance'=>$shortestSoFar);                
        } 
        
        return $closest;
        
    }   
    
}

?>
