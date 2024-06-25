<?php
$pageSis = 'funcionarios-folgas';
switch ($action) {
    case 'add':
        $F = new Folgas();
        $F->idFuncionario   =   (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $F->dataEvento      =   (isset($_REQUEST['dataEvento'])) ? $_REQUEST['dataEvento'] : null;
        $F->tipo            =   (isset($_REQUEST['tipo'])) ? $_REQUEST['tipo'] : null;
        $F->label           =   (isset($_REQUEST['label'])) ? $_REQUEST['label'] : null;
        $F->obs             =   ($_REQUEST['obs']!="") ? $_REQUEST['obs'] : $F->label;

        if($action == 'set'){
            $F->id          =   (isset($_REQUEST['idFolga'])) ? $_REQUEST['idFolga'] : null;
            echo json_encode($F->set());
        } else {
            $d = $F->check();            
            if($d['total'] >= 1){
                echo json_encode(array('error'=>true,'data'=>$d['data']));
            } else {
                echo json_encode($F->add());
            }
        }
        break;
    case 'calendar':
        $F = new Folgas();
        $pageSis = 'funcionarios-folgas';
        $month = (isset($_SESSION[$pageSis]['month'])) ? $_SESSION[$pageSis]['month'] : date('m');
        $year  = (isset($_SESSION[$pageSis]['year'])) ? $_SESSION[$pageSis]['year'] : date('Y');
        $F->year        =   (isset($_SESSION[$pageSis]['year'])) ? $_SESSION[$pageSis]['year']  :   date('Y');
        $F->month       =   (isset($_SESSION[$pageSis]['month'])) ? $_SESSION[$pageSis]['month']:   date('m');
        echo $F->getDayOff();
        break;
    case 'disable':
        $F = new Folgas();
        $F->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($F->disable());
        break;
    case 'get':
        $F = new Folgas();
        $F->id = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->get());
        break;
    case 'getCalendar':
        $C = new Calendar();

        $mes = ($_REQUEST['mes']!=="0") ? $_REQUEST['mes'] : date('m');
        $ano = ($_REQUEST['ano']!=="0") ? $_REQUEST['ano'] : date('Y');

        $C->month = $mes;
        $C->year = $ano;

        $cal = $C->calendarList();

        $E = new Eventos();
        $E->month = $mes;
        $E->year = $ano;
        $E->idFuncionario = ($_REQUEST['idFuncionario']!=="0") ? $_REQUEST['idFuncionario'] : null;
        $folgas = $E->getByType();

        function btnRemove($id){
            return $btn = "<div class=\"rmv\"><a href=\"javascript:void(0)\" class=\"btnRemove\" data-id=\"$id\" title=\"Deletar\"><i class=\"feather icon-trash-2\"></i></a></div>";
        }
        function btnObs($id){
            return '<div class="obs"><a class="popShow" data-popover-content="#pop-'.$id.'"><i class="feather icon-message-circle"></i></a></div>';
            //return $obs = "<div class=\"obs\"><a class=\"pop-show btnObs\" data-id=\"$id\" data-popover-content=\"#pop-$id\" data-toggle=\"popover\" data-placement=\"right\"><i class=\"feather icon-message-circle\"></i></a></div>";
            //return $obs = "<div class=\"obs\"><a class=\"btnObs\" data-id=\"$id\" title=\"Dismissible popover\" data-toggle=\"popover\" data-trigger=\"focus\" data-content=\"Click anywhere in the document to close this popover\"><i class=\"feather icon-message-circle\"></i></a></obs>";
            //return $obs='<button type="button" class="btn  btn-danger" data-toggle="popover" data-placement="top" title="" data-content="top by popover" data-original-title="popup on top">Top</button>';
            //return $obs = '<a href="#" title=\"<em>popup</em> <u>with</u> <b>HTML</b>\" data-toggle="popover" data-html=\"true\" data-trigger="focus"  data-content=\"popup by HTML\">Click me</a>';
        }
        ?>        
            <?php
                $F = new Folgas();
                $F->month = $C->month;
                $F->year = $C->year;
                $F->idFuncionario = ($_REQUEST['idFuncionario']!=="0") ? $_REQUEST['idFuncionario'] : null;
                $data = $F->getAllByDay();
                
                if($data['total']){
                    $qtdTd = ($data['data']['qtd'] > 10) ? $data['data']['qtd'] : 10 ;
                    $currentTd = 0;
                    foreach ($cal as $key => $value) {
                        $dayOfWeek = ($value['dayOfWeek'] == "Domingo") ? "<span class=\"text-danger\">".$value['dayOfWeek']."</span>" : $value['dayOfWeek'];
                        echo "<tr class=\"day-".$value['dayOfWeekNumber']."\"><td  class=\"day\">".$value['day']."</td><td>".$dayOfWeek."</td>";
                        if(isset($folgas[$value['completeDay']])){
                            $td = $qtdTd;
                            $i = 0;
                            foreach ($folgas[$value['completeDay']] as $k => $v) {                                
                                echo "<td class=\"comum\" style=\"background-color:".$v['color']."; color:".Util::color_inverse($v['color'])."\" data-position=\"".$currentTd."\"><div class=\"flg\"><div class=\"funcionario\">".strtoupper($v['nome'])."</div>".btnRemove($v['id'])."".btnObs($v['id'])."</div></td>";
                                --$td;
                                $i++;
                                $currentTd++;
                            }
                            for($i = $i; $i < $qtdTd; $i++ ){
                                echo "<td class=\"comum vago\" data-date=\"".$value['completeDay']."\" data-position=\"".$currentTd."\"></td>";
                                $currentTd++;
                            }
                        } else {
                            for ($i = 0; $i < $qtdTd; $i++) { 
                                echo "<td class=\"comum vago\" data-date=\"".$value['completeDay']."\" data-position=\"".$currentTd."\"></td>";
                                $currentTd++;
                            }
                        }
    
                        echo "</tr>";
                        $currentTd = 0;                        
                    }
                } else {
                    echo "<tr><td colspan=\"10\" style=\"text-align:center\">Sem Dados</td></tr>";
                }     
            ?>
    <?php
        break;
    case 'getAllFuncionarios':
        $F = new Funcionarios();
        $F->idCargo = false;
        $F->demitidos = true;
        echo json_encode($F->getAllFuncionarios());
        break;
    case 'getFuncionariosFolga':
        $F = new Folgas();
        $F->year            =   ($_REQUEST['year']      !="0")        ? $_REQUEST['year']           :   date('Y');
        $F->month           =   ($_REQUEST['month']     !="0")        ? $_REQUEST['month']          :   date('m');
        $F->filterDay       =   (isset($_REQUEST['filterDay']))       ? $_REQUEST['filterDay']      :   null;
        $F->idFuncionario   =   (isset($_REQUEST['idFuncionario']))   ? $_REQUEST['idFuncionario']  :   null;
        $F->idCargo         =   (isset($_REQUEST['idCargo']))         ? $_REQUEST['idCargo']        :   null;
        $F->types           =   (isset($_REQUEST['types']))           ? implode(",",$_REQUEST['types']) : null;
        echo json_encode($F->getFuncionarios());
        break;
    case 'set':
        $F = new Folgas();
        foreach ($_REQUEST['data'] as $key => $value) {
            $F->{$value['name']} = $value['value'];
        }
        echo json_encode($F->set());   
        break;
    default:
        echo "service Folgas";
        break;
}