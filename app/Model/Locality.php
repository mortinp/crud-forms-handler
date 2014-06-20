<?php
App::uses('AppModel', 'Model');
App::uses('LocalityThesaurus', 'Model');

class Locality extends AppModel {
    
    public $order = 'Locality.id';
    
    public $hasAndBelongsToMany = 'Driver';
    
    public $belongsTo = array(
        'Province' => array(
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
    
    public function getAsList() {
        // 1
        /*$localities = $this->find('list')*/;        
        
        // 2
        /*$this->Province->Behaviors->load('Containable');
        $provinces = $this->Province->find('all', array('contain' => array('Locality')));
        $localities = array();
        foreach ($provinces as $p) {
            foreach ($p['Locality'] as $l) {
              $localities[$p['Province']['name']][$l['id']] = $l['name'];
            }
        }*/
        
        /*// 3
        $localities = $this->find('list', array(
            "fields" => array("Locality.id", "Locality.name", "Province.name"),
            "joins" => array(
                array(
                    "table" => "provinces",
                    "alias" => "Province",
                    "type" => "INNER",
                    "conditions" => array("Province.id = Locality.province_id")
                )
            ),
            //"order" => array() // whatever ordering you want
        ));*/
        
        $localities = Cache::read('localities');
        if (!$localities) {
            $localities = $this->find('list', array(
                "fields" => array("Locality.id", "Locality.name", "Province.name"),
                "joins" => array(
                    array(
                        "table" => "provinces",
                        "alias" => "Province",
                        "type" => "INNER",
                        "conditions" => array("Province.id = Locality.province_id")
                    )
                )
            ));
            Cache::write('localities', $localities);
        }
        
        return $localities;
    }
    
    public function getAsSuggestions() {
        $list = Cache::read('localities_suggestion');
        if (!$list) {
            $localities = $this->find('all');
            $list = array();
            foreach ($localities as $l) {
                $list[] = $l['Locality'];
            }
            $thesaurusModel = new LocalityThesaurus();
            $thes = $thesaurusModel->find('all', array('conditions'=>array('use_as_hint'=>true)));
            foreach ($thes as $t) {
                $list[] = array('id'=>$t['LocalityThesaurus']['id'], 'name'=>$t['LocalityThesaurus']['fake_name']);
            }
            Cache::write('localities_suggestion', $list);
        }        
        return $list;
    }
}

?>