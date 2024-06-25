<?php
class Actions {
    private $table = 'actions';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 25;
    }
    public function getAll(){
        $this->db->sql = "SELECT * FROM $this->table ORDER BY `action`";
        return $this->db->getAll();
    }
}
?>