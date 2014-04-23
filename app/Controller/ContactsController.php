<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ContactsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('contact');
    }
    
    public function isAuthorized($user) {
        if (in_array($this->action, array('contact'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function contact() {
        if ($this->request->is('post')) { 
            
            $OK = true;
            
            if($this->Auth->loggedIn()) $this->request->data['Contact']['email'] = AuthComponent::user('username');
                        
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
                $OK = false;
            }
            
            if($OK) $this->setInfoMessage('Ya recibimos tu mensaje.');
            
            return $this->redirect(array('controller'=>'pages', 'action'=>'contact'));
        }
    }
}

?>