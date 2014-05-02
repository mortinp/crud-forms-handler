<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class DriversController extends AppController {

    public function add() {
        if ($this->request->is('post')) {
            $this->Driver->create();
            
            $this->request->data['Driver']['role'] = 'driver';
            $this->request->data['Driver']['active'] = false;
            if ($this->Driver->save($this->request->data)) {
                $this->Session->setFlash(__('El chofer se guardó exitosamente.'));
                return $this->redirect(array('controller'=>'travels','action' => 'index'));
            }
            $this->Session->setFlash(__('Ocurrió un error guardando el chofer.'));
        }
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