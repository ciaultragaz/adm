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
function formatHour($hour){
    return substr($hour,0,5);
}
        $month = 2;
        $year = 2021;
        //Abel
        //$idPonto = 29;
        //Bruno
        //$idPonto = 15;
        //Pessa
        //$idPonto = 24;
        //Kauã
        //$idPonto = 49;
        //Stori
        //$idPonto = 33;
        //Geraldo
        //$idPonto = 27;
        //Edivaldo
        $idPonto = 23;  
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
        } else {    ?>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <table id="tableModal" class="table table-striped table-bordered nowrap dataTable">
                        <thead>
                            <tr>
                                <th>Horas Dia</th>
                                <th>Dia</th>
                                <th>Dia da semana</th>
                                <th>Evento</th>
                                <th>Entrada</th>
                                <th>Beet</th>
                                <th>Saída</th>
                                <th>Trabalhadas</th>
                                <th>Extras</th>
                                <th>Total Trabalhadas</th>
                                <th>Total Extras</th>
                                <th>calc_2</th>
                                <th>Cumprir</th>                            
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

                                foreach ($horas as $key => $value) {
                                    $index = $value['data'];
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
                                    
                                    $diaria = (isset($folgas[$index]['idRef'])==13) ? true:false ;
                                    $folga = (isset($folgas[$index]['idRef'])==18) ? true:false ;
                                    $falta = (isset($folgas[$index]['idRef'])==22) ? true:false ;
                                    $evento = (isset($folgas[$index]['tipo'])) ? '<a title="'.$folgas[$index]['user'].'">'.$folgas[$index]['tipo'].'</a>' : '<a href="javascript:void(0)" title="Adicionar Evento"><i class="feather icon-calendar"></i></a>' ;
                                    $dataDia = $value['dataFormat'];
                                    echo "<tr><td>".$horasPorDia."</td><td>".$dataDia."</td><td>".$value['nameDayOfWeek']."</td><td>$evento</td>";
                                    if(isset($value['hora'])){
                                        $hora = explode(',',$value['hora']);
                                        $sis  = explode(',',$value['sistema']);
                                        $idHour  = explode(',',$value['idHour']);
                                        for($i=0;$i<count($hora);$i++){
                                            if($i==0){
                                                $time1 = formatHour($hora[$i]);
                                                $de = '06:00';
                                                $ate = '08:05';
                                                $beet = (Util::TimeIsBetweenTwoTimes($de,$ate,$time1))?'08:00':$time1;
                                                $time1 = $beet;
                                                echo "<td>".formatHour($hora[$i])."</td>";
                                                echo "<td>".formatHour($beet)."</td>";
                                            }
                                            if($i == count($hora)-1){
                                                $time2 = formatHour($hora[$i]);
                                                echo "<td>".$time2."</td>";
                                                //$time1 = strtotime($time1);
                                                //$time2 = strtotime($time2);
                                                //$total = $time2 - $time1;
                                                //$total = convertStrTimeToHour($total);
                                                //echo "<td>".$total."</td>";
                                                //$exp_1 = explode(":",$time1);
                                                //$exp_2 = explode(":",$time2);
                                                //$entradaH = $exp_1[0];
                                                //$entradaM = $exp_1[1];
                                                //$saidaH   = $exp_2[0];
                                                //$saidaM   = $exp_2[1];
                                                //echo "<td>";
                                                //print_r( intervalo( $entradaH, $entradaM, $saidaH, $saidaM ) );
                                                //echo "</td>";
                                                //echo "<td>".intervalo($extra)."</td>";
                                                if(!$diaria) {
                                                    $totalHoras = calcHours($time1,$time2);
                                                    //$test = array();
                                                    //$test[] = $time1;
                                                    //$test[] = $time2;
                                                    //$totalHoras = intervalo($test);
                                                    $horasExtras = (calcHours($hoursDiffFormated,$totalHoras) < 0)?'00:00:00':calcHours($hoursDiffFormated,$totalHoras);
                                                    $totalExtras[] = $horasExtras;
                                                    $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                    //$trabalhadas[] = $totalHoras;
                                                    //$trabalhadas[] = ($value['weekDay'] != )$totalHoras;
                                                    //$totalTrabalhadas = intervalo($trabalhadas);
                                                    echo "<td> ".$totalHoras."</td>";
                                                    echo "<td>".$horasExtras."</td>";
                                                    echo "<td>".intervalo($trabalhadas)."</td>";
                                                    $aa = intervalo($trabalhadas);
                                                    $bb = intervalo($timesOfMonth);
                                                    echo "<td>".intervalo($totalExtras)."</td>";
                                                    echo "<td>".calcHours($bb,$aa)."</td>";
                                                    echo "<td>".intervalo($timesOfMonth)."</td>";
                                                    //echo "<td>".calcHours($timesOfMonth,$totalTrabalhadas)."</td>";
                                                }
                                                
                                            }
                                        }
                                    } else {
                                        $defaultLine = "<td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>00:00</td><td>".intervalo($timesOfMonth)."</td>";
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
                                                    //echo "<td>08:00</td>";
                                                    echo "<td> 08:00</td>";
                                                    echo "<td> 08:00</td>";
                                                    echo "<td> ".$horaSaida."</td>";
                                                    echo "<td>".$horasExtras."</td>";
                                                    echo "<td>".$horasExtras."</td>";
                                                    echo "<td>".intervalo($trabalhadas)."</td>";
                                                    $aa = intervalo($trabalhadas);
                                                    $bb = intervalo($timesOfMonth);
                                                    echo "<td>".intervalo($totalExtras)."</td>";
                                                    echo "<td>".calcHours($bb,$aa)."</td>";
                                                    echo "<td>".intervalo($timesOfMonth)."</td>";
                                                    break;
                                                case '18':
                                                    # falta
                                                    echo $defaultLine;
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
            </div>
                        <?php

        }