<?php
switch ($action) {
    case 'getCalendar':
        $motorista = ($_REQUEST['motorista'] !="") ? $_REQUEST['motorista']  :   null;
        $M = new Motoristas();
        $F = new FuncionariosMotoristas();
        $F->motorista = $motorista;
        $get = $F->getByMotorista();

        $M->motorista   =   $motorista;
        $M->year        =   ($_REQUEST['year']      !="") ? $_REQUEST['year']       :   date('Y');
        $M->month       =   ($_REQUEST['month']     !="") ? $_REQUEST['month']      :   date('m');
        $M->idFuncionario = $get['data']['idFuncionario'];
        echo $M->getWorkDays();
        break;
    case 'desempenho':
        $M = new Motoristas();
        $M->motorista   =   ($_REQUEST['motorista'] !="") ? $_REQUEST['motorista']  :   null;
        $M->year        =   (isset($_REQUEST['year'])      !="") ? $_REQUEST['year']       :   date('Y');
        $M->month       =   (isset($_REQUEST['month'])     !="") ? $_REQUEST['month']      :   date('m');
        $M->mesAno      =   $M->month.'-'.$M->year;
        echo json_encode($M->desempenhoMeses());
        break;
    case 'resumoMensal':
        $M = new Motoristas();
        $M->motorista   =   ($_REQUEST['motorista'] !="") ? $_REQUEST['motorista']  :   null;
        $M->year        =   ($_REQUEST['year']      !="") ? $_REQUEST['year']       :   date('Y');
        $M->month       =   ($_REQUEST['month']     !="") ? $_REQUEST['month']      :   date('m');
        echo json_encode($M->resumoMensal());
        break;
    default:
        echo "service Analises";
        break;
}