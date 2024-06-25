<?php
switch ($action) {
    case 'getAll':
        $A = new Analises();
        $A->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $A->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $A->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $A->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $A->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $A->startDate = (isset($_REQUEST['startDate'])) ? Util::dateToDb($_REQUEST['startDate']) : null;
        $A->endDate = (isset($_REQUEST['endDate'])) ? Util::dateToDb($_REQUEST['endDate']) : null;
        $A->motoristas = (isset($_REQUEST['motoristas'])) ? $_REQUEST['motoristas'] : null;
        if($A->motoristas){
            $motoristas = array();
            foreach ($A->motoristas as $key => $value) {
                array_push($motoristas,"'".$value."'");
            }
            $A->motoristas = implode($motoristas,',');            
        }    
        echo json_encode($A->precoAnterior());
        break;
    default:
        echo "service Preço Anterior";
        break;
}