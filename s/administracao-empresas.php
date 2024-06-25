<?php
switch ($action) {
    case 'getAll':
        $E = new Empresas();
        $E->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $E->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $E->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $E->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $E->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($E->getAll());
        break;
    case 'add':
    case 'set':
        $E = new Empresas();
        $E->razao           =   (isset($_REQUEST['razao'])) ? $_REQUEST['razao'] : null;
        $E->fantasia        =   (isset($_REQUEST['fantasia'])) ? $_REQUEST['fantasia'] : null;
        $E->cnpj            =   (isset($_REQUEST['cnpj'])) ? $_REQUEST['cnpj'] : null;
        $E->ie              =   (isset($_REQUEST['ie'])) ? $_REQUEST['ie'] : null;
        $E->codMunicipal    =   (isset($_REQUEST['codMunicipal'])) ? $_REQUEST['codMunicipal'] : null;      
        $E->codAtividade    =   (isset($_REQUEST['codAtividade'])) ? $_REQUEST['codAtividade'] : null;      
        $E->endereco        =   (isset($_REQUEST['endereco'])) ? $_REQUEST['endereco'] : null;  
        $E->numero          =   (isset($_REQUEST['numero'])) ? $_REQUEST['numero'] : null;
        $E->complemento     =   (isset($_REQUEST['complemento'])) ? $_REQUEST['complemento'] : null;  
        $E->bairro          =   (isset($_REQUEST['bairro'])) ? $_REQUEST['bairro'] : null;
        $E->cidade          =   (isset($_REQUEST['cidade'])) ? $_REQUEST['cidade'] : null;
        $E->uf              =   (isset($_REQUEST['uf'])) ? $_REQUEST['uf'] : null;
        $E->cep             =   (isset($_REQUEST['cep'])) ? $_REQUEST['cep'] : null;
        $E->idParametro     =   (isset($_REQUEST['idParametro'])) ? $_REQUEST['idParametro'] : null;
        if($action == 'set'){
            $E->id          =   (isset($_REQUEST['idEmpresa'])) ? $_REQUEST['idEmpresa'] : null;
            echo json_encode($E->set());
        } else {
            echo json_encode($E->add());
        }
        
        break;
    case 'get':
        $E = new Empresas();
        $E->id = (isset($_REQUEST['idEmpresa'])) ? $_REQUEST['idEmpresa'] : null;
        echo json_encode($E->getById());
        break;
    default:
        echo "service Empresas";
        break;
}