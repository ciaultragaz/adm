<?php
switch ($action) {
    case 'getRelacionados':
        $M = new Motoristas();
        $F = new Funcionarios();
        $motoristas = $M->showAll();
        $rel = $F->getAllFuncionarioMotorista();
        $rel = $rel['data'];
        $i = 0;
        foreach ($motoristas as $key => $value) {
            $array[$i]['motorista'] = $value;
            foreach ($rel as $k => $v) {
                if($value == $v['motorista']){
                    $array[$i]['idFuncionario'] = $v['idFuncioario'];
                    $array[$i]['nome'] = $v['nome'];
                }
            }
            $i++;
        }
        echo json_encode($array);
        break;
    case 'getFuncsMotoristas':
        $F = new Funcionarios();
        $F->demitidos = false ;
        $F->idCargo = 7 ;
        echo json_encode($F->getAllFuncionarios());
        break;
    case 'set':
        $F = new FuncionariosMotoristas();
        $F->motorista       = (isset($_REQUEST['motorista'])) ? $_REQUEST['motorista'] : null;
        $F->idFuncionario    = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->set());
        break;
    default:
        echo "service Funcionarios Motoristas";
        break;
}