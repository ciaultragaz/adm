<?php

class CargosItens{
    private $table = 'cargos_itens';
    private $db;

    public function __construct(){
        $this->db = new Db('appUltraleste');
        $this->db->idModule = 31;
    }
    public function add(){
        $this->db->idAction = 1;
        $this->db->values = array($this->idCargo,$this->tipo,$this->idTipo,$this->habilitado,$this->valor,$this->desconto);
        $this->db->newContent = array(
                                       'idCargo'=>$this->placa
                                      ,'tipo'=>$this->renavam
                                      ,'idTipoItem'=>$this->chassi
                                      ,'habilitado'=>$this->modelo
                                      ,'valor'=>$this->ano
                                      ,'desconto'=>$this->desconto
                                    );
        $this->db->sql ="INSERT INTO $this->table 
            (
            idCargo
            ,tipo
            ,idTipoItem
            ,dataCadastro
            ,habilitado
            ,valor
            ,desconto
            ) 
            VALUES (
                 ?
                ,?
                ,?
                ,NOW()
                ,?
                ,?
                ,?
                ) ";
            return $this->db->add();
    }
    public function checkExist(){
        $this->db->custom = "SELECT * FROM $this->table WHERE idCargo = $this->idCargo AND idTipoItem = $this->idTipo";
        return $this->db->get();
    }
    public function disable(){
        $this->db->idAction = 3;
        $this->db->values = $this->id;
        $this->db->idRegister = $this->id;
        $data = $this->get();
        $this->db->content = array('idCargoItem'=>$data['data']['id']);
        $this->db->newContent = null;
        $this->db->sql = "UPDATE $this->table SET `habilitado` = 0 WHERE id = ?";
        return $this->db->set();     
    }    
    public function edit(){
        $data = $this->get();        
        $this->db->idAction = 2;
        $item = $data['data'];
        $this->db->content = array(
                             'idCargo'      =>$item['idCargo']
                            ,'tipo'         =>$item['tipo']
                            ,'idTipoItem'   =>$item['idTipoItem']
                            ,'habilitado'   =>$item['habilitado']
                            ,'desconto'     =>$item['desconto']
                            ,'valor'        =>$item['valor']
                        );
        $this->db->idRegister = $this->idItem;
        $this->db->values = array($this->idCargo,$this->tipo,$this->idTipo,$this->habilitado,$this->valor,$this->desconto,$this->idItem);
        $this->db->sql = "UPDATE $this->table SET 
                                        idCargo = ?
                                        , tipo = ?
                                        , idTipoItem = ?
                                        , habilitado = ?
                                        , valor = ?
                                        , desconto = ?
                                         WHERE id = ?";
        return $this->db->set();
    }
    public function get(){
        $this->db->custom = "SELECT * FROM $this->table WHERE id = $this->id";
        return $this->db->get();
    }
    public function getAllByIdCargo(){
        /*$this->db->sql = "SELECT 
                            A.id
                            , A.idCargo
                            , A.tipo
                            , A.idTipoItem
                            , A.dataCadastro
                            , A.habilitado
                            , A.valor                            
                             ,B.descricao
                             ,B.ordem
                            FROM $this->table AS A 
                            LEFT JOIN cargos_itens_tipos AS B ON A.idTipoItem = B.id 
                            WHERE 
                                idCargo = $this->idCargo 
                            ORDER BY ordem"; */;
        $this->db->sql = " SELECT
                                A.id
                                , A.idCargo
                                , A.tipo
                                , A.dataCadastro
                                , A.habilitado
                                , A.desconto
                                , A.valor
                                , B.id AS idTipoItem
                                ,B.descricao
                                ,B.ordem
                                ,C.cargo 
                        FROM cargos_itens_tipos AS B
                        LEFT JOIN cargos_itens AS A ON A.idTipoItem = B.id AND A.idCargo = $this->idCargo 
                        LEFT JOIN cargos AS C ON C.id = A.idCargo 
                        WHERE A.habilitado= 1
                        ORDER BY B.ordem";                            
        return $this->db->getAll();
    }
    public function set(){
        $data = $this->checkExist();
        if($data['error']){
            return array('error'=>true,'msg'=>'Ocorreu um erro na consulta !','total'=>0,'data'=>false);
        } else {
            if($data['total']){
                return $this->edit();
            } else {
                return $this->add();
            }
        }
    }
}