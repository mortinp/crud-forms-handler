<?php
App::uses('AppModel', 'Model');
class DriverTravelByEmail extends AppModel {
    
    public $order = 'Driver.id';
    
    public $useTable = 'drivers_travels_by_email';
    
    public $belongsTo = array(
        'Driver' => array(
            'fields'=>array('id', 'username', 'max_people_count'),
            'counterCache'=>'travel_by_email_count'
        ),
        'TravelByEmail'=>array(
            'fields'=>array('id'),
            'foreignKey'=>'travel_id'
        )       
    );
}

?>