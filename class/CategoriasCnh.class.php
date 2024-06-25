<?php

class CategoriasCnh{
    private $table = 'categorias_cnh';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
    }
    public function getAll(){
        $this->db->sql = "SELECT A.* FROM $this->table AS A";
        return $this->db->getAll();
    }
}
