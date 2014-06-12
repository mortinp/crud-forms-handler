<?php

App::uses('AppController', 'Controller');

class EmailQueuesController extends AppController {
    
    //public $uses = array('EmailQueue');
    
    public function index() {
        $this->set('emails', $this->EmailQueue->find('all'));
    }
}

?>