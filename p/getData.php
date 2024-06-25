<?php
require_once('../_config1.php');
require_once('print-vales.php'); // O caminho para o arquivo Vales.php pode ser diferente

$connection = connect();

// Use funções adequadas para obter esses valores se eles não forem fornecidos diretamente através de $_GET
$idFuncionario = $_GET['idFuncionario'] ?? null;
$range = $_GET['range'] ?? null;
$show = $_GET['show'] ?? 10;
$page = $_GET['page'] ?? null;
$fieldSort = $_GET['fieldSort'] ?? 'dataVencimento';
$sort = $_GET['sort'] ?? 'ASC';
$search = $_GET['search'] ?? null;

$vales = new Vales();
$vales->idFuncionario = $idFuncionario;
$vales->range = $range;
$vales->show = $show;
$vales->page = $page;
$vales->fieldSort = $fieldSort;
$vales->sort = $sort;
$vales->search = $search;

$data = $vales->getCountByMonth();

header('Content-Type: application/json');
echo json_encode($data);
?>
