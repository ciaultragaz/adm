<?php
switch ($action) {
    case 'getAll':
    case 'getAllByIdUser':
        $H = new Historico();
        $H->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $H->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $H->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $H->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $H->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $H->registro = (isset($_REQUEST['registro'])) ? $_REQUEST['registro'] : null;
        $H->startDate = (isset($_REQUEST['startDate'])) ? $_REQUEST['startDate'] : null;
        $H->endDate = (isset($_REQUEST['endDate'])) ? $_REQUEST['endDate'] : null;
        $H->idUser = (isset($_REQUEST['idUser'])) ? $_REQUEST['idUser'] : null;
        $H->idAction = (isset($_REQUEST['idAction'])) ? $_REQUEST['idAction'] : null;
        $H->idModule = (isset($_REQUEST['idModule'])) ? $_REQUEST['idModule'] : null;
        
        if($action =="getAllByIdUser"){
            $H->idUser = $idUser;
        }
        echo json_encode($H->getAll());
        break;
    
    default:
        echo "service Histórico";
        break;
}