<?php
    $idCargo = $_SESSION['idCargo'];    
    switch ($idCargo) {
        case 3:
            require_once('administradores-index.php');
            $a = 'administradores';
            $b = 'index';
            break;        
        default:
            require_once('default-default.php');
            break;
    }
?>