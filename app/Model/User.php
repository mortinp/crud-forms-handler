<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $order = 'id';

    public $validate = array(
        'username' => array(
            'email' => array(
                'rule' => array('notEmpty'),
                'message' => 'El correo electrónico es obligatorio',
                'required' => true
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La contraseña es obligatoria'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'driver', 'regular')),
                'message' => 'Por favor, entre un rol válido',
                'allowEmpty' => false
            )
        ),
        
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    public function loginExists($email) {
        return $this->find('first', array('conditions'=>array('username'=>$email))) != null;
    }
}

?>