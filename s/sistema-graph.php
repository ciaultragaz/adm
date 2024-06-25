<?php
switch ($action) {
    case 'get':
        $G = new Extrato();        
        $data = $G->getGraph();
        foreach ($data['data'] as $key => $value) {
            $v[] = $value['valor'];
        }
        foreach ($data['data'] as $key => $value) {
            $m[] = "Mês ".$value['mes'];
        }
        echo json_encode(array("values"=>$v,"months"=>$m,'total'=>"R$ ".Util::formataMoeda($data['data'][0]['total'])));
        //echo json_encode($G->getGraph());
        break;   
    default:
        echo "service Sistema Graph";
        break;
}