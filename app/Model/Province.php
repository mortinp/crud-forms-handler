<?php
App::uses('AppModel', 'Model');
class Province extends AppModel {
    public $order = 'id';
    
    public $hasMany = array(
        'Locality' => array(
            'fields'=>array('id', 'name')
        )
    );
}

?>