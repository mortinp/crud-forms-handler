<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class DriversController extends AppController {
    
    public $uses = array('Driver', 'Locality', 'DriverLocality');
    
    public function index() {
        $this->Driver->recursive = 0;
        $this->set('drivers', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Driver->create();
            
            $datasource = $this->Driver->getDataSource();
            $datasource->begin();
            
            $OK = true;
            $this->request->data['Driver']['role'] = 'driver';
            if ($this->Driver->save($this->request->data)) {
                
                $driverId = $this->Driver->getLastInsertID();
                
                $localities = $this->request->data['Driver']['localities'];
                $bindings = array();
                foreach ($localities as $l) {
                    $bindings[] = array('DriverLocality' => array('driver_id'=>$driverId, 'locality_id'=>$l));                    
                }
                if(!$this->DriverLocality->saveAll($bindings)) {
                    $OK = false; break;
                }
                
                if($OK) {
                    $datasource->commit();
                    $this->setInfoMessage(__('El chofer se guardó exitosamente.'));
                    return $this->redirect(array('action' => 'index'));
                }
                
            }
            $datasource->rollback();
            $this->setErrorMessage(__('Ocurrió un error guardando el chofer.'));
        }
        $this->set('localities', $this->Locality->getAsList());
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function remove($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}

?>