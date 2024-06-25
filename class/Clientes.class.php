<?php 

class Clientes{
    private $table = 'cadastro';
    private $db;   

    public function __construct(){
        $this->db = new Db('sigma-gas24h');
        $this->db->idModule = 17;
    }
    public function get(){
        $codigo = $this->codigo;
        $this->db->custom = "SELECT * from $this->table WHERE Codigo =$codigo";
        return $this->db->get();
    }
    public function getAllBairros(){
        $this->db->sql = "SELECT Bairro from $this->table WHERE Tipo !='DELETADO' GROUP BY Bairro";
        return $this->db->getAll();
    }
    public function getAllCep(){
        $this->db->sql = "SELECT CEP from $this->table WHERE Tipo !='DELETADO' GROUP BY CEP";
        return $this->db->getAll();
    }    
    public function getAllTipos(){
        $this->db->sql = "SELECT Tipo from $this->table WHERE Tipo !='DELETADO' GROUP BY Tipo";
        return $this->db->getAll();
    }
    public function getCount(){
        $this->db->custom = "SELECT COUNT(1) AS qtd from $this->table WHERE Tipo !='DELETADO'";
        return $this->db->get();
    }
    public function getByEndereco(){
        $end = $this->end;
        $table = "FROM $this->table WHERE Tipo !='DELETADO' ";
        $sql = "SELECT Codigo, Nome, Tipo, Endereço AS `end`, End_numero, End_complemento $table";
        $selectCount = "SELECT COUNT(1) AS qtd  $table ";
        if (strpos($this->end, ',') !== false) {
            $end = explode(",",$this->end);
            $where = " AND (Endereço LIKE '%".trim($end[0])."%' AND End_numero LIKE '".trim($end[1])."%' )";
        } else {
            $where = " AND Endereço LIKE '%".$end."%' ";
        }
        $this->fieldSort = ($this->fieldSort != "") ? $this->fieldSort : 'End_numero' ;
        $this->sort = ($this->sort != "") ? $this->sort : 'ASC' ;

        $order = " ORDER BY ".$this->fieldSort." ".$this->sort;

        $this->db->sql = $sql.$where.$order;
        $this->db->sqlCount = $selectCount.$where;
        $this->db->group = false;
        $this->db->show = $this->show;
        $this->db->page = $this->page;
        return $this->db->pages();
    }
    public function getPages(){
        $select = "SELECT 
                        A.*
                        ,B.lat
                        ,B.`longi`
                        ,B.idArea
                                                FROM $this->table AS A LEFT JOIN aux_cliente AS B ON A.Codigo = B.Codigo ";
        $selectCount = "SELECT COUNT(1) AS qtd  FROM $this->table AS A LEFT JOIN aux_cliente AS B ON A.Codigo = B.Codigo ";

        $this->fieldSort = ($this->fieldSort != "") ? $this->fieldSort : 'Codigo' ;
        $this->sort = ($this->sort != "") ? $this->sort : 'DESC' ;
        
        $where =" WHERE Tipo !='DELETADO'";
        if ($this->search != "") {
            $where .= " AND ((Nome LIKE '%$this->search%')  
            OR (Endereço LIKE '%$this->search%') 
            OR (CEP LIKE '%$this->search%') 
            OR (Bairro LIKE '%$this->search%') 
            OR (End_numero LIKE '%$this->search%') 
            OR (End_complemento LIKE '%$this->search%') ) 
            ";    
        } else {
            $where .= ' ';
        }
        if($this->bairros){
            foreach ($this->bairros as $key => $value) {
                $b[] = "'$value'";
            }
            $bairros = implode(",", $b);
            $where .= " AND Bairro IN ($bairros)";
        }
        if($this->tipos){
            foreach ($this->tipos as $key => $value) {
                $t[] = "'$value'";
            }
            $tipos = implode(",", $t);
            $where .= " AND Tipo IN ($tipos)";
        }
        if($this->ceps){
            foreach ($this->ceps as $key => $value) {
                $c[] = "'$value'";
            }
            $ceps = implode(",", $c);
            $where .= " AND CEP IN ($ceps)";
        }
        if($this->localizados){
            $where .= " AND lat IS NOT NULL ";
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
    public function getCountLocal(){
        $this->db->custom = "SELECT COUNT(1) AS qtd
                            FROM cadastro AS A
                            INNER JOIN aux_cliente AS B ON A.Codigo = B.Codigo
                            WHERE Tipo !='DELETADO' AND B.lat IS NOT NULL ";
        return $this->db->get();
    }
    public function latlong(){
        $this->db->values = $this->codigo;
        $this->db->custom = "SELECT A.*, B.lat, B.longi
                            FROM cadastro AS A
                            INNER JOIN aux_cliente AS B ON A.Codigo = B.Codigo
                            WHERE A.codigo = ? ";
        return $this->db->get();
    }
    public function memo(){
        $codigo = $this->codigo;
        $this->db->custom = "SELECT Memo
                            FROM cadastro
                            WHERE Codigo = $codigo ";
        return $this->db->get();        
    }
    public function set(){
        $data = $this->get();
        $this->db->idAction = 2;
        $this->db->content = array(
                            'Nome'          =>$data['data']['Nome']
                            ,'Endereço'     =>$data['data']['Endereço']
                            ,'Número'       =>$data['data']['End_numero']
                            ,'Complemento'  =>$data['data']['End_complemento']
                            ,'Bairro'       =>$data['data']['Bairro']
                            ,'Cidade'       =>$data['data']['Cidade']
                            ,'UF'           =>$data['data']['Estado']
                            ,'Tipo'         =>$data['data']['Tipo']
                            ,'Observação'   =>$data['data']['Memo']
                        );
        $this->db->idRegister = $this->codigo;
        $this->db->values = array($this->nome,$this->rua,$this->numero,$this->complemento,$this->bairro,$this->cidade,$this->uf,$this->tipo,$this->obs,$this->codigo);
        $this->db->sql = "UPDATE $this->table SET 
                                        Nome = ?
                                        , Endereço = ?
                                        , End_numero = ?
                                        , End_complemento = ?
                                        , Bairro = ?
                                        , Cidade = ?
                                        , Estado = ?
                                        , Tipo = ?
                                        , Memo = ?
                                         WHERE Codigo = ?";
        return $this->db->set();
    }
}