<?php

class Bonus{
    private $table = 'funcionarios_horas_bonus';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 33;
    }
    public function add(){
        $this->db->idAction = 1;
        $this->db->values = array($this->idFuncionario,$this->bonus,$this->mes,$this->ano);
        $this->db->newContent = array('idFuncionario'=>$this->idFuncionario,'bonus'=>$this->bonus,'mes'=>$this->mes,'ano'=>$this->ano);
        $this->db->sql ="INSERT INTO $this->table (idFuncionario,bonus,mes,ano,`enable`) VALUES (?,?,?,?,1)";
        return $this->db->add();
    }
    public function get(){
        $this->db->values = $this->id;
        $sql ="SELECT * FROM $this->table WHERE id = ?"; 
        $this->db->custom = $sql;
        return $this->db->get();
    }
    public function getByIdFuncionarioMesAno(){
        $this->db->values = array($this->idFuncionario,$this->mes,$this->ano);
        $sql ="SELECT * FROM $this->table WHERE idFuncionario = ? AND mes = ? AND ano = ? AND `enable` = 1"; 
        $this->db->custom = $sql;
        return $this->db->get();
    }
    public function edit(){
        $data = $this->getByIdFuncionarioMesAno();
        $this->db->idAction = 2;
        $this->db->content = array(
                        'idFuncionario'=>$data['data']['idFuncionario']
                        ,'bonus'=>$data['data']['bonus']
                        ,'mes'=>$data['data']['mes']
                        ,'ano'=>$data['data']['ano']
                        ,'id'=>$data['data']['id']
                        );
        $this->db->idRegister = $data['data']['id'];
        $this->db->values = array(                                 
                                $this->bonus
                                ,$this->idFuncionario
                                ,$this->mes
                                ,$this->ano
                            );
        $this->db->sql = "UPDATE $this->table SET                                         
                                        bonus    = ?
                                        WHERE 
                                            idFuncionario  = ? 
                                            AND mes = ? 
                                            AND ano = ? 
                                            AND `enable` = 1 ";
        return $this->db->set();
    }
    public function set(){
        $data = $this->getByIdFuncionarioMesAno();
        if($data['total']){
            return $this->edit();
        } else {
            return $this->add();
        }
    }
    public function disable(){
        $this->db->idAction = 3;
        $this->db->values = $this->id;
        $this->db->idRegister = $this->id;
        $data = $this->get();
        $this->db->content = array('idFuncionario'=>$data['data']['idFuncionario']
                                    ,'bonus'=>$data['data']['bonus']
                                    ,'mes'=>$data['data']['mes']
                                    ,'ano'=>$data['data']['ano']
                                    ,'id'=>$data['data']['id']);
        $this->db->newContent = null;
        $this->db->sql = "UPDATE $this->table SET `enable` = 0 WHERE id = ?";
        return $this->db->set();
    }

}