<?php
switch ($action) {
    case 'getFuncionarios':
        $F = new Vales();
        $F->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $F->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $F->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $F->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $F->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($F->getFuncionarios());
        break;
    case 'getByIdFuncionario':
        $V = new Vales();
        $V->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $V->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $V->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $V->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $V->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $V->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $V->range = (isset($_REQUEST['range'])) ? $_REQUEST['range'] : null;
        /*
        $Db = new Db();
        $Db->idModule = 11;
        $Db->idAction = 6;
        $Db->idRegister = $_REQUEST['idFuncionario'];
        $Db->log(); 
        */
        echo json_encode($V->getByIdFuncionario());
        break;
    case 'getByIdFuncionarioByMonthYear':
        $V = new Vales();
        $V->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $V->month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $V->year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        echo json_encode($V->getByIdFuncionarioByMonthYear());
        break;
    case 'add':
        $V = new Vales();
        $V->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $V->valor = (isset($_REQUEST['valor'])) ? $_REQUEST['valor'] : null;
        $V->obs = (isset($_REQUEST['obs'])) ? $_REQUEST['obs'] : null;
        $V->dataVencimento = (isset($_REQUEST['dataVencimento'])) ? $_REQUEST['dataVencimento'] : null;
        $V->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        $V->idUser = $idUser;
        if($V->id){
            echo json_encode($V->set());
        } else {
            echo json_encode($V->add());
        }        
        break;
    case 'get':
        $V = new Vales();
        $V->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($V->get());
        break;
    case 'getByDate':
        $idsFuncs = (isset($_REQUEST['filterFuncs'])) ? $_REQUEST['filterFuncs'] : null;
        $V = new Vales();
        $V->dataHistory = (isset($_REQUEST['dataHistory'])) ? $_REQUEST['dataHistory'] : null;
        $V->idUser = $idUser;
        $V->filter = ($idsFuncs)?implode(',',$idsFuncs):'';
        echo json_encode($V->getHistorico());
        break;
    case 'logAcess':
        $V = new Vales();
        echo json_encode($V->access());
        break;
    case 'logPrint':
        $V = new Vales();
        $V->idRegister = (isset($_REQUEST['idRegister'])) ? $_REQUEST['idRegister'] : null;
        echo json_encode($V->print());
        break;
    default:
        echo "service Financeiro vales";
        break;
}