<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class TravelsController extends AppController {
    
    public $uses = array('Travel', 'Locality', 'User', 'DriverLocality');
    
    /*public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('add', 'view');
    }*/
    
    public function isAuthorized($user) {
        if (in_array($this->action, array('index', 'add'))) {
            if($this->Auth->user('role') == 'regular') return true;
        }

        if (in_array($this->action, array('edit', 'view', 'confirm', 'delete'))) {
            if(isset ($this->request->params['pass'][0])) {
                $id = $this->request->params['pass'][0];
                if ($this->Travel->isOwnedBy($id, $user['id'])) {
                    return true;
                }
            }
        }   

        return parent::isAuthorized($user);
    }

    public function index() {
        $travels = $this->Travel->find('all', array('conditions' => 
            array('user_id' => $this->Auth->user('id')/*, 'state'=>Travel::$STATE_UNCONFIRMED*/)));
        
        $this->set('travels', $travels);        
        /*if(empty ($travels)) */$this->set('localities', $this->Locality->find('list'));
    }

    public function view($id) {
        $travel = $this->Travel->findById($id);
        
        $this->set('localities', $this->Locality->find('list'));
        $this->set('travel', $travel);
        
        $this->request->data = $travel;
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Travel->create();

            $this->request->data['Travel']['user_id'] = $this->Auth->user('id');
            $this->request->data['Travel']['state'] = Travel::$STATE_DEFAULT;
            if ($this->Travel->save($this->request->data)) {                
                $this->setSuccessMessage('Este viaje ha sido creado exitosamente.');
                
                $id = $this->Travel->getLastInsertID();
                return $this->redirect(array('action' => 'view/' . $id));
            }
            $this->setErrorMessage(__('Error al crear el viaje'));
            $this->set('localities', $this->Locality->find('list'));
            return;
        }
        
        $this->set('localities', $this->Locality->find('list'));
    }
    
    public function confirm($id) {
        $travel = $this->Travel->findById($id);
        
        if($travel != null) {
            $OK = true;
            if(Travel::isConfirmed($travel['Travel']['state'])) {
                $this->setErrorMessage('Este viaje ya ha sido confirmado.');
                $OK = false;
            }
            
            $drivers = $this->DriverLocality->find('all', array('conditions'=>
                            array('DriverLocality.locality_id'=>$travel['Travel']['locality_id'], 
                                'Driver.active'=>true, 
                                'Driver.max_people_count >='=>$travel['Travel']['people_count'])));
            
            $datasource = $this->Travel->getDataSource();
            $datasource->begin();
            
            if (count($drivers) > 0) {
                $travel['Travel']['state'] = Travel::$STATE_CONFIRMED;
                $travel['Travel']['drivers_sent_count'] = count($drivers);
                if(!$this->Travel->save($travel)) {
                    $this->setErrorMessage('Ocurrió un error confirmando el viaje. Intenta de nuevo.');
                    $OK = false;
                }
            } else {
                $this->setErrorMessage('No hay choferes para atender este viaje. Intente confirmarlo más tarde. Ya estamos trabajando para resolver este problema.');
                $OK = false;
            }
            
            if($OK) {
                $belongs_to_admin = $travel['User']['role'] === 'admin';
                
                if(!$belongs_to_admin) {
                    $drivers_sent_count = 0;
                    foreach ($drivers as $d) {
                        $Email = new CakeEmail('yotellevo');
                        $Email->template('new_travel')
                        ->viewVars(array('travel' => $travel))
                        ->emailFormat('html')
                        ->to($d['Driver']['username'])
                        ->subject('Nuevo Anuncio de Viaje');
                        try {
                            $Email->send();
                        } catch ( Exception $e ) {
                            if($drivers_sent_count < 1) {
                                $this->setErrorMessage('Ocurrió un error enviando el viaje a los choferes. Intenta de nuevo.');
                                $OK = false;
                            }
                        }
                        
                        $drivers_sent_count++;
                    }
                }
            }
            
            if($OK) $datasource->commit();
            else $datasource->rollback();
            
            // Always send an email to me ;)
            $Email = new CakeEmail('yotellevo');
            $Email->template('new_travel')
            ->viewVars(array('travel'=>$travel, 'admin'=>array('drivers'=>$drivers, 'notified_count'=>$drivers_sent_count)))
            ->emailFormat('html')
            ->to('mproenza@grm.desoft.cu')
            ->subject('Nuevo Anuncio de Viaje');
            try {
                $Email->send();
            } catch ( Exception $e ) {
                // TODO: Should I do something here???
            }
            
            return $this->redirect(array('action'=>'view/'.$travel['Travel']['id']));
        }
        
    }

    public function edit($tId) {
        //TODO: Validate paramters
        
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $travel = $this->data;
        } else if ($this->request->is('post') || $this->request->is('put')) {
            $travel = $this->request->data;
        }

        $editing = $this->request->is('ajax') || $this->request->is('post') || $this->request->is('put');
        if($editing) {
            if ($this->Travel->save($travel)) {
                if($this->request->is('ajax')) {
                    echo json_encode(array('object'=>$travel['Travel']));
                    return;
                }
                return $this->redirect(array('action' => 'index'));
            }
            $this->setErrorMessage(__('Ocurrió un error guardando los datos de este viaje. Intenta de nuevo.'));
        }
        
        $travel = $this->Travel->findById($tId);
        if (!$this->request->data) {
            $this->request->data['Travel'] = $travel['Travel'];
        }
    }

    public function delete($tId) {
        if ($this->Travel->delete($tId)) {
            return $this->redirect(array('action' => 'index'));
        }
        $this->setErrorMessage(__('Ocurrió un error eliminando el viaje. Intenta de nuevo.'));
    }
}

?>