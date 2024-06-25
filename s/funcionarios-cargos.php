<?php
switch ($action) {
    case 'add':
        $Cargos = new Cargos();
        $Cargos->cargo = $_POST['cargo'];
        $Cargos->salario= $_POST['salario'];
        echo json_encode($Cargos->add());
        break;
    case 'delete':
        $idCargo = $_POST['idCargo'];
        $F = new Funcionarios();
        $F->idCargo = $idCargo;
        $data = $F->checkIdCargo();
        if($data['data']['qtd']){
            echo json_encode(array('error'=>false,'data'=>false,'msg'=>'O Cargo não pode ser deletado enquanto existir registros com mesmo!'));
        } else {
            $Cargos = new Cargos();
            $Cargos->id = $idCargo;
            echo json_encode($Cargos->delete());
        }
        break;
    case 'deleteItem':
        $I = new CargosItens();
        $I->id = (isset($_REQUEST['idItem'])) ? $_REQUEST['idItem'] : null;
        echo json_encode($I->disable());
        break;
        case 'edit':
        $C = new Cargos();
        foreach ($_REQUEST['form_'] as $key => $value) {
            if($value['name'] == 'cargo'){
                $C->{$value['name']} = $value['value'];
            } else {
                $valor = $value['value'];
                $valor = str_replace('.', '', $valor);
                $C->{$value['name']} = str_replace(',', '.',$valor);
            }            
        }
        $C->id = (isset($_REQUEST['idCargo'])) ? $_REQUEST['idCargo'] : null;
        //Util::pre($_REQUEST);
        echo json_encode($C->edit());
        break;
    case 'getAll':
        $Cargos = new Cargos();
        //Util::pre($Cargos->getAll());
        echo json_encode($Cargos->getAll());
        break;        
    case 'get':
        $idCargo = $_POST['idCargo'];
        $Cargos = new Cargos();
        $Cargos->id = $idCargo;
        echo json_encode($Cargos->getById());
        break;        
    case 'set':
        $idCargo = $_POST['idCargo'];
        $Cargos = new Cargos();
        $Cargos->id = $idCargo;
        $Cargos->cargo = $_POST['cargo'];
        $Cargos->salario = $_POST['salario'];
        echo json_encode($Cargos->set());
        break;
    case 'setSalario':
        $idCargo = $_POST['idCargo'];
        $Cargos = new Cargos();
        $Cargos->id = $idCargo;
        $Cargos->salario = $_POST['salario'];
        echo json_encode($Cargos->setSalario());
        break;
    case 'setItem':
        $I = new CargosItens();
        $I->idCargo = (isset($_REQUEST['idCargo'])) ? $_REQUEST['idCargo'] : null;
        $I->idTipo = (isset($_REQUEST['idTipo'])) ? $_REQUEST['idTipo'] : null;
        $I->valor = (isset($_REQUEST['value'])) ? $_REQUEST['value'] : 0;
        $I->tipo = (isset($_REQUEST['tipo'])) ? $_REQUEST['tipo'] : null;
        $I->idItem = (isset($_REQUEST['idItem'])) ? $_REQUEST['idItem'] : null;
        $I->habilitado = ($_REQUEST['checked']=='true') ? 1 : 0;
        $I->desconto = ($_REQUEST['desconto']=='true') ? 1 : 0;
        //Util::pre($_REQUEST);
        if($I->idItem=="0"){
            echo json_encode($I->add());
        } else {
            echo json_encode($I->edit());
        }       
        break;
    case 'getItens':
        $I = new CargosItens();
        $I->idCargo = (isset($_REQUEST['idCargo'])) ? $_REQUEST['idCargo'] : null;
        echo json_encode($I->getAllByIdCargo());
        break;
    case 'getTipos':
        $T = new CargosTipos();
        echo json_encode($T->get());
        break;
    case 'getCargosTipos':
        $P = new Parametros();
        $P->tipo = 'cargos';
        echo json_encode($P->getAll());
        break;
    default:
        echo "service Cargos";
        break;
}