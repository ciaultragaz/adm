<?php
switch ($action) {
    case 'getAll':
        $T = new Tarefas();
        $T->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $T->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $T->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $T->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $T->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($T->getAll());
        break;
    case 'add':
        $T = new Tarefas();
        $T->tarefa      =   (isset($_REQUEST['tarefa']))    ? $_REQUEST['tarefa'] : null;
        $T->exemplo     =   (isset($_REQUEST['exemplo']))   ? $_REQUEST['exemplo'] : null;
        $T->modulo      =   (isset($_REQUEST['modulo']))    ? $_REQUEST['modulo'] : null;
        $T->comentario  =   (isset($_REQUEST['comentario']))? $_REQUEST['comentario'] : null;
        $T->status      =   (isset($_REQUEST['status']))    ? $_REQUEST['status'] : null;      
        $T->idUsuario   =   (isset($_REQUEST['idUsuario'])) ? $_REQUEST['idUsuario'] : null;
            echo json_encode($T->add());
        break;
    case 'setStatus':
        $T = new Tarefas();
        $T->id      =   (isset($_REQUEST['id']))    ? $_REQUEST['id'] : null;
        $T->status  =   (isset($_REQUEST['status']))    ? $_REQUEST['status'] : null;        
            echo json_encode($T->setStatus());
        break;
    default:
        echo "service Acessos";
        break;
}