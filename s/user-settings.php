<?php
switch ($action) {
    case 'toggleMenu':
        $toggleMenu = ($toggleMenu==1) ? 0 : 1;        
        $U = new UserSettings();
        $U->idUser = $idUser;
        $U->toggle = $toggleMenu;
        $_SESSION['toggleMenu'] = $toggleMenu;
        echo json_encode($U->setMenuToggle());
        break;
    case 'setDate':
        $page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : NULL;
        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : NULL;
        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : NULL; 
        $_SESSION[$page]['month'] = $month;
        $_SESSION[$page]['year'] = $year;
        break;
    default:
        echo "service User Settings";
        break;
}