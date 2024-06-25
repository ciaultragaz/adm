<?php
class Alerts {
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
    }
    public function getAll(){
        $this->db->sql = "SELECT * FROM $this->table ORDER BY `action`";
        return $this->db->getAll();
    }
}
?>