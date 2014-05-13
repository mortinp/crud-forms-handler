<?php

App::uses('AppController', 'Controller');

class LocalityThesaurusController extends AppController {
    
    public $uses = array('LocalityThesaurus', 'Locality');
    
    public function index() {
        $this->LocalityThesaurus->recursive = 0;
        $this->set('thesaurus', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {            
            $this->LocalityThesaurus->create();
            if ($this->LocalityThesaurus->save($this->request->data)) {
                //Cache::delete('localities');
                
                $this->setInfoMessage(__('La entrada se guardó exitosamente.'));
                return $this->redirect(array('action' => 'index'));                
            }
            $this->setErrorMessage(__('Ocurrió un error guardando la entrada.'));
        }
        $this->set('localities', $this->Locality->getAsList());
    }

    public function edit($id = null) {
        $this->LocalityThesaurus->id = $id;
        if (!$this->LocalityThesaurus->exists()) {
            throw new NotFoundException(__('Entrada inválida.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if ($this->LocalityThesaurus->save($this->request->data)) {
                //Cache::delete('localities');
                
                $this->setInfoMessage('La entrada se guardó exitosamente.');
                return $this->redirect(array('action' => 'index'));
            }
            $this->setErrorMessage('Ocurrió un error salvando la entrada');
        } else {
            $this->set('localities', $this->Locality->getAsList());
            $this->request->data = $this->LocalityThesaurus->read(null, $id);
        }
    }

    public function remove($id = null) {
        $this->LocalityThesaurus->id = $id;
        if (!$this->LocalityThesaurus->exists()) {
            throw new NotFoundException(__('Entrada inválida'));
        }
        if ($this->LocalityThesaurus->delete()) {
            //Cache::delete('localities');
            
            $this->setInfoMessage('La entrada se eliminó exitosamente.');
        } else {
            $this->setErrorMessage(__('Ocurió un error eliminando la entrada'));
        }    
        return $this->redirect(array('action' => 'index'));
    }
}

?>