<?php
class Analises{
    public function __construct(){
        $this->db = new Db('sigma-gas24h');
        $this->db->idModule = 20;
    }

    public function precoAnterior(){
        //$table = " (`ped` `A` join `cadastro` `B` on ((`B`.`Codigo` = `A`.`Cliente`))) ";
        /*
        SELECT * from view_preco_anterior_maior GROUP BY Cliente limit 10;
SELECT count(1) FROM view_preco_anterior_maior WHERE `Data` BETWEEN '2020-10-31' AND '2021-01-31' ;
select
  `ped`.`Entregador`
    from
      `ped`
      where ((`ped`.`Cliente` = `A`.`Cliente`)
      and (`ped`.`Prod` = `A`.`Prod`)
      and (`ped`.`Hora_entregue` <> '23:59:59'))
      order by `ped`.`Data` desc limit 1,1) AS `entregadorAnterior`,
      (select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1) AS `precoAnterior`,(select `ped`.`Data` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1) AS `dataAnterior`,`A`.`Cod` AS `Cod`,`A`.`Subcod` AS `Subcod`,(select `prod`.`Produto` from `prod` where (`prod`.`Cod` = `A`.`Prod`)) AS `Produto`,`A`.`Data` AS `Data`,`A`.`Hora` AS `Hora`,`A`.`Qt` AS `Qt`,`A`.`Precounit` AS `Precounit`,`A`.`Cliente` AS `Cliente`,`A`.`Hora_saida` AS `Hora_saida`,`A`.`Hora_entregue` AS `Hora_entregue`,`A`.`Entregador` AS `Entregador`,`A`.`Formapag` AS `Formapag`,`A`.`Obs` AS `Obs`,`B`.`Nome` AS `Nome`,`B`.`Endereço` AS `Endereço`,`B`.`End_numero` AS `End_numero`,`B`.`End_complemento` AS `End_complemento`,`B`.`Memo` AS `Memo`,`B`.`Tipo` AS `Tipo` from (`ped` `A` join `cadastro` `B` on((`B`.`Codigo` = `A`.`Cliente`))) where (`A`.`Precounit` < (select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1);


select
   (select `ped`.`Entregador` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1) AS `entregadorAnterior`
  ,(select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1) AS `precoAnterior`
  ,(select `ped`.`Data` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1,1) AS `dataAnterior`,`A`.`Cod` AS `Cod`,`A`.`Subcod` AS `Subcod`
  ,(select `prod`.`Produto` from `prod` where (`prod`.`Cod` = `A`.`Prod`)) AS `Produto`
  ,`A`.`Data` AS `Data`
  ,`A`.`Hora` AS `Hora`
  ,`A`.`Qt` AS `Qt`
  ,`A`.`Precounit` AS `Precounit`
  ,`A`.`Cliente` AS `Cliente`
  ,`A`.`Hora_saida` AS `Hora_saida`
  ,`A`.`Hora_entregue` AS `Hora_entregue`
  ,`A`.`Entregador` AS `Entregador`
  ,`A`.`Formapag` AS `Formapag`
  ,`A`.`Obs` AS `Obs`
  ,`B`.`Nome` AS `Nome`
  ,`B`.`Endereço` AS `Endereço`
  ,`B`.`End_numero` AS `End_numero`
  ,`B`.`End_complemento` AS `End_complemento`
  ,`B`.`Memo` AS `Memo`
  ,`B`.`Tipo` AS `Tipo`
    from
      `ped` `A` INNER join `cadastro` `B` on `B`.`Codigo` = `A`.`Cliente`
    where

      `A`.`Precounit` < (select `ped`.`Precounit` from `ped` where `ped`.`Cliente` = `A`.`Cliente` and `ped`.`Prod` = `A`.`Prod` and `ped`.`Hora_entregue` <> '23:59:59' order by `ped`.`Data` desc limit 1,1)
    and A.`Data` BETWEEN '2020-10-31' AND '2021-01-31'
    and Hora_entregue <> '23:59:59'
    ORDER BY `A`.`Data` desc
 ;

SELECT
  (select `ped`.`Entregador` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1) AS `entregadorAnterior`
  ,(select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1) AS `precoAnterior`
  ,(select `ped`.`Data` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1) AS `dataAnterior`
  ,(select `prod`.`Produto` from `prod` where (`prod`.`Cod` = `A`.`Prod`)) AS `Produto`
   ,`A`.`Cod` AS `Cod`
   ,`A`.`Subcod` AS `Subcod`
   ,`A`.`Data` AS `Data` ,`A`.`Hora` AS `Hora` ,`A`.`Qt` AS `Qt` ,`A`.`Precounit` AS `Precounit` ,`A`.`Cliente` AS `Cliente` ,`A`.`Hora_saida` AS `Hora_saida` ,`A`.`Hora_entregue` AS `Hora_entregue`
   ,`A`.`Entregador` AS `Entregador` ,`A`.`Formapag` AS `Formapag` ,`A`.`Obs` AS `Obs` ,`B`.`Nome` AS `Nome` ,`B`.`Endereço` AS `Endereço`
   ,`B`.`End_numero` AS `End_numero` ,`B`.`End_complemento` AS `End_complemento` ,`B`.`Memo` AS `Memo` ,`B`.`Tipo` AS `Tipo`
   from (`ped` `A` join `cadastro` `B` on((`B`.`Codigo` = `A`.`Cliente`)))  (`A`.`Precounit` < (select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1));

SELECT * from cadastro where Endereço = 'HUMANA' AND End_numero = '14';
SELECT * from ped where Cliente = 300006287;
SELECT
  COUNT(A.Cliente)
  FROM (`ped` AS `A` INNER join `cadastro` AS `B` on ((`B`.`Codigo` = `A`.`Cliente`)))
  WHERE (`A`.`Precounit` < (select `ped`.`Precounit` from `ped` where ((`ped`.`Cliente` = `A`.`Cliente`) and (`ped`.`Prod` = `A`.`Prod`) and (`ped`.`Hora_entregue` <> '23:59:59')) order by `ped`.`Data` desc limit 1))
  GROUP BY A.Cliente;
SELECT * from ped limit 1;
SELECT
  P.Cliente
  ,P.Precounit
  ,(select Precounit from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1) AS `precoAnterior`
  ,(select Entregador from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1) AS `entregadorAnterior`
  ,(select `Data` from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1) AS `dataAnterior`
  FROM ped AS P
  WHERE
      P.Hora_entregue <> '23:59:59'
  AND P.`Data` BETWEEN '2020-10-31' AND '2021-01-31'
  AND P.Precounit < (select Precounit from ped where Cliente = P.Cliente and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1)
  GROUP BY Cliente
  -- HAVING COUNT(P.Cliente) >= 2
 ;        
        */
        $table = " ped AS P INNER JOIN cadastro AS C ON C.Codigo = P.Cliente ";
        $select = "SELECT
                        P.Cliente
                        ,P.Precounit AS `precoMaior`
                        ,DATE_FORMAT(P.`Data`, '%d/%m/%Y') AS `Data`
                        ,P.Entregador
                        ,P.Prod
                        ,(select Precounit from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1,1) AS `precoAnterior`
                        ,(select Entregador from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1,1) AS `entregadorAnterior`
                        ,(select DATE_FORMAT(`Data`, '%d/%m/%Y') from `ped` where Cliente = P.`Cliente` and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1,1) AS `dataAnterior`
                        ,IF(C.End_complemento = '', CONCAT(C.`Endereço`,', (<span class=\"text-info\">',C.End_numero,'</span>)'), CONCAT(C.`Endereço`,', (<span class=\"text-info\">',C.End_numero,'</span>)','   [<span class=\"text-warning\">',C.End_complemento,'</span>]') ) AS endereco
                        ,C.Memo
                        FROM $table 
         ";
        $selectCount = "SELECT COUNT(1) AS qtd  FROM $table ";

        $this->fieldSort = ($this->fieldSort != "") ? $this->fieldSort : 'P.`Data`' ;
        $this->sort = ($this->sort != "") ? $this->sort : 'DESC' ;
        
        $where =" WHERE
            P.Hora_entregue <> '23:59:59'
            AND P.Prod = 1  
            AND P.Precounit < (select Precounit from ped where Cliente = P.Cliente and `Prod` = `P`.`Prod` and `Hora_entregue` <> '23:59:59' order by `Data` desc limit 1,1)            
            ";
        if ($this->startDate){
          //$where .= ' AND P.`Data` > DATE_SUB(now(), INTERVAL 3 MONTH) ';
          if($this->startDate == $this->endDate){
            $where .= " AND P.`Data` = '".$this->startDate."' ";
          } else {
            $where .= " AND P.`Data` BETWEEN '".$this->startDate."' AND '".$this->endDate."' ";
          }
        }
        if($this->motoristas !=""){
           $where .=" AND P.Entregador IN (".$this->motoristas.") ";
        }
        if ($this->search != "") {
          if (strpos($this->search, ',') !== false) {
            $end = explode(",",$this->search);
            $where .=" AND C.Endereço LIKE '".$end[0]."%' AND C.End_numero LIKE '".$end[1]."%'";
          } else {
            $where .=" AND (
                            C.Endereço LIKE '%".$this->search."%' 
                            OR C.Memo LIKE '%".$this->search."%' 
                            OR C.Nome LIKE '%".$this->search."%' 
                            OR C.End_complemento LIKE '%".$this->search."%' 
                            )
                            ";
          }
        } else {
            
        }        
        $group = " GROUP BY Cliente ";
        $order = " ORDER BY ".$this->fieldSort." ".$this->sort;

        $this->db->sql = $select.$where.$group.$order;
        $this->db->sqlCount = $selectCount.$where.$group;
        $this->db->group = true;
        $this->db->show = $this->show;
        $this->db->page = $this->page;
        return $this->db->pages();
        
    }       
}