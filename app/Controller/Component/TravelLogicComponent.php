<?php

App::uses('Component', 'Controller');

class TravelLogicComponent extends Component {
    
    public function confirmTravel($modelType /*Travel or TravelByEmail*/, $travel) {
        $OK = true;
        $errorMessage = '';
        if($travel != null) {
            
            $this->DriverLocality = ClassRegistry::init('DriverLocality');
            $this->DriverTravel = ClassRegistry::init('Driver'.$modelType);
            $this->Travel = ClassRegistry::init($modelType);
            
            $drivers_conditions = array(
                'DriverLocality.locality_id'=>$travel[$modelType]['locality_id'], 
                'Driver.active'=>true);
            if(isset ($travel[$modelType]['people_count'])) $drivers_conditions['Driver.max_people_count >='] = $travel[$modelType]['people_count'];
            if(isset ($travel[$modelType]['need_modern_car']) && $travel[$modelType]['need_modern_car']) $drivers_conditions['Driver.has_modern_car'] = true;
            if(isset ($travel[$modelType]['need_air_conditioner']) && $travel[$modelType]['need_air_conditioner']) $drivers_conditions['Driver.has_air_conditioner'] = true;

            $drivers = $this->DriverLocality->find('all', array(
                'conditions'=>$drivers_conditions, 
                'order'=>'Driver.'.Inflector::underscore($modelType).'_count ASC',
                'limit'=>3));
            
            if (count($drivers) > 0) {
                $travel[$modelType]['state'] = Travel::$STATE_CONFIRMED;
                $travel[$modelType]['drivers_sent_count'] = count($drivers);
                if($this->Travel->save($travel)) {
                    if(!isset ($travel[$modelType]['id'])) $travel[$modelType]['id'] = $this->Travel->getLastInsertID();
                } else {
                    $errorMessage = 'Ocurrió un error confirmando el viaje. Intenta de nuevo.';
                    $OK = false;
                }
            } else {
                $errorMessage = 'No hay choferes para atender este viaje. Intente confirmarlo más tarde. Ya estamos trabajando para resolver este problema.';
                $OK = false;
            }
            
            $drivers_sent_count = 0;
            
            if($OK) {
                $send_to_drivers = $travel['User']['role'] === 'regular';
                if($send_to_drivers) {
                    
                    foreach ($drivers as $d) {
                        if(Configure::read('enqueue_mail')) {
                            ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                                    $d['Driver']['username'], 
                                    array('travel' => $travel), 
                                    array(
                                        'template'=>'new_travel', 
                                        'format'=>'html',
                                        'subject'=>'Nuevo Anuncio de Viaje (#'.$travel[$modelType]['id'].')',
                                        'config'=>'no_responder'));
                        } else {
                            $Email = new CakeEmail('no_responder');
                            $Email->template('new_travel')
                            ->viewVars(array('travel' => $travel))
                            ->emailFormat('html')
                            ->to($d['Driver']['username'])
                            ->subject('Nuevo Anuncio de Viaje (#'.$travel[$modelType]['id'].')');
                            try {
                                $Email->send();
                            } catch ( Exception $e ) {
                                if($drivers_sent_count < 1) {
                                    //$this->setErrorMessage('Ocurrió un error enviando el viaje a los choferes. Intenta de nuevo.');
                                    $errorMessage = 'Ocurrió un error enviando el viaje a los choferes. Intenta de nuevo.';
                                    $OK = false;
                                    continue;
                                }
                            }
                        }                        
                        
                        if($OK) {
                            $drivers_sent_count++;
                            $this->DriverTravel->create();
                            $this->DriverTravel->save(array('Driver'.$modelType=>array('driver_id'=>$d['Driver']['id'], 'travel_id'=>$travel[$modelType]['id'])));
                        }
                    }
                }
            }
            
            // Always send an email to me ;) 
            if(Configure::read('enqueue_mail')) {
                ClassRegistry::init('EmailQueue.EmailQueue')->enqueue(
                        'mproenza@grm.desoft.cu',
                        array('travel'=>$travel, 'admin'=>array('drivers'=>$drivers, 'notified_count'=>$drivers_sent_count), 'creator_role'=>$travel['User']['role']), 
                        array(
                            'template'=>'new_travel', 
                            'format'=>'html',
                            'subject'=>'Nuevo Anuncio de Viaje (#'.$travel[$modelType]['id'].')',
                            'config'=>'no_responder'));
            } else {
                $Email = new CakeEmail('no_responder');
                $Email->template('new_travel')
                ->viewVars(array('travel'=>$travel, 'admin'=>array('drivers'=>$drivers, 'notified_count'=>$drivers_sent_count), 'creator_role'=>$travel['User']['role']))
                ->emailFormat('html')
                ->to('mproenza@grm.desoft.cu')
                ->subject('Nuevo Anuncio de Viaje (#'.$travel[$modelType]['id'].')');
                try {
                    $Email->send();
                } catch ( Exception $e ) {
                    // TODO: Should I do something here???
                }
            }
            
            //return $this->redirect(array('action'=>'view/'.$travel[$modelType]['id']));
        }
        
        
        return array('success'=>$OK, 'message'=>$errorMessage);
    }
}
?>
