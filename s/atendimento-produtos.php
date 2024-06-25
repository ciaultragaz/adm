<?php
switch ($action) {
    case 'get':
        $P = new Produtos();
        $P->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($P->get());
        break;
    }
?>