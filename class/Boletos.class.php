<?php

class Boletos{
    private $table = 'boletos';
    private $db;

    public function __construct(){
        $this->db = new Db('sigma-gas24h');
        $this->db->idModule = 1;
    }
    public function getAll(){
        $sql = "SELECT
                B.*
                ,IF(C.Nome='', 'SEM NOME', C.Nome) AS nome
                ,CONCAT(C.`Endereço`, ' (',C.End_numero,')')  AS endereco
                ,DATE_FORMAT(B.dataCadastro, '%d/%m/%Y %H:%m:%i') AS dataCadastro
                ,Produto
                ,Qt
                ";
        $sqlCount = "SELECT COUNT(1) as qtd ";        
        $criteria = " FROM boletos AS B
                        INNER JOIN ped AS P ON P.Cod = B.idPedido
                        INNER JOIN cadastro AS C ON P.Cliente = C.Codigo
                        INNER JOIN prod AS PROD ON P.Prod = PROD.Cod
                        LEFT JOIN aux_fiscal AS A ON  P.Cliente = A.idCadastro
                        LEFT JOIN w_cadastro AS W ON  A.idCadastro = W.registro
                    ";
        if(!empty($between) || !empty($word)){
            $where = " WHERE 1 ";
            
            if($between !=""){
                $where  .= "AND B.dataCadastro BETWEEN '".Util::dataDb($between[0])." 00:00:00' AND  '".Util::dataDb($between[1])." 23:59:59' ";
            }
            if($word !=""){
                $where  .= "AND C.Nome LIKE '%$word%' ";
            }
        } else {
            $where  = '';
        }
        
        $order  = "ORDER BY dataCadastro DESC";
        $sqlCount .= $criteria.$where;
        echo $sql      .= $criteria.$where.$order;
        //return $this->db->getPages($sql, $registros, $pagina, $sqlCount);
    }
}