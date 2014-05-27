<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('User', 'Model');
App::uses('Travel', 'Model');

class TravelsController extends AppController {
    
    public $uses = array('Travel', 'TravelByEmail', 'PendingTravel', 'Locality', 'User', 'DriverLocality', 'Province');
    
    public $components = array('TravelLogic');
    
    public function beforeFilter() {
        parent::beforeFilter();
        if(!$this->Auth->loggedIn()) $this->Auth->allow('add_pending', 'view_pending', 'edit_pending');
    }
    
    public function isAuthorized($user) {
        if ($this->action ==='index') {
            if($this->Auth->user('role') === 'regular' || $this->Auth->user('role') === 'tester') return true;
        }
        
        if ($this->action === 'add') {
            if(($this->Auth->user('role') === 'regular' || $this->Auth->user('role') === 'tester') && User::canCreateTravel()) return true;
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
        
        $travels_by_email = $this->TravelByEmail->find('all', array('conditions' => 
            array('user_id' => $this->Auth->user('id')/*, 'state'=>Travel::$STATE_UNCONFIRMED*/)));
        
        $this->set('travels', $travels); 
        $this->set('travels_by_email', $travels_by_email); 
        
        $this->set('localities', $this->Locality->getAsList());
    }

    public function view($id) {
        $travel = $this->Travel->findById($id);
        
        $this->set('localities', $this->Locality->getAsList());
        $this->set('travel', $travel);
        
        $this->request->data = $travel;
    }
    
    public function view_pending($id) {
        $travel = $this->PendingTravel->findById($id);
        $travel['PendingTravel']['state'] = Travel::$STATE_PENDING;
        
        $this->set('localities', $this->Locality->getAsList());
        $this->set('travel', $travel);
        
        $this->request->data = $travel;
    }

    public function add() {
        if ($this->request->is('post')) {            
            $this->Travel->create();

            $this->request->data['Travel']['user_id'] = $this->Auth->user('id');
            $this->request->data['Travel']['state'] = Travel::$STATE_DEFAULT;
            $this->request->data['Travel']['created_from_ip'] = $this->request->clientIp();
            if ($this->Travel->save($this->request->data)) {
                //$this->setSuccessMessage('Este viaje ha sido creado exitosamente.');
                
                $id = $this->Travel->getLastInsertID();
                return $this->redirect(array('action' => 'view/' . $id));
            }
            $this->setErrorMessage(__('Error al crear el viaje'));
            $this->set('localities', $this->Locality->getAsList());
            return;
        }
        
        $this->set('localities', $this->Locality->getAsList());
    }
    
    public function add_pending() {
        if ($this->request->is('post')) {            
            $this->PendingTravel->create();

            $this->request->data['PendingTravel']['created_from_ip'] = $this->request->clientIp();
            if ($this->PendingTravel->save($this->request->data)) {
                //$this->setSuccessMessage('Este viaje ha sido creado exitosamente.');
                
                $id = $this->PendingTravel->getLastInsertID();
                return $this->redirect(array('action' => 'view_pending/' . $id));
            }
            $this->setErrorMessage(__('Error al crear el viaje'));
            $this->set('localities', $this->Locality->getAsList());
            return;
        }
        
        $this->set('localities', $this->Locality->getAsList());
    }
    
    public function confirm($id) {
        $travel = $this->Travel->findById($id);
        
        $OK = true;
        
        if($travel != null && Travel::isConfirmed($travel['Travel']['state'])) {
            $this->setErrorMessage('Este viaje ya ha sido confirmado.');
            $OK = false;
        }
        
        if($OK) {
            $datasource = $this->Travel->getDataSource();
            $datasource->begin();
            
            $result = $this->TravelLogic->confirmTravel('Travel', $travel);

            if($result['success']) $datasource->commit();
            else {
                $datasource->rollback();
                $this->setErrorMessage($result['message']);
            }
        }   
        
        return $this->redirect(array('action'=>'view/'.$travel['Travel']['id']));
        
    }

    public function edit($tId) {        
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
    
    public function edit_pending($tId) {        
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $travel = $this->data;
        } else if ($this->request->is('post') || $this->request->is('put')) {
            $travel = $this->request->data;
        }

        $editing = $this->request->is('ajax') || $this->request->is('post') || $this->request->is('put');
        if($editing) {            
            if ($this->PendingTravel->save($travel)) {
                if($this->request->is('ajax')) {
                    echo json_encode(array('object'=>$travel['PendingTravel']));
                    return;
                }
                return $this->redirect(array('action' => 'index'));
            }
            $this->setErrorMessage(__('Ocurrió un error guardando los datos de este viaje. Intenta de nuevo.'));
        }
        
        $travel = $this->PendingTravel->findById($tId);
        if (!$this->request->data) {
            $this->request->data['PendingTravel'] = $travel['PendingTravel'];
        }
    }

    public function delete($tId) {
        $travel = $this->Travel->findById($tId);
        if($travel != null) {
            if($travel['Travel']['state'] == Travel::$STATE_UNCONFIRMED || AuthComponent::user('role') === 'admin') {
                if ($this->Travel->delete($tId)) {
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->setErrorMessage(__('Ocurrió un error eliminando el viaje. Intenta de nuevo.'));
                }
            } else {
                $this->setErrorMessage(__('Este viaje no se puede eliminar porque ya está confirmado.'));
            }            
        } else {
            $this->setErrorMessage(__('Este viaje no existe.'));
        }
        
        $this->redirect($this->referer());
    }
}

?>