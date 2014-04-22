<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ContactsController extends AppController {
    
    public function isAuthorized($user) {
        if (in_array($this->action, array('contact'))) {
            return true;
        } 

        return parent::isAuthorized($user);
    }

    public function contact() {
        if ($this->request->is('post')) {            
                        
            $Email = new CakeEmail('yotellevo');
            $Email->template('contact')
            ->viewVars(array('contact'=>$this->request->data))
            ->emailFormat('html')
            ->to('mproenza@grm.desoft.cu')
            ->subject('Nuevo Contacto');
            try {
                $Email->send();
            } catch ( Exception $e ) {
                $this->setErrorMessage('Ocurrió un error recibiendo tu mensaje. Intenta de nuevo.');
            }
            $this->setInfoMessage('Mensaje recibido.');
            return $this->redirect(array('controller'=>'pages', 'action'=>'contact'));
        }
    }
}

?>