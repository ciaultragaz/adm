<?php
require_once('../_config.php');

$P = new Paginas();
$P->idMenu = 1;
$P->section = 'x';
$P->page = 'y';
$P->fileName = 'z';

Util::pre($P->add());