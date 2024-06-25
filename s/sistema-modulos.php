<?php
switch ($action) {
    case 'getAll':
        $M = new Modules();
        $M->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $M->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $M->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $M->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $M->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($M->getAll());
        break;
    case 'getById':
        $M = new Modules();
        $M->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($M->getById());
        break;
    case 'set':
        $M = new Modules();
        $M->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        $M->module = (isset($_REQUEST['module'])) ? $_REQUEST['module'] : null;
        $M->descricao = (isset($_REQUEST['descricao'])) ? $_REQUEST['descricao'] : null;
        if($M->id){
            echo json_encode($M->set());
        } else {
            echo json_encode($M->add());
        }
        
        break;
    default:
        echo "service Sistema Módulos";
        break;
}