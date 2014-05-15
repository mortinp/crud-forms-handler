<?php

App::uses('Travel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class IncomingMailShell extends AppShell {
    
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
                $this->out($t['LocalityThesaurus']['fake_name']);
                
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
        }
        
        if($OK && $closest != null && !empty ($closest)) {
            $this->out(print_r($closest, true));            
            
            if(isset ($closest['locality_id'])) {
                $drivers = $this->DriverLocality->find('all', array('conditions'=>
                    array(
                        'DriverLocality.locality_id'=>$closest['locality_id'],
                        'Driver.active'=>true
                        )
                    ));                
            } else if(isset ($closest['municipalities'])) {
                // TODO: Buscar en todos los municipios de la provincia
                foreach ($closest['municipalities'] as $id => $name) {
                    
                }
                $drivers = array();
                
            } else {
                $OK = false;
            }
            //$this->out(print_r($drivers, true));
            
            
            if($OK) {
                if(count($drivers) > 0) {
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
                    $travel['TravelByEmail']['drivers_sent_count'] = count($drivers);
                    if($this->TravelByEmail->save($travel)) {
                        $travel_id = $this->TravelByEmail->getLastInsertID();
                    } else {
                        $OK = false;
                    }
                } else {
                    $this->out('No se encontraron choferes');
                    $OK = false;
                }
                
                $drivers_sent_count = 0;
                if($OK) {
                    // Enviar a los choferes
                    foreach ($drivers as $d) {
                        $travel['Locality'] = array('id'=>$closest['locality_id'], 'name'=>$closest['name']);
                        
                        if(Configure::read('enqueue_mail')) {
                            ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                                    $d['Driver']['username'],
                                    array('travel' => $travel), 
                                    array(
                                        'template'=>'new_travel_by_email', 
                                        'format'=>'html',
                                        'subject'=>'Nuevo Anuncio de Viaje (#'.$travel_id.' por correo)',
                                        'config'=>'no_responder')
                                    );
                        } else {
                            $Email = new CakeEmail('no_responder');
                            $Email->template('new_travel_by_email')
                            ->viewVars(array('travel' => $travel))
                            ->emailFormat('html')
                            ->to($d['Driver']['username'])
                            ->subject('Nuevo Anuncio de Viaje (#'.$travel_id.' por correo)');
                            try {
                                $Email->send();
                            } catch ( Exception $e ) {
                                if($drivers_sent_count < 1) {
                                    //$this->setErrorMessage('Ocurrió un error enviando el viaje a los choferes. Intenta de nuevo.');
                                    $OK = false;
                                    continue;
                                }
                            }
                        }                        
                        
                        $drivers_sent_count++;
                    }
                }                
            }
            
        } else {
            $OK = false;
        }
        
        $travelText = '('.$origin.' - '.$destination.' : '.$sender.')';
        
        if($OK) {
            CakeLog::write('viaje_por_correo', $travelText.' Mejor coincidencia: '.  $closest['name'].' -> '.(1.0 - $shortest/strlen($closest['name'])).' [ACEPTADO]');
            $datasource->commit();
        } else {
            CakeLog::write('viaje_por_correo', $travelText.' [NO ACEPTADO]');
            
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
                            'subject'=>'Anuncio de Viaje abortado',
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
            
            $datasource->rollback();
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
