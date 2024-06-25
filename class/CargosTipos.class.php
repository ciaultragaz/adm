<?php

class CargosTipos {
    private $table = 'cargos_itens_tipos';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 35;
    }
    public function get(){
        $this->db->sql = "SELECT *
                            FROM $this->table AS A 
                            ORDER BY ordem";
        return $this->db->getAll();
    }
}