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
        $this->Driver->id = $id;
        if (!$this->Driver->exists()) {
            throw new NotFoundException(__('Chofer inválido.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if(strlen($this->request->data['Driver']['password']) == 0) unset ($this->request->data['Driver']['password']);
            
            if ($this->Driver->save($this->request->data)) {
                $this->setInfoMessage('El chofer se guardó exitosamente.');
                return $this->redirect(array('action' => 'index'));
            }
            $this->setErrorMessage('Ocurrió un error salvando el chofer');
        } else {
            $this->request->data = $this->Driver->read(null, $id);
            unset($this->request->data['Driver']['password']);
            
            $this->set('localities', $this->Locality->getAsList());
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