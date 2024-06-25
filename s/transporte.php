<?php
require_once('../_config.php');
?>
<style>
    #tableModal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tableModal td, #tableModal th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tableModal tr:nth-child(even){background-color: #f2f2f2;}

#tableModal tr:hover {background-color: #ddd;}

#tableModal th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<?php
//        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
//        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
//        $idPonto = (isset($_REQUEST['idPonto'])) ? $_REQUEST['idPonto'] : null;
function AddPlayTime($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    if(is_array($times)){
        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $subtract = (substr($hour,0,1)=="-") ? '-':'';
            $minutes += $hour * 60;
            $minutes += $subtract.$minute;
        }
    
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;
    
        // returns the time already formatted
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
function intervalo($horas){
    $seconds = 0;
     foreach ( $horas as $hora ) {
            list( $g, $i, $s ) = explode( ':', $hora );
            if ($g < 0) {
                $i *= -1;
                $s *= -1;
            }
            $seconds += $g * 3600;
            $seconds += $i * 60;
            $seconds += $s;
        }
            $hours    = floor( $seconds / 3600 );
            $seconds -= $hours * 3600;
            $minutes  = floor( $seconds / 60 );
            $seconds -= $minutes * 60;
            return "{$hours}:{$minutes}:{$seconds}"; 
 }
function convertToHour($time){
    //$time = strtotime($time);
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours.":".$minutes;
}
function convertStrTimeToHour($total){
    $hours      = Util::lpad(floor($total/ 60 / 60));
    $minutes    = Util::lpad(round(($total - ($hours * 60 * 60)) / 60));
    return $hours.":".$minutes;
}
function calcHours($time1,$time2){
    $entrada = $time1;
    $saida = $time2;
    $hora1 = explode(":",$entrada);
    $hora2 = explode(":",$saida);
    $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
    $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
    $resultado = $acumulador2 - $acumulador1;
    $hora_ponto = floor($resultado / 3600);
    $resultado = $resultado - ($hora_ponto * 3600);
    $min_ponto = floor($resultado / 60);
    $resultado = $resultado - ($min_ponto * 60);
    $secs_ponto = $resultado;
    //Grava na variável resultado final
    return $tempo = Util::lpad($hora_ponto).":".Util::lpad($min_ponto).":".Util::lpad($secs_ponto);
}
function formatHour($hour){
    return substr($hour,0,5);
}
        $month = 3;
        $year = 2021;
        //Abel
        $idPonto = 29;
        //Pessa
        //$idPonto = 24;
        //Kauã
        //$idPonto = 49;
        //Stori
        //$idPonto = 33;
        //Geraldo
        //$idPonto = 27;
        //Bruno
        //$idPonto = 15;
        //Paulo
        //$idPonto = 4;
        $H = new FuncionariosHoras();
        $H->month = $month;
        $H->year = $year;
        $H->idPonto = $idPonto;
        $data = $H->hours();
        $dadosIdFuncionario = $H->funcionario();

        if($dadosIdFuncionario['error']){
            echo $dadosIdFuncionario['msg'];
        } else {
            
            $idFuncionario = $dadosIdFuncionario['data']['id'];
            $Funcionario = new Funcionarios();
            $Funcionario->id = $idFuncionario;
            $dadosFuncionario = $Funcionario->getById();
            $funcionario = $dadosFuncionario['data'];

            if($funcionario['idCargo']==7){
                $M = new FuncionariosMotoristas();
                $M->idFuncionario = $idFuncionario;
                $dadosMotorista = $M->getByIdFuncionario();
                $motorista = $dadosMotorista['data'];
                $motorista = $motorista['motorista'];
                $Mot = new Motoristas();
                $Mot->year = $year;
                $Mot->month = $month;
                $Mot->motorista = $motorista;
                $dadosDayWorked = $Mot->getDaysWorked();
                if($dadosDayWorked['total']>0){
                    $daysWorked = $dadosDayWorked['data'];
                    $daysWork = array();
                    foreach ($daysWorked as $key => $value) {
                        $daysWork[$value['workDay']]['day'] = $value['workDay'];
                        $daysWork[$value['workDay']]['pedidos'] = $value['qtd'];
                    }
                }
                $P = new Pedidos();
                $P->motorista = $motorista;
                $P->year = $year;
                $P->month = $month;
                $dataWarninngPedidos = $P->getDuplicados();
                if($dataWarninngPedidos['total']>0){
                    $warningPedidos = $dataWarninngPedidos['data'];                
                    $warningsDays = array();
                    foreach ($warningPedidos as $key => $value) {
                        $warningsDays[$value['Data']] = 1;
                    }
                }
            }

            $F = new Folgas();
            $F->year            =   $year;
            $F->month           =   $month;
            $F->idFuncionario   =   $idFuncionario;
            $F->filterDay       = null;
            $F->idCargo         = null;
            $F->types           = null;
            $dadosFolga = $F->getByIdFuncionario();

            $Feriados = new Eventos();
            $Feriados->year    = $year;
            $Feriados->month   = $month;
            $dadosFeriados = $Feriados->feriados();

            if($dadosFolga['total'] > 0 && $dadosFeriados['total'] > 0){
                $dadosFolga['data'] = array_merge($dadosFeriados['data'], $dadosFolga['data']);
            } else if($dadosFolga['total'] > 0 && $dadosFeriados['total'] == 0) {
                $dadosFolga = $dadosFolga;
            } else {
                $dadosFolga = array('total'=>1,'error'=>false,'data'=>$dadosFeriados['data']);
            }
            if($dadosFolga['error']){
                echo $dadosFolga['msg'];
            } else {
                if($dadosFolga['total']){
                    $folgasMysql = $dadosFolga['data'];
                    $folgas = array();
                    foreach ($folgasMysql as $key => $value) {
                        $folgas[$value['dataEvento']]['dataEvento'] = $value['dataEvento'];
                        $folgas[$value['dataEvento']]['idRef'] = $value['idRef'];
                        $folgas[$value['dataEvento']]['coment'] = $value['evento'];
                        $folgas[$value['dataEvento']]['tipo'] = $value['parametro'];
                        $folgas[$value['dataEvento']]['user'] = $value['user'];
                        $folgas[$value['dataEvento']]['idAction'] = $value['idAction'];
                    }
                }
            }
        }
        if($data['error']){
            echo $data['msg'];
        } else { ?>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <table id="tableModal" class="table table-striped table-bordered nowrap dataTable">
                        <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Dia da semana</th>
                                <th>Evento</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th>Total</th>
                                <?php if(isset($funcionario['idCargo'])){ 
                                        if($funcionario['idCargo']==7){ ?> <th>*<i class="feather icon-shopping-cart"></i></th> <?php } ?>
                                <?php } ?>
                                <th>x<i class="feather icon-plus-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $horas = $data['data'];
                                $times = array();
                                $timesOfMonth = array();
                                $totalOfTimes = array();
                                $erros = array();
                                
                                $qtdDiaria = 0;

                                $T = new Turnos();
                                $T->id = $funcionario['idTurno'];
                                $dataTurnos = $T->get();
                                $turno = $dataTurnos['data'];
                                $tdSuccess = "<td><i class=\"feather icon-check text-success\"></i></td>";
                                foreach ($horas as $key => $value) {
                                    $index = $value['data'];
                                    $tdWarning = "<td><a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                    if($funcionario['idCargo']==7){
                                        if(isset($daysWork[$index])){
                                            $classTextPedidos = ($value['weekDay']==6) ? 'text-danger' : '';
                                            $classTextPedidos = (isset($warningsDays[$index])) ? 'text-warning':$classTextPedidos;
                                            $tdPedidos =  "<td><a href=\"javascript:void(0)\" class=\"viewPedidos $classTextPedidos\" data-date=\"$index\" data-funcionario=\"$idFuncionario\" data-tab=\"profile\">".Util::lpad($daysWork[$index]['pedidos'])."</a></td>";
                                        } else {
                                            $tdPedidos =  "<td><i class=\"feather icon-slash\" style=\"color: #833838 !important;\" title=\"Não houve vendas no dia !\"></i></td>";
                                        }
                                    }                                    
                                    $time1 = 0;
                                    $time2 = 0;
                                    $classType = '';
                                    $extra = array();
                                    switch ($value['weekDay']) {
                                        default:
                                            $hoursDiff = $turno['qtdHorasSegSex'];
                                            $hoursDiffFormated = ($hoursDiff).":00:00";
                                            $horasPorDia = ($hoursDiff-1);
                                            $timesOfMonth[] = ($hoursDiff-1).":00:00";
                                            break;
                                        case 5:
                                            $hoursDiff = $turno['qtdHorasSabado'];
                                            $hoursDiffFormated = ($hoursDiff).":00:00";
                                            $horasPorDia = ($hoursDiff);
                                            $timesOfMonth[] = ($hoursDiff).":00:00";
                                            break;
                                        case 6:
                                            $horasPorDia = "0";
                                            break;                                            
                                    }
                                    if(isset($folgas[$index]['idRef'])){
                                        switch ($folgas[$index]['idRef']) {
                                            case '13':
                                            case '18':
                                                $classType = 'text-success';
                                                break;
                                            case '21':
                                                $classType = 'text-info';
                                                break;
                                            case '22':
                                                $classType = 'text-warning';
                                                break;
                                            case '26':
                                                $classType = 'text-purple';
                                                break;
                                            default:
                                                $classType = '' ;
                                                break;
                                        }
                                    }
                                    $classText = ($value['weekDay']==6) ? 'text-danger' : $classType ;
                                    $diaria    = (isset($folgas[$index]['idRef'])==13) ? true:false ;
                                    $folga     = (isset($folgas[$index]['idRef'])==18) ? true:false ;
                                    $falta     = (isset($folgas[$index]['idRef'])==22) ? true:false ;
                                    $evento    = (isset($folgas[$index]['tipo'])) ? '<a title="'.$folgas[$index]['user'].'">'.$folgas[$index]['tipo'].'</a>' : '<a href="javascript:void(0)" title="Adicionar Evento"><i class="feather icon-calendar"></i></a>' ;
                                    $dataDia   = $value['dataFormat'];
                                    echo "<tr class=\"".$classText."\"><td>".$dataDia."</td><td>".$value['nameDayOfWeek']."</td><td>$evento</td>";
                                    if(isset($value['hora'])){
                                        $hora   = explode(',',$value['hora']);
                                        $sis    = explode(',',$value['sistema']);
                                        $idHour = explode(',',$value['idHour']);
                                        for($i=0;$i<count($hora);$i++){
                                            if($i==0){
                                                $time1  = ($hora[$i]);
                                                $de     = '06:00:00';
                                                $ate    = '08:05:00';
                                                $beet   = (Util::TimeIsBetweenTwoTimes($de,$ate,$time1))?'08:00:00':$time1;
                                                $time1  = $beet;
                                                echo "<td><a href=\"javascript:deleteHour(".$idHour[$i].")\">".($hora[$i])."</a></td>";
                                            }
                                            if($i == count($hora)-1){
                                                $time2 = ($hora[$i]);
                                                echo "<td><a href=\"javascript:deleteHour(".$idHour[$i].")\">".$time2."</a></td>";
                                                if(!$diaria){
                                                    $totalHoras = calcHours($time1,$time2);
                                                    $horasExtras = (calcHours($hoursDiffFormated,$totalHoras) < 0)?'00:00:00':calcHours($hoursDiffFormated,$totalHoras);
                                                    $totalExtras[] = $horasExtras;
                                                    $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                    $aa = intervalo($trabalhadas);
                                                    $bb = intervalo($timesOfMonth);
                                                    echo "<td>".intervalo($totalExtras)."</td>";
                                                    if($funcionario['idCargo']==7){
                                                        if(isset($daysWork[$index])){
                                                            echo $tdPedidos;
                                                        }
                                                    }
                                                    echo $tdSuccess;
                                                }
                                                
                                            }
                                        }
                                    } else {
                                        $defaultLine = "<td>00:00</td><td>00:00</td><td>00:00</td>";
                                        if($funcionario['idCargo']==7){
                                            $defaultLine = $defaultLine.$tdPedidos;
                                        }   
                                        if(isset($folgas[$index]['idRef'])){
                                            switch ($folgas[$index]['idRef']) {
                                                case '22':
                                                    $date = new DateTime('08:00:00');
                                                    $date->add(new DateInterval('PT'.$hoursDiff.'H'));
                                                    $horaSaida = $date->format('H:i');
                                                    $totalHoras = calcHours('08:00:00',$horaSaida);
                                                    $horasExtras = '00:00:00';
                                                    $totalExtras[] = $horasExtras;
                                                    $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                    echo "<td> 08:00:00</td>";
                                                    echo "<td> 08:00:00</td>";
                                                    echo "<td> ".$horaSaida."</td>";
                                                    echo "<td>".$horasExtras."</td>";
                                                    echo "<td>".$horasExtras."</td>";
                                                    echo "<td>".intervalo($trabalhadas)."</td>";
                                                    $aa = intervalo($trabalhadas);
                                                    $bb = intervalo($timesOfMonth);
                                                    echo "<td>".intervalo($totalExtras)."</td>";
                                                    echo "<td>".calcHours($bb,$aa)."</td>";
                                                    echo "<td>".intervalo($timesOfMonth)."</td>";
                                                    if($funcionario['idCargo']==7){
                                                        echo $tdPedidos;
                                                    }
                                                    break;
                                                case '18':
                                                    # folga
                                                    $date = new DateTime('08:00:00');
                                                    $date->add(new DateInterval('PT'.$hoursDiff.'H'));
                                                    $horaSaida = $date->format('H:i');
                                                    $totalHoras = calcHours('08:00:00',$horaSaida);
                                                    $horasExtras = calcHours('01:00:00',$totalHoras);
                                                    $totalExtras[] = "-0".substr($horasExtras,1,1).":00:00";

                                                    echo "<td>00:00:00</td><td>00:00:00</td><td>".intervalo($totalExtras)."</td>";
                                                    if($funcionario['idCargo']==7){
                                                        echo $tdPedidos;                                                    
                                                    }
                                                    break;
                                            }

                                        } else {
                                            echo $defaultLine;
                                        }
                                    }
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                        <?php

        }