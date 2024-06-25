<?php
switch ($action) {
    case 'getAll':
        $C = new Clientes();
        $C->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 20;
        $C->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $C->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $C->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $C->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $C->bairros = (isset($_REQUEST['bairros'])) ? $_REQUEST['bairros'] : '';
        $C->tipos = (isset($_REQUEST['tipos'])) ? $_REQUEST['tipos'] : '';
        $C->ceps = (isset($_REQUEST['ceps'])) ? $_REQUEST['ceps'] : '';
        $C->localizados = (isset($_REQUEST['localizados'])) ? $_REQUEST['localizados'] : '';
        echo json_encode($C->getPages());
    break;
    case 'set':            
        $C = new Clientes();
        foreach ($_REQUEST['data'] as $key => $value) {
            $C->{$value['name']} = $value['value'];
        }
        echo json_encode($C->set());            
    break;
    case 'get':
        $C = new Clientes();
        $C->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
        echo json_encode($C->get());
    break;
    case 'getToEdit':
        $C = new Clientes();
        $C->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
        echo json_encode($C->get());
    break;
    case 'getMemo':
        $C = new Clientes();
        $C->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
        echo json_encode($C->memo());
    break;
    case 'delete':
        $A = new Automoveis();
        $A->id = (isset($_REQUEST['idCarro'])) ? $_REQUEST['idCarro'] : null;
        echo json_encode($A->disable());
    break;
    case 'getCount':
        $C = new Clientes();
        echo json_encode($C->getCount());
    break;
    case 'getCountLocal':
        $C = new Clientes();
        echo json_encode($C->getCountLocal());
    break;
    case 'getAllPhones':
        $T = new Telefones();
        $T->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
        $d = $T->getAll();            
        $C = new Clientes();
        $C->codigo = $T->codigo;
        $c = $C->get();
        $c = $c['data'];
        $bairro = ($c['Bairro'] == '') ? '(SEM BAIRRO DEFINIDO)' : $c['Bairro'];
        $endereco = ($c['End_complemento']!='') ? ''.$c['Endereço'] . ' , (' . $c['End_numero'] . ')'. ' [ ' . $c['End_complemento'] . ' ]' : $c['Endereço'] . ' , (' . $c['End_numero'] . ')';
        ?>
            <div class="infoClientes">
               <i class="fas fa-map-marked-alt"></i> <?php echo $endereco;?>
            </div>
            <div class="divContPhone">
                <?php 
                    if($d['total']=="0"){
                        echo $d['msg'];
                    } else {
                        $d = $d['data'];
                        foreach ($d as $key => $value) {
                            echo "(".$value['DDD'].") ".$value['Prefixo']."-".$value['Milhar']."<br>";
                        }
                    }
                ?>
            </div>
        <?php
    break;
    case 'latlong':
        $C = new Clientes();
        $C->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : null;
        echo json_encode($C->latlong());
    break;            
    default:
        echo "service Automóveis";
    break;
}