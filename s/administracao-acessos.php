<?php
switch ($action) {
    case 'getAll':
        $U = new User();
        $U->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $U->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $U->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $U->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $U->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($U->getAll());
        break;   
    default:
        echo "service Acessos";
        break;
}