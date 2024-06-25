<?php
switch ($action) {
    case 'getAll':
        $D = new Despesas();
        $D->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $D->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $D->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $D->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $D->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($D->getAll());
        break;
    default:
        echo "service Despesas";
        break;
}