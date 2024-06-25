<?php

class Comissao{
    private $table = 'ped';
    private $db;

    public function getAll(){
        $this->db = new Db('sigma-gas24h');
        $this->db->sql = "SELECT
                            ((1 / 100) * ROUND(SUM(Precounit * Qt))) AS comissao
                            ,Entregador AS Entregador
                                from $this->table
                            WHERE
                                  MONTH(`Data`) = '$this->mes'
                            AND   YEAR(`Data`) = '$this->ano'
                            AND Hora_entregue != '23:59:59'
                            GROUP BY Entregador;";
        return $this->db->getAll();
    }
    public function get(){
            $this->db = new Db('sigma-gas24h');
            $this->db->custom = "SELECT
                                ((1 / 100) * ROUND(SUM(Precounit * Qt))) AS comissao
                                ,Entregador AS Entregador
                                    from $this->table
                                WHERE
                                      MONTH(`Data`) = '$this->mes'
                                AND   YEAR(`Data`) = '$this->ano'
                                AND Hora_entregue != '23:59:59'
                                AND Entregador ='$this->motorista'
                                GROUP BY Entregador;";
            return $this->db->get();
    }
    public function comissoes(){
        $data = $this->getAll();
        //Util::pre($data['data']);
        $F = new FuncionariosMotoristas();
        $funcionarios = $F->getAll();
        $funcionarios = $funcionarios['data'];
        //Util::pre($funcionarios);
        $comissao = array();
        if($data['total']){
            foreach ($data['data'] as $key => $value) {
                /*
                foreach ($funcionarios as $k => $v) {
                    if(trim($value['Entregador']) == trim($v['motorista'])){
                        $i = $v['idFuncionario'];
                        $comissao[$i]['idFuncionario'] = $v['idFuncionario'];
                    }
                }*/
                for($j = 0 ; $j<count($funcionarios);$j++){
                    if($value['Entregador']==$funcionarios[$j]['motorista']){
                        $i = $funcionarios[$j]['idFuncionario'];
                        $comissao[$i]['idFuncionario'] = $i;
                        $comissao[$i]['comissao'] = $value['comissao'];
                        $comissao[$i]['Entregador'] = $value['Entregador'];
                    }
                }
            }
        }
        return $comissao;
    }
}