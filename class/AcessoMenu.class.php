<?php

class AcessoMenu{
    private $table = 'user_menu';
    private $db;
    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 13;
    }
    public function add(){

        $data = $this->getByIdUser();
        if($data['total']){
            $this->delete();
        }
        $this->db->idAction = 1;
        $this->db->values = array($this->idUsuario,$this->idsMenu);
        $this->db->newContent = array('idUsuario'=>$this->idUsuario,'idsMenu'=>$this->idsMenu);
        $this->db->sql ="INSERT INTO $this->table
            (
            idUser,idMenu
            ) 
            VALUES
            (
            ? , ?
            )";
            return $this->db->add();
    }
    public function getByIdUser(){
        $this->db->values = $this->idUsuario;
        $sql ="SELECT * FROM $this->table WHERE idUser = ?";
        $this->db->custom = $sql;
        return $this->db->get();
    }
    public function delete(){
        $this->db->sql = "DELETE FROM $this->table WHERE idUser = ?";
        $dbReturn = $this->db->set(); 
    }
}