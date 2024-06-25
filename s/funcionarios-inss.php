<?php
switch ($action) {
    case 'add':
        //Util::pre($_REQUEST);
        $form = $_REQUEST['form'];
        $arr =[];
        $index = 0;
        for($i=0;$i<count($form);$i++){
            //$form[$i]['name']=>$form[$i]['value'];
            $arr[$index][$form[$i]['name']] = $form[$i]['value'];            
            if($form[$i]['name']=="desc"){
                $index++;
            }
        }        
        $tabela = json_encode($arr);
        $dataPublica = Util::dateToDb($_REQUEST['dataVigencia']);
        $I = new Inss();
        $I->tabela = $tabela;
        $I->dataPublica = $dataPublica;
        echo json_encode($I->add());
        break;
    case 'get':
        $I = new Inss(); 
        $dados = $I->getInss();
        $tabela = json_decode($dados['data']['tabela']);
        echo json_encode(array('table'=>$tabela,'data'=>$dados['data']));
        break;   
    default:
        echo "service Acessos";
        break;
}