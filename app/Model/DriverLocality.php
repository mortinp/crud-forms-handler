<?php
App::uses('AppModel', 'Model');
class DriverLocality extends AppModel {
    
    public $order = 'Driver.id';
    
    public $belongsTo = array(
        'Driver' => array(
            'fields'=>array('id', 'username', 'max_people_count')
        )        
    );
}

?>