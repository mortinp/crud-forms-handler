<?php
App::uses('AppModel', 'Model');
class LocalityThesaurus extends AppModel {
    
    public $useTable = 'localities_thesaurus';
    
    public $order = 'LocalityThesaurus.id';
    
    public $belongsTo = array(
        'Locality' => array(
            'fields'=>array('id', 'name')
        )
    );
}

?>