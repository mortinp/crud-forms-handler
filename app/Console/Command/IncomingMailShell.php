<?php

App::uses('Travel', 'Model');

class IncomingMailShell extends AppShell {
    
    private static $MAX_MATCHING_THRESHOLD = 0.2;
    
    public $uses = array('Locality', 'DriverLocality', 'TravelByEmail', 'User');

    public function main() {
        $this->out('IncomingMail shell reporting.');
    }

    public function process() {
        $localities = $this->Locality->getAsList();
        
        $sender = $this->args[0];
        $origin = $this->args[1];
        $destination = $this->args[2];
        $description = $this->args[3];
        
        $shortest = -1;
        $closest = array();
        foreach ($localities as $province => $municipalities) {
            $perfectMatch = false;
            foreach ($municipalities as $munId=>$munName) {
                
                $levOrigin = levenshtein(strtoupper($munName), strtoupper($origin));
                $levDestination = levenshtein(strtoupper($munName), strtoupper($destination));
                
                $percentOrigin = $levOrigin/strlen($munName);
                $percentDestination = $levDestination/strlen($munName);
                /*$this->out($munName.' vs '.$origin.': '.$percentOrigin);
                $this->out($munName.' vs '.$destination.': '.$percentDestination);*/

                // Skip if over threshold
                if($percentOrigin > IncomingMailShell::$MAX_MATCHING_THRESHOLD && 
                   $percentDestination > IncomingMailShell::$MAX_MATCHING_THRESHOLD) continue;
                
                // Check for an exact match
                if ($levOrigin == 0 || $levDestination == 0) {
                    $direction = $levOrigin == 0? 0 : 1;
                    
                    // Closest locality (exact match)
                    $closest = array('id'=>$munId, 'name'=>$munName, 'direction'=>$direction);
                    $shortest = 0;
                    $perfectMatch = true;
                    break;
                }
                
                if ($levOrigin <= $shortest || $shortest < 0) {
                    // set the closest match, and shortest distance
                    $closest = array('id'=>$munId, 'name'=>$munName, 'direction'=>0);
                    $shortest = $levOrigin;
                }
                if ($levDestination <= $shortest || $shortest < 0) {
                    // set the closest match, and shortest distance
                    $closest = array('id'=>$munId, 'name'=>$munName, 'direction'=>1);
                    $shortest = $levDestination;
                } 
            }
            
            if($perfectMatch) break;
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
            if($this->User->save($user)) {
                $userId = $this->User->getLastInsertID();
            } else {
                $OK = false;
            }

        } else {
            $userId = $user['User']['id'];
        }
        
        if($OK && !empty ($closest)) {
            //$this->out(print_r($closest, true));
            
            $drivers = $this->DriverLocality->find('all', array('conditions'=>
                array(
                    'DriverLocality.locality_id'=>$closest['id'],
                    'Driver.active'=>true
                    )
                ));
            //$this->out(print_r($drivers, true));
            
            if($OK) {
                if(count($drivers) > 0) {
                    $travel = array('TravelByEmail');
                    $travel['TravelByEmail']['locality_id'] = $closest['id'];
                    $travel['TravelByEmail']['where'] = $closest['direction'] == 0? $destination : $origin;
                    $travel['TravelByEmail']['direction'] = $closest['direction'];
                    $travel['TravelByEmail']['description'] = $description;
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
                        $travel['Locality'] = array('id'=>$closest['id'], 'name'=>$closest['name']);
                        
                        if(Configure::read('enqueue_mail')) {
                            ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                                    $d['Driver']['username'],
                                    array('travel' => $travel), 
                                    array(
                                        'template'=>'new_travel_by_email', 
                                        'format'=>'html',
                                        'subject'=>'Nuevo Anuncio de Viaje (#'.$travel_id.' por correo)',
                                        'config'=>'yotellevo'));
                        } else {
                            $Email = new CakeEmail('yotellevo');
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
        
        if($OK) {
            $datasource->commit();
        } else {
            $datasource->rollback();
        }
    }
}

?>
