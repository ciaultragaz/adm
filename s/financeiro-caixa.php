<?php
switch ($action) {
    case 'atividade':
        $C = new Caixa();
        $C->dia = (isset($_REQUEST['dataSelecionada'])) ? Util::dateToDb($_REQUEST['dataSelecionada']) : null;
        echo json_encode($C->atividadeMotoristas());
        break;
    case 'totais':
        $C = new Caixa();
        $C->periodo = (isset($_REQUEST['periodo'])) ? Util::dateToDb($_REQUEST['periodo']) : null;
        $C->motorista = (isset($_REQUEST['motorista'])) ? $_REQUEST['motorista'] : null;
        echo json_encode($C->totais());
        break;
    case 'getPedidosDetalhesResumo':
        $C = new Caixa();
        $C->dia = (isset($_REQUEST['dia'])) ? Util::dateToDb($_REQUEST['dia']) : null;
        $C->group = (isset($_REQUEST['group'])) ? Util::dateToDb($_REQUEST['group']) : null;
        $C->motorista = (isset($_REQUEST['motorista'])) ? $_REQUEST['motorista'] : null;
        echo json_encode($C->getPedidosDetalhesResumo());
        break;
    case 'getPedidosEnderecos':
        $P = new Pedidos();
        $P->dia = (isset($_REQUEST['dia'])) ? Util::dateToDb($_REQUEST['dia']) : null;
        $P->motorista = (isset($_REQUEST['motorista'])) ? $_REQUEST['motorista'] : null;
        echo json_encode($P->getPedidosEnderecos());
        break;
    }
?>