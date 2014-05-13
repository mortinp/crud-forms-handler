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
    
    public $validate = array(
        'fake_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El alias es obligatorio.'
            )
        ),
        'real_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre real es obligatorio.'
            )
        )
    );
}

?>