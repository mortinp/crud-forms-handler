<?php
App::uses('AppModel', 'Model');
class TravelByEmail extends AppModel {
    
    public $travelType = 'por correo';
    
    public $useTable = 'travels_by_email';
    
    public $belongsTo = array(
        'User' => array(
            'fields'=>array('id', 'username', 'role'),
            'counterCache'=>true
        )
    );
    
}

?>