<?php
/*
Util::pre($_REQUEST);
if ( isset($_FILES['file']) && !empty($_FILES['file']['name']) )
{
    $file_name = time() . '.txt';
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];       

    $destino = '/var/www/html/adm/uploads/hours';

    echo move_uploaded_file($file_tmp_name,$destino.$file_name);    
}
*/
require_once('../_config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$ds= DIRECTORY_SEPARATOR;  //1
$storeFolder = '/var/www/html/adm/uploads/hours';   //2
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    $targetPath = $storeFolder . $ds;  //4
    $targetFile =  $targetPath. time().'.txt';  //5
    move_uploaded_file($tempFile,$targetFile); //6
    $fh = fopen($targetFile,'r');
$i = 0  ;
while ($line = fgets($fh)) {
  //secho $line.PHP_EOL;
  //echo "\r\n\n\n";
  //$words = preg_split('/\s+/', $line);
  //$comp = preg_split("/[\t]/", $var);
  if($i >=2){
    $comp = explode("\t",$line);
    $dataHora = explode(" ",$comp[6]);
    $data = Util::dateToDbReverse($dataHora[0]);
    $idRegister = $comp[0];
    $hora = $dataHora[2];
    $nome = $comp[3];
    //echo "<br>".$data." ".$hora;
    //Util::pre($comp);
    $H = new FuncionariosHoras();
    $H->idRegister = $idRegister;
    $H->idPonto = $comp[2];
    $H->nome = $nome;
    $H->dataPonto = $data;
    $H->horario = $hora;
    $H->idBase = 1;
    $H->sis = 1;
    $H->add();
  }
  
  //$arexplode(" ")
  //echo $words;
  $i++;
}
//echo "qtd".$i;
fclose($fh);
echo json_encode(true);
}