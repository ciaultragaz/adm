<?php
class Caixa{
    private $db;   

    public function __construct(){
        $this->db = new Db('sigma-gas24h');
        $this->db->idModule = 27;
    }
    public function atividadeMotoristas(){
        $dia = ($this->dia == null) ? 'CURDATE()' : "'$this->dia'";
        $this->db->sql = "SELECT
                C.placa
                ,(SELECT motorista FROM carros_motorista WHERE idCarro = C.id ORDER BY DataHora DESC LIMIT 1) AS m
                ,(SELECT COUNT(1) FROM ped WHERE DATE(`Data`)= " . $dia . " AND hora_entregue <>'23:59:59' AND Entregador = m ) AS pedidos                
                ,(SELECT COUNT(1) FROM ped WHERE DATE(`Data`)= " . $dia . " AND hora_entregue ='00:00:00' AND Entregador = m ) AS pendentes
                ,(SELECT DATE_FORMAT(MIN(dataAdd), '%H:%i') FROM motorista_escala_reg WHERE DATE(dataAdd)=  " . $dia . " AND motorista = m) AS entrada
                ,(SELECT DATE_FORMAT(MAX(dataAdd), '%H:%i') FROM motorista_escala_reg WHERE DATE(dataAdd)=" . $dia . " AND motorista = m) AS saida
                FROM carros AS C
                ORDER BY m
                ";
        return $this->db->getAll();
    }
    public function totais() {
        $varMotorista = ($this->motorista == null) ? "" : " AND Entregador = '" . $this->motorista . "'";
        $periodo = ($this->periodo==null) ? ' CURDATE() ' : "'".$this->periodo."'";
        $sql = "SELECT 
                COUNT(1) as qtd 
                ,(SELECT IF(SUM(Qt) IS NULL,0,SUM(Qt))  FROM ped WHERE `Data` = A.`Data` AND Hora_entregue <> '23:59:59' AND Prod = 1 $varMotorista) AS P13 
                ,(SELECT COUNT(1) FROM ped WHERE `Data` = A.`Data` AND Hora_entregue <> '23:59:59' $varMotorista AND Locate(Entregador,Obs) <> 1) AS DISK 
                ,(SELECT COUNT(1) FROM ped WHERE `Data` = A.`Data` AND Hora_entregue <> '23:59:59' $varMotorista AND Locate(Entregador,Obs) = 1) AS AUTO
                ,(SELECT COUNT(1) FROM ped WHERE `Data` = A.`Data` AND Hora_entregue <> '23:59:59' $varMotorista AND Obs LIKE '%SIS%') AS DIRECT                
                ,DATE_FORMAT(A.`Data`, '%d/%m/%Y') AS dataSelecionada
                FROM ped AS A WHERE A.Hora_entregue <> '23:59:59' ";
        
        $sql .= " AND A.`Data` = " . $periodo . " ";
        
        if ($motorista != "") {
            $sql .= "AND Entregador = '" . $this->motorista . "' ";
        }
        $this->db->custom = $sql;
        return $this->db->get();
    }
    public function getPedidosDetalhesResumo(){
        $group = ($this->group == null) ? 'Precounit' : $group;
        $dia = ($this->dia == null) ? 'CURDATE()' : "'$this->dia'";
        $whereMotorista = ($this->motorista !="") ? "AND Entregador = '".$this->motorista."'" : "";
        $sql = "SELECT
                      (SELECT ROUND(AVG(Precounit)) FROM ped WHERE Hora_entregue <>'23:59:59' AND `Data` = A.`Data` $whereMotorista ) AS media
                     ,(SELECT SUM(Qt)               FROM ped WHERE Hora_entregue <>'23:59:59' AND `Data` = A.`Data` $whereMotorista AND Precounit = A.Precounit AND Locate(Entregador,Obs) <> 1) AS DISK
                     ,(SELECT SUM(Qt)               FROM ped WHERE Hora_entregue <>'23:59:59' AND `Data` = A.`Data` $whereMotorista AND Precounit = A.Precounit AND Locate(Entregador,Obs) = 1) AS AUTO
                     ,(SELECT SUM(Qt)               FROM ped WHERE Hora_entregue <>'23:59:59' AND `Data` = A.`Data` $whereMotorista AND Precounit = A.Precounit) AS total
                     ,(SELECT SUM(Qt*Precounit)     FROM ped WHERE Hora_entregue <>'23:59:59' AND `Data` = A.`Data` $whereMotorista AND Precounit = A.Precounit) AS totais
                     ,Precounit
                     ,A.*
                     ,B.Produto
                 FROM 
                     ped AS A
                 INNER JOIN prod AS B ON A.Prod = B.Cod
                 WHERE
                     A.Hora_entregue <> '23:59:59'
                     AND A.`Data` = " . $dia . "";
                if($this->motorista){
                    $sql .=" AND A.Entregador = '".$this->motorista."'";
                }
                 $sql.="GROUP BY  
                     $group,A.Prod
                 ORDER BY 
                     Precounit;";
        $this->db->sql = $sql;
        return $this->db->getAll();
    }    
}