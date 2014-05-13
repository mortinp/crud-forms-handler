<?php
App::uses('AppModel', 'Model');
class Province extends AppModel {
    public $order = 'id';
    
    public $hasMany = array(
        'Locality' => array(
            'fields'=>array('id', 'name')
        )
    );
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre es obligatorio.'
            )
        ) 
    );
}

?>