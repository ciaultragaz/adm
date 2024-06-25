<?php
switch ($action) {
    case 'add':
    case 'set':
        $F = new Funcionarios();
        $F->idCargo                     = (isset($_REQUEST['idCargo'])) ? $_REQUEST['idCargo'] : null;
        $F->dataExame                   = (isset($_REQUEST['dataExame'])) ? Util::dateToDb($_REQUEST['dataExame']) : null;
        $F->apelido                     = (isset($_REQUEST['apelido']))                   ? $_REQUEST['apelido'] : null;
        $F->dataAdmissao                = (isset($_REQUEST['dataAdmissao']))              ? Util::dateToDb($_REQUEST['dataAdmissao']) : 'NULL';
        $F->dataDemissao                = (isset($_REQUEST['dataDemissao']))              ? Util::dateToDb($_REQUEST['dataDemissao']) : 'NULL';
        $F->dataContrata                = (isset($_REQUEST['dataContrata']))              ? Util::dateToDb($_REQUEST['dataContrata']) : 'NULL';
        $F->tipoPagto                   = (isset($_REQUEST['tipoPagto']))                 ? $_REQUEST['tipoPagto'] : null;
        $F->horasSemanais               = (isset($_REQUEST['horasSemanais']))             ? $_REQUEST['horasSemanais'] : null;
        $F->horasMensais                = (isset($_REQUEST['horasMensais']))              ? $_REQUEST['horasMensais'] : null;
        $F->nome                        = (isset($_REQUEST['nome']))                      ? $_REQUEST['nome'] : null;
        $F->celular                     = (isset($_REQUEST['celular']))                   ? $_REQUEST['celular'] : null;
        $F->idEmpresa                   = (isset($_REQUEST['idEmpresa']))                 ? $_REQUEST['idEmpresa'] : null;
        $F->dataNascimento              = (isset($_REQUEST['dataNascimento']))            ? Util::dateToDb($_REQUEST['dataNascimento']) : null;
        $F->genero                      = (isset($_REQUEST['genero']))                    ? $_REQUEST['genero'] : null;
        $F->natural                     = (isset($_REQUEST['natural']))                   ? $_REQUEST['natural'] : null;
        $F->nacionalidade               = (isset($_REQUEST['nacionalidade']))             ? $_REQUEST['nacionalidade'] : null;
        $F->idEscolaridade              = (isset($_REQUEST['idEscolaridade']))            ? $_REQUEST['idEscolaridade'] : null;
        $F->idEstadoCivil               = (isset($_REQUEST['idEstadoCivil']))             ? $_REQUEST['idEstadoCivil'] : null;
        $F->cep                         = (isset($_REQUEST['cep']))                       ? $_REQUEST['cep'] : null;
        $F->rua                         = (isset($_REQUEST['rua']))                       ? $_REQUEST['rua'] : null;
        $F->numero                      = (isset($_REQUEST['numero']))                    ? $_REQUEST['numero'] : null;
        $F->complemento                 = (isset($_REQUEST['complemento']))               ? $_REQUEST['complemento'] : null;
        $F->bairro                      = (isset($_REQUEST['bairro']))                    ? $_REQUEST['bairro'] : null;
        $F->cidade                      = (isset($_REQUEST['cidade']))                    ? $_REQUEST['cidade'] : null;
        $F->uf                          = (isset($_REQUEST['uf']))                        ? $_REQUEST['uf'] : null;
        $F->mae                         = (isset($_REQUEST['mae']))                       ? $_REQUEST['mae'] : null;
        $F->pai                         = (isset($_REQUEST['pai']))                       ? $_REQUEST['pai'] : null;
        $F->rg                          = (isset($_REQUEST['rg']))                        ? $_REQUEST['rg'] : null;
        $F->rne                         = (isset($_REQUEST['rne']))                       ? $_REQUEST['rne'] : null;
        $F->visto                       = (isset($_REQUEST['visto']))                     ? $_REQUEST['visto'] : null;
        $F->dataCadastroRG              = (isset($_REQUEST['dataCadastroRG']))            ? Util::dateToDb($_REQUEST['dataCadastroRG']) : null;
        $F->orgaoExpeditor              = (isset($_REQUEST['orgaoExpeditor']))            ? $_REQUEST['orgaoExpeditor'] : null;
        $F->ufRG                        = (isset($_REQUEST['ufRG']))                      ? $_REQUEST['ufRG'] : null;
        $F->habilitacao                 = (isset($_REQUEST['habilitacao']))               ? $_REQUEST['habilitacao'] : null;
        $F->idCategoriaCnh              = (isset($_REQUEST['idCategoriaCnh']))            ? $_REQUEST['idCategoriaCnh'] : null;
        $F->dataVencimentoHabilitacao   = (isset($_REQUEST['dataVencimentoHabilitacao'])) ? Util::dateToDb($_REQUEST['dataVencimentoHabilitacao']) : null;
        $F->dataVencimentoVisto         = (isset($_REQUEST['dataVencimentoVisto']))       ? Util::dateToDb($_REQUEST['dataVencimentoVisto']) : null;
        $F->docMilitar                  = (isset($_REQUEST['docMilitar']))                ? $_REQUEST['docMilitar'] : null;
        $F->docNumMilitar               = (isset($_REQUEST['docNumMilitar']))             ? $_REQUEST['docNumMilitar'] : null;
        $F->catDocMilitar               = (isset($_REQUEST['catDocMilitar']))             ? $_REQUEST['catDocMilitar'] : null;
        $F->ctps                        = (isset($_REQUEST['ctps']))                      ? $_REQUEST['ctps'] : null;
        $F->dataExpedicaoCtps           = (isset($_REQUEST['dataExpedicaoCtps']))         ? Util::dateToDb($_REQUEST['dataExpedicaoCtps']) : null;
        $F->pis                         = (isset($_REQUEST['pis']))                       ? $_REQUEST['pis'] : null;
        $F->dataCadastroPis             = (isset($_REQUEST['dataCadastroPis']))           ? Util::dateToDb($_REQUEST['dataCadastroPis']) : null;
        $F->titulo                      = (isset($_REQUEST['titulo']))                    ? $_REQUEST['titulo'] : null;
        $F->zona                        = (isset($_REQUEST['zona']))                      ? $_REQUEST['zona'] : null;
        $F->secao                       = (isset($_REQUEST['secao']))                     ? $_REQUEST['secao'] : null;
        $F->cpf                         = (isset($_REQUEST['cpf']))                       ? $_REQUEST['cpf'] : null;
        $F->optante                     = (isset($_REQUEST['optante']))                   ? $_REQUEST['optante'] : null;
        $F->dataOpcao                   = (isset($_REQUEST['dataOpcao']))                 ? Util::dateToDb($_REQUEST['dataOpcao']) : null;
        $F->dataRetratacao              = (isset($_REQUEST['dataRetratacao']))            ? Util::dateToDb($_REQUEST['dataRetratacao']) : null;
        $F->bcoDepositario              = (isset($_REQUEST['bcoDepositario']))            ? $_REQUEST['bcoDepositario'] : null;
        $F->idFuncionario               = (isset($_REQUEST['idFuncionario']))             ? $_REQUEST['idFuncionario'] : null;
        if($F->idFuncionario=="0"){
            echo json_encode($F->add());
        } else {
            $F->id =  $F->idFuncionario;
            echo json_encode($F->set());
        }
        
        break;    
    case 'getAll':
        $F = new Funcionarios();
        $F->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $F->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $F->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $F->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $F->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $F->filterCargo = (isset($_REQUEST['filterCargo'])) ? $_REQUEST['filterCargo'] : null;
        $F->demitidos   = (isset($_REQUEST['showDemitidos'])) ? $_REQUEST['showDemitidos'] : null;
        $F->filterDataAdmissao   = (isset($_REQUEST['filterDataAdmissao'])) ? $_REQUEST['filterDataAdmissao'] : null;
        echo json_encode($F->getAll());
        break;
    case 'getAvatar':
        $F = new FuncionariosAvatar();        
        $F->idFuncionario =  (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->get());
        break;
    case 'addAvatar':
        $FA = new FuncionariosAvatar();
        $FA->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $FA->avatar = (isset($_REQUEST['avatar'])) ? $_REQUEST['avatar'] : null;
        echo json_encode($FA->add());
        break;
    case 'addChild':
        $form = (isset($_REQUEST['form'])) ? $_REQUEST['form'] : null;
        $i = 0 ;
        foreach ($form as $key => $value) {
            if($value['name']=="nomeBen"){
                $data[$i]['nome'] =  $value['value'];
            }
            if($value['name']=="cpfBen"){
                $data[$i]['cpf'] =  $value['value'];
            }
            if($value['name']=="rgBen"){
                $data[$i]['rg'] =  $value['value'];
            }
            if($value['name']=="dtNasc"){
                $data[$i]['nasc'] =  Util::dateToDb($value['value']);
                $i++;
            }        
        }
        $FB = new FuncionariosBeneficiarios();
        $FB->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $FB->beneficiarios = $data;
        echo json_encode($FB->add());
        break;
    case 'addFile':
        $FF = new FuncionariosFiles();
        $FF->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $FF->file = (isset($_REQUEST['nameFile'])) ? $_REQUEST['nameFile'] : null;
        $FF->type = (isset($_REQUEST['typeFile'])) ? $_REQUEST['typeFile'] : null;
        echo json_encode($FF->add());
        break;
    case 'getById':
        $F = new Funcionarios();
        $F->id =  (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->getById());
        break;
    case 'getChilds':
        $FB = new FuncionariosBeneficiarios();
        $FB->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($FB->getAllById());
        break;
    case 'getAllFilesById':
        $FF = new FuncionariosFiles();
        $FF->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($FF->getAllByIdFuncionario());
        break;
    case 'rmvFile':
        $FF = new FuncionariosFiles();
        $FF->id = (isset($_REQUEST['idFile'])) ? $_REQUEST['idFile'] : null;
        echo json_encode($FF->rmv());
        break;
    case 'changeColor':
        $F = new Funcionarios();
        $F->id =  (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $F->color =  (isset($_REQUEST['color'])) ? $_REQUEST['color'] : null;
        echo json_encode($F->setColor());
        break;
    case 'deleteChild':
        $FB = new FuncionariosBeneficiarios();
        $FB->idChild = (isset($_REQUEST['idChild'])) ? $_REQUEST['idChild'] : null;
        echo json_encode($FB->delete());
        break;
    case 'changeName':
        $FB = new FuncionariosBeneficiarios();
        $FB->idChild = (isset($_REQUEST['idChild'])) ? $_REQUEST['idChild'] : null;
        $FB->nome = (isset($_REQUEST['nome'])) ? $_REQUEST['nome'] : null;
        echo json_encode($FB->changeName());
        break;
    case 'changeCpf':
        $FB = new FuncionariosBeneficiarios();
        $FB->idChild = (isset($_REQUEST['idChild'])) ? $_REQUEST['idChild'] : null;
        $FB->cpf = (isset($_REQUEST['cpf'])) ? $_REQUEST['cpf'] : null;
        echo json_encode($FB->changeCpf());
        break;
    case 'changeRg':
        $FB = new FuncionariosBeneficiarios();
        $FB->idChild = (isset($_REQUEST['idChild'])) ? $_REQUEST['idChild'] : null;
        $FB->rg = (isset($_REQUEST['rg'])) ? $_REQUEST['rg'] : null;
        echo json_encode($FB->changeRg());
        break;
    case 'changeNascimento':
        $FB = new FuncionariosBeneficiarios();
        $FB->idChild = (isset($_REQUEST['idChild'])) ? $_REQUEST['idChild'] : null;
        $FB->nascimento = (isset($_REQUEST['nascimento'])) ? Util::dateToDb($_REQUEST['nascimento']) : null;
        echo json_encode($FB->changeNascimento());
        break;
    default:
        echo "service Funcionários";
        break;
}