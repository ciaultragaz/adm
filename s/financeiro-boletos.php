<?php
switch ($action) {
    case 'getAll':
        $B = new Boletos();
        $B->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $B->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $B->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $B->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $B->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($B->getAll());
        break;
    default:
        echo "service Financeiro Boletos";
        break;
}