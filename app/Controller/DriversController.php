<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class DriversController extends AppController {
    
    public $uses = array('Driver', 'Locality', 'DriverLocality');
    
    public function index() {
        $this->Driver->recursive = 1;
        $this->set('drivers', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            
            $this->Driver->create();
            
            $this->request->data['Driver']['role'] = 'driver';
            if ($this->Driver->saveAssociated($this->request->data)) {
                $this->setInfoMessage(__('El chofer se guardó exitosamente.'));
                return $this->redirect(array('action' => 'index'));                
            }
            $this->setErrorMessage(__('Ocurrió un error guardando el chofer.'));
        }
        $this->set('localities', $this->Driver->Locality->getAsList());
    }

    public function edit($id = null) {
        $this->Driver->id = $id;
        if (!$this->Driver->exists()) {
            throw new NotFoundException(__('Chofer inválido.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if(strlen($this->request->data['Driver']['password']) == 0) unset ($this->request->data['Driver']['password']);
            
            if ($this->Driver->saveAll($this->request->data)) {
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
        $this->Driver->id = $id;
        if (!$this->Driver->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->Driver->delete()) {
            $this->setInfoMessage('El chofer se eliminó exitosamente.');
        } else {
            $this->setErrorMessage('Ocurrió un error eliminando el chofer');
        }
        
        return $this->redirect(array('action' => 'index'));
    }
}

?>