<?php

class Cargos{
    private $table = 'cargos';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 1;
    }
    public function add(){
        $d = $this->getByCargo();
        if(!$d['total']){
            $this->db->idAction = 1;
            $this->db->values = array($this->cargo,$this->salario);
            $this->db->newContent = array('cargo'=>$this->cargo,'salario'=>$this->salario);
            $this->db->sql ="INSERT INTO $this->table (cargo,salario,`enable`) VALUES (?,?,1)";
            return $this->db->add();
        } else {
            return array("error"=>false,"data"=>true,"msg"=>"O resgitro já existe !");
        }        
    }
    public function delete(){
        $this->db->idAction = 3;
        $this->db->values = $this->id;
        $this->db->idRegister = $this->id;
        $data = $this->getById();
        $this->db->content = array('cargo'=>$data['data']['cargo']);
        $this->db->newContent = null;
        $this->db->sql = "UPDATE $this->table SET `enable` = 0 WHERE id = ?";
        return $this->db->set();
    }
    public function edit(){
        //Util::prexit($this);

        $data = $this->getById();
        $this->db->idAction = 2;
        $this->db->content = array(
                        'cargo'=>$data['data']['cargo']
                        ,'salario'=>$data['data']['salario']
                        ,'periculosidade'=>$data['data']['periculosidade']
                        ,'transporte'=>$data['data']['transporte']
                        ,'refeicao'=>$data['data']['refeicao']
                        ,'cesta'=>$data['data']['cesta']
                        ,'inss'=>$data['data']['inss']
                        ,'desc_vt'=>$data['data']['desc_vt']
                        ,'desc_vr'=>$data['data']['desc_vr']
                        ,'desc_cesta'=>$data['data']['desc_cesta']
                        ,'id'=>$data['data']['id']
                        );
        $this->db->idRegister = $this->id;
        $this->db->values = array(
                                 $this->cargo
                                ,$this->salario
                                ,$this->periculosidade
                                ,$this->transporte
                                ,$this->refeicao
                                ,$this->cesta
                                ,$this->inss
                                ,$this->desc_vt
                                ,$this->desc_vr
                                ,$this->desc_cesta
                                ,$this->id
                            );
        $this->db->sql = "UPDATE $this->table SET 
                                        cargo  = ?
                                        ,salario    = ?
                                        ,periculosidade = ?
                                        ,transporte = ?
                                        ,refeicao   = ?
                                        ,cesta  = ?
                                        ,inss   = ?
                                        ,desc_vt    = ?
                                        ,desc_vr    = ?
                                        ,desc_cesta = ?
                                        WHERE id = ? ";
        return $this->db->set();
    }
    public function getAll(){
        $this->db->sql = "SELECT id,cargo,valores FROM cargos AS C
                            LEFT JOIN
                            (
                            SELECT C.id AS idCargo
                            ,GROUP_CONCAT(CONCAT('\"',tag,'\":\"',valor,'\"')) AS valores
                            FROM cargos AS C                            
                            LEFT JOIN cargos_itens AS I ON I.idCargo = C.id AND I.habilitado = 1
                            LEFT JOIN cargos_itens_tipos AS T ON T.id = I.idTipoItem
                            GROUP BY C.id
                            ) AS I ON I.idCargo = C.id WHERE C.`enable` = 1  ORDER BY cargo";
        return $this->db->getAll();
    }    
    public function getByCargo(){
        $this->db->values = $this->cargo;
        $this->db->custom ="SELECT * FROM $this->table WHERE cargo = ? AND `enable` = 1";
        return $this->db->get();
    }
    public function getById(){
        $this->db->values = $this->id;
        $this->db->custom ="SELECT * FROM $this->table WHERE id = ?";
        return $this->db->get();
    }
    public function getSalarioPericulosidade(){
        $sql ="SELECT SUM(valor) AS valor FROM cargos_itens WHERE idCargo = $this->idCargo AND idTipoItem IN (1,2)";
        $this->db->custom = $sql;
        return $this->db->get();
    }
    public function set(){

        $this->db->values = array($this->cargo,$this->salario);
        
        $d = $this->getByCargo();

        if (!$d['total']){

            $data = $this->getById();
            
            $this->db->idAction = 2;
            $this->db->content = array('cargo'=>$data['data']['cargo'],'salario'=>$data['data']['salario']);
            $this->db->idRegister = $this->id;
            $this->db->values = array($this->cargo,$this->salario,$this->id);
            $this->db->sql = "UPDATE $this->table SET cargo = ? , salario = ? WHERE id = ?";

            return $this->db->set();
        } else {
            return array("error"=>false,"data"=>false,"msg"=>"O resgitro já existe !");
        }           
    }
    public function setSalario(){
            $data = $this->getById();            
            $this->db->idAction = 2;
            $this->db->content = array('cargo'=>$data['data']['cargo'],'salario'=>$data['data']['salario']);
            $this->cargo = $data['data']['cargo'];
            $this->db->idRegister = $this->id;
            $this->db->values = array($this->cargo,$this->salario,$this->id);
            $this->db->sql = "UPDATE $this->table SET cargo = ?, salario = ? WHERE id = ?";
            return $this->db->set();
    }
}