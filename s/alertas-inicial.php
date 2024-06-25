<?php

switch ($action) {
    case 'getAll':
        $F = new Funcionarios();
        $f = $F->alertDataAdmissao();
        $i =0;
        $alerts = array();
        $erro = 0;
        if(!$f['error']){ 
            if($f['data']['qtd']){
                $alerts[$i]['erro'] = $erro;
                $alerts[$i]['module'] = 'Funcionários';
                $alerts[$i]['type'] = 'Sem Data de Admissao';
                $alerts[$i]['link'] = '/funcionarios/cadastros';
                $alerts[$i]['qtd'] = $f['data']['qtd'];
                $i++;
            }            
        } else {
            $erro = 1;
            $alerts[$i]['erro'] = $erro;
            $alerts[$i]['module'] = 'Funcionários';
            $alerts[$i]['type'] = 'Sem Data de Admissao';
            $alerts[$i]['qtd'] = 0;
            $i++;
        }
        echo json_encode(array('error'=>$erro,'data'=>$alerts));
        break;   
    default:
        echo "service Alerts";
        break;
}