<?php
switch ($action) {
    case 'add':
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $form = $_REQUEST['form'];
        $countDay = 0;
        $countEvent = 0;
        for($i=0;$i<count($form);$i++){
            $day[$countDay][$countEvent] = $form[$i]['value'];
            $countEvent++;
            if($countEvent==4){
                $countDay++;
                $countEvent=0;
            }        
        }
        $F = new FuncionariosTurnos();
        $F->idFuncionario = $idFuncionario;
        $F->id = $idFuncionario;
        $F->delete();
        $i = 0;
        foreach ($day as $key => $value) {
            $F->turnos = array($idFuncionario,$key,$value[0],$value[1],$value[2],$value[3]);
            $d = $F->add();
            if($d['error']){
                echo json_encode(array('error'=>true, 'msg'=>'Ocorreu um erro Service Add Turnos', 'total'=>0));
            }
        }
        echo json_encode(array('error'=>false, 'msg'=>'Cadastro efetivado!', 'total'=>$i));
        break;
    case 'get':
        $F = new FuncionariosTurnos();
        $F->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->get());
        break;
    case 'calendar-get':
        $C = new Calendar();
        $C->initDay = '2020-11-25';
        $C->month = (isset($_REQUEST['month'])) ? ($_REQUEST['month'] =="") ? date('m') : $_REQUEST['month'] : date('m');
        $C->year = (isset($_REQUEST['year'])) ? ($_REQUEST['year'] =="") ? date('Y') :$_REQUEST['year'] : date('Y');
        $calendar = $C->calendar12x36();
        echo $calendar['calendar'];
        break;
    default:
        echo "service Funcionários Turno";
        break;
}