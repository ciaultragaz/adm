<style>
    html,body{
        font-family:arial;        
    }
    .logo{
        float: left;
    }
    h1{
        font-size: 19px;
        clear: both;
        margin-top: 105px;
    }
    .corpo{
        padding: 103px;
        text-align: center;
    }
    .texto{
        margin-top: 46px;
        text-align: justify;
    }
    .data{
        float: left;
    margin-top: 39px;
    }
    .empresa{
        clear: both;
        margin-top: 202px;
    }
    @media print {
    footer {page-break-after: always;}
    }
</style>
<?php
require_once('../_config.php');

$F = new Funcionarios();
$F->demitidos = false;
$funcionarios = $F->getAllFuncionarios();

foreach ($funcionarios['data'] as $key => $value) {
    //Util::pre($value);
    echo $text = "
    <div class=\"corpo\">
    <div class=\"logo\"><img src=\"https://adm.ultragaz24horas.com/img/logo.png\" width=\"200\"></div>
    <h1>DECLARAÇÃO DE JORNADA DE TRABALHO</h1>   
    <div class=\"texto\">Declaramos para os devidos fins que o(a) Sr(a) ".$value['nome'].", inscrito(a) no CPF sob o nº ".$value['cpf'].", é funcionário(a) desta Empresa, exercendo o cargo de Motorista, trabalhando de segunda a sexta-feira das 17:00hs às 23:30 hs e aos sábados e domingos e feriados das 18:00 às 23:00hs.</div> 
    <div class=\"data\">São Paulo,17 de Março de 2021.</div>
     
        
     
     
     
    <div class=\"empresa\">_________________________________________________ <br><br>
          ULTRA 24 HORAS COMERCIO DE GAS LTDA.<br>
          CNPJ : 26.174.461/0001-74
    </div>  
    </div>
    <footer></footer>
    ";

}