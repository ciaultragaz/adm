<?php
switch ($action) {
    case 'getAll':
        $P = new Parametros();
        $P->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $P->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $P->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $P->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $P->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($P->getAllPages());
        break;
    case 'delete':
        $P = new Parametros();
        $P->id = (isset($_REQUEST['idParametro'])) ? $_REQUEST['idParametro'] : null;
        echo json_encode($P->disable());
        break;
    case 'add':
    case 'set':
        $P = new Parametros();
        $P->parametro   =   (isset($_REQUEST['parametro'])) ? $_REQUEST['parametro'] : null;
        $P->tipo        =   (isset($_REQUEST['tipo'])) ? $_REQUEST['tipo'] : null;
        if($action == 'set'){
            $P->id      =   (isset($_REQUEST['idParametro'])) ? $_REQUEST['idParametro'] : null;
            echo json_encode($P->set());
        } else {
            echo json_encode($P->add());
        }        
        break;
    case 'get':
        $P = new Parametros();
        $P->id = (isset($_REQUEST['idParametro'])) ? $_REQUEST['idParametro'] : null;
        echo json_encode($P->get());
        break;
    default:
        echo "service Administração Parâmetros";
        break;
}