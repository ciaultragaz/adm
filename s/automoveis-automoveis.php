<?php
switch ($action) {
    case 'getAll':
            $A = new Automoveis();
            $A->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
            $A->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
            $A->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
            $A->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
            $A->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
            echo json_encode($A->getPages());
        break;
        case 'add':
        case 'set':
            $A = new Automoveis();
            $A->placa           =   (isset($_REQUEST['placa'])) ? $_REQUEST['placa'] : null;
            $A->renavam         =   (isset($_REQUEST['renavam'])) ? $_REQUEST['renavam'] : null;
            $A->chassi          =   (isset($_REQUEST['chassi'])) ? $_REQUEST['chassi'] : null;
            $A->marca           =   (isset($_REQUEST['marca'])) ? $_REQUEST['marca'] : null;
            $A->modelo          =   (isset($_REQUEST['modelo'])) ? $_REQUEST['modelo'] : null;
            $A->ano             =   (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
            if($action == 'set'){
                $A->id          =   (isset($_REQUEST['idCarro'])) ? $_REQUEST['idCarro'] : null;
                echo json_encode($A->set());
            } else {
                echo json_encode($A->add());
            }            
            break;
        case 'get':
            $A = new Automoveis();
            $A->id = (isset($_REQUEST['idCarro'])) ? $_REQUEST['idCarro'] : null;
            echo json_encode($A->get());
            break;
        case 'delete':
            $A = new Automoveis();
            $A->id = (isset($_REQUEST['idCarro'])) ? $_REQUEST['idCarro'] : null;
            echo json_encode($A->disable());
            break;
    default:
        echo "service Automóveis";
        break;
}