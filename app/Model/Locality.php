<?php
App::uses('AppModel', 'Model');
class Locality extends AppModel {
    public $order = 'id';
    
    public $hasAndBelongsToMany = 'Driver';
    
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
}

?>