<?php

class Automoveis
{
    private $table = 'carros';
    private $db;

    public function __construct(){
        $this->db = new Db('sigma-gas24h');
        $this->db->idModule = 16;
    }
    public function add(){
        $this->db->idAction = 1;
        $this->db->values = array($this->placa,$this->renavam,$this->chassi,$this->marca,$this->modelo,$this->ano);
        $this->db->newContent = array(
                                       'placa'=>$this->placa
                                      ,'renavam'=>$this->renavam
                                      ,'chassi'=>$this->chassi
                                      ,'marca'=>$this->marca
                                      ,'modelo'=>$this->modelo
                                      ,'ano'=>$this->ano                                      
                                    );
        $this->db->sql ="INSERT INTO $this->table 
            (
            placa
            ,renavam
            ,chassi
            ,marca
            ,modelo
            ,ano
            ,`enable`            
            ) 
            VALUES (
                 ?
                ,?
                ,?
                ,?
                ,?
                ,?
                ,1
                ) ";
            return $this->db->add();        
    }
    public function getPages(){
        $select = "SELECT 
                        *
                                                FROM $this->table ";
        $selectCount = "SELECT COUNT(1) AS qtd  FROM $this->table ";

        $this->fieldSort = ($this->fieldSort != "") ? $this->fieldSort : 'id' ;
        $this->sort = ($this->sort != "") ? $this->sort : 'DESC' ;
        
        $where =" WHERE `enable` = 1 ";
        if ($this->search != "") {
            $where .= " AND (placa LIKE '%$this->search%')  
            OR (renavam LIKE '%$this->search%') 
            OR (chassi LIKE '%$this->search%') 
            OR (marca LIKE '%$this->search%') 
            OR (modelo LIKE '%$this->search%') 
            OR (ano LIKE '%$this->search%') 
            ";    
        } else {
            $where .= ' ';
        }        
        $group = " ";
        $order = " ORDER BY ".$this->fieldSort." ".$this->sort;

        $this->db->sql = $select.$where.$group.$order;
        $this->db->sqlCount = $selectCount.$where.$group;
        $this->db->group = false;
        $this->db->show = $this->show;
        $this->db->page = $this->page;
        return $this->db->pages();        
    }
    public function get(){
        $this->db->values = $this->id;
        $this->db->custom ="SELECT * FROM $this->table WHERE id = ?";
        return $this->db->get();
    }         
    public function set(){
        $data = $this->get();
        
        $this->db->idAction = 2;
        $this->db->content = array(
                            'Placa'=>$this->placa
                            ,'Renavam'=>$this->renavam
                            ,'Chassi'=>$this->chassi
                            ,'Marca'=>$this->marca
                            ,'Modelo'=>$this->modelo
                            ,'Ano'=>$this->ano
                            ,'id'=>$this->id
                        );
        $this->db->idRegister = $this->id;
        $this->db->values = array($this->placa,$this->renavam,$this->chassi,$this->marca,$this->modelo,$this->ano,$this->id);
        $this->db->sql = "UPDATE $this->table SET 
                                        placa = ?
                                        , renavam = ?
                                        , chassi = ?
                                        , marca = ?
                                        , modelo = ?
                                        , ano = ?
                                         WHERE id = ?";
        return $this->db->set();
    }
    public function disable(){
        $this->db->idAction = 3;
        $this->db->values = $this->id;
        $this->db->idRegister = $this->id;
        $data = $this->get();
        $this->db->content = array('placa'=>$data['data']['placa'],'id'=>$this->id);
        $this->db->newContent = null;
        $this->db->sql = "UPDATE $this->table SET `enable` = 0 WHERE id = ?";
        return $this->db->set();     
    }
}