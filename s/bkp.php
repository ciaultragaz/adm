<?php
require_once('../_config.php');
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
        $month = 3;
        $year = 2021;
        $idPonto = 15;
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
        } else {    
            ?>  <div class="row">
                <div class="col-sm-12 col-lg-6">
                <table id="tableModal" class="table table-striped table-bordered nowrap dataTable">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Dia da semana</th>
                            <th>Evento</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <?php if(isset($funcionario['idTurno'])){
                                    if($funcionario['idTurno']==1){ ?><th>extra</th><?php } ?>            
                            <?php } ?>
                            <th>Total</th>
                            <?php if(isset($funcionario['idCargo'])){ 
                                    if($funcionario['idCargo']==7){ ?> <th><i class="feather icon-shopping-cart"></i></th> <?php } ?>            
                            <?php } ?>
                            <th><i class="feather icon-plus-circle"></i></th>
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
                            foreach ($horas as $key => $value) {
                                $index = $value['data'];
                                $hora = explode(',',$value['hora']);
                                $sis  = explode(',',$value['sistema']);
                                $idHour  = explode(',',$value['idHour']);
                                $time1 = 0;
                                $time2 = 0;
                                $classType = '';

                                $T = new Turnos();
                                $T->id = $funcionario['idTurno'];
                                $dataTurnos = $T->get();
                                $turno = $dataTurnos['data'];

                                switch ($value['weekDay']) {
                                    case 5:
                                        $hoursDiff = $turno['qtdHorasSabado'];
                                        $timesOfMonth[] = ($hoursDiff-1).":00";
                                        break;
                                    case 6:
                                        break;                       
                                    default:
                                        $hoursDiff = $turno['qtdHorasSegSex'];
                                        $timesOfMonth[] = ($hoursDiff-1).":00";
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
                                $diaria = (isset($folgas[$index]['idRef'])==13) ? true:false ;
                                $evento = (isset($folgas[$index]['tipo'])) ? '<a title="'.$folgas[$index]['user'].'">'.$folgas[$index]['tipo'].'</a>' : '<a href="javascript:void(0)" title="Adicionar Evento"><i class="feather icon-calendar"></i></a>' ;
                                echo "<tr class=\"".$classText."\"><td>".$value['dataFormat']."</td><td>".$value['nameDayOfWeek']."</td><td>$evento</td>";
                                if(count($hora)>0){
                                    for ($i=0; $i < count($hora); $i++) {
                                        if($hora[$i]==""){
                                            echo "<td>---</td><td>---</td>";
                                            if(isset($folgas[$index]['idRef'])){
                                                //identifica folga e desconta 8 horas no total de horas extras
                                                if($folgas[$index]['idRef']==18){
                                                    echo "<td>---</td>";
                                                    $times[] = "-08:00";
                                                } else {
                                                    echo "<td>---</td>";
                                                }
                                            } else {
                                                echo "<td>---</td>";
                                            }
                                        } else {
                                            if($i==0 || $i == count($hora)-1){
                                                //echo "<td>".$hora[$i]."</td>";
                                                if($funcionario['idTurno'] == 1){
                                                    $beet = $hora[$i];
                                                } else {
                                                    $de = '06:00:00';
                                                    $ate = '08:05:00';
                                                    $horario = $hora[$i];
                                                    $beet = (Util::TimeIsBetweenTwoTimes($de,$ate,$horario))?'08:00:00':$hora[$i];
                                                }         
                                                if($sis[$i]){
                                                    echo "<td><a href=\"javascript:deleteHour(".$idHour[$i].")\">".$hora[$i]."</a></td>";
                                                } else {
                                                    echo "<td><a href=\"javascript:deleteHour(".$idHour[$i].")\" class=\"text-warning\">".$hora[$i]."</a></td>";
                                                }
                                                
                                            }                                            
                                        }
                                        if($hora[$i] != "" && $i == 0){
                                            $time1 = strtotime($beet);
                                        } else {
                                            $time2 = strtotime($hora[$i]);
                                        }
                                        if($i == count($hora)-1) {
                                            if($time1 ==0 && $time2 == 2){
                                                echo "<td>---</td>";
                                            }
                                            if($time1 != 0 && $time2 != 0){
                                                if($diaria){
                                                    $qtdDiaria++;
                                                    echo "<td>00:00</td>";
                                                } else {

                                                    $total      = $time2 - $time1;
                                                    
                                                    switch ($value['weekDay']) {
                                                        case 5:
                                                            $hoursDiff = $turno['qtdHorasSabado'];
                                                            break;                                                        
                                                        default:
                                                            $hoursDiff = $turno['qtdHorasSegSex'];
                                                            break;
                                                    }                                                
                                                //$calcHour[] = convertStrTimeToHour(-($hoursDiff * 60 * 60));
                                                $totalDiff      = $total - ($hoursDiff * 60 * 60) ;
                                                $hours          = Util::lpad(floor($totalDiff / 60 / 60));
                                                $minutesx       = Util::lpad(round(($totalDiff - ($hours * 60 * 60)) / 60));
                                                //$times[]        = $hours.":".$minutesx;                                                
                                                //$timeMonth[]    = Util::lpad(floor(($hoursDiff * 60 * 60) / 60 / 60)).":00";
                                            
                                                        $calcHour = array();
                                                        if($total > ($hoursDiff * 60 * 60)){
                                                            $calcHour[] = convertStrTimeToHour($total);
                                                            $calcHour[] = convertStrTimeToHour(-($hoursDiff * 60 * 60));
                                                        } else {
                                                            $calcHour[] = convertStrTimeToHour(($hoursDiff * 60 * 60));
                                                            $calcHour[] = convertStrTimeToHour(-$total);                                                            
                                                        }
                                                        
                                                        $timeMonth[]    = convertStrTimeToHour($total);
                                                        $totalOfTimes[] = convertStrTimeToHour($total);
                                                        $times[]        = AddPlayTime($calcHour);
                                            
                                                //$timeMonth[]    = convertStrTimeToHour($total);

                                                //$calcHourTotais = array();
                                                //$calcHourTotais[] = convertStrTimeToHour($total);
                                                //$total__      = $time2 - $time1;
                                                //$hours__      = Util::lpad(floor($total__ / 60 / 60));
                                                //$minutes__    = Util::lpad(round(($total__ - ($hours__ * 60 * 60)) / 60));
                                                //$totalOfTimes[] = convertStrTimeToHour($total);
                                                /*
                                                $time1x = strtotime('08:00:00');
                                                $time2x = strtotime('09:30:00');
                                                $difference = round(abs($time2x - $time1x) / 3600,2);
                                                $totalOfTimes[] = $difference;
                                                */
                                                //$timeWork[]     = 
                                                //echo "<td>".$hours.":".$minutesx."</td>";
                                                echo "<td>".AddPlayTime($calcHour)."</td>";
                                                echo "<td>".convertStrTimeToHour($total)."</td>";
                                                }

                                            } elseif($time1 !=0 && $time2 == 0){
                                                echo "<td>---</td><td>---</td>";
                                            }
                                            if($funcionario['idCargo']==7){
                                                if(isset($daysWork[$index])){
                                                    $classTextPedidos = ($value['weekDay']==6) ? 'text-danger' : '';
                                                    $classTextPedidos = (isset($warningsDays[$index])) ? 'text-warning':$classTextPedidos;
                                                    echo "<td><a href=\"javascript:void(0)\" class=\"viewPedidos $classTextPedidos\" data-date=\"$index\" data-funcionario=\"$idFuncionario\" data-tab=\"profile\">".Util::lpad($daysWork[$index]['pedidos'])."</a></td>";
                                                } else {
                                                    echo "<td><i class=\"feather icon-slash\" style=\"color: #833838 !important;\" title=\"Não houve vendas no dia !\"></i></td>";
                                                }
                                            }
                                            if($time1 != 0 && $time2 != 0){
                                                if($funcionario['idCargo']==7){
                                                    if(isset($warningsDays[$index])){
                                                        echo "<td><a href=\"javascript:void(0)\" class=\"viewPedidos $classTextPedidos\" data-date=\"$index\" data-funcionario=\"$idFuncionario\" data-tab=\"profile\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                                    } else {
                                                        echo "<td><i class=\"feather icon-check text-success\"></i></td>";
                                                    }
                                                } else {
                                                    echo "<td><i class=\"feather icon-check text-success\"></i></td>";
                                                }
                                            } elseif($time1 != 0 && $time2 ==0){
                                                if($funcionario['idCargo']==7){
                                                    $erros[$index]['nameDayOfWeek'] = $value['nameDayOfWeek'];
                                                    $erros[$index]['hora'][] = $hora[$i];
                                                    $erros[$index]['idPonto'] = $idPonto;
                                                    echo "<td><a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                                } else {
                                                    echo "<td><a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                                }
                                            } else{
                                                if ($value['weekDay']==6) {
                                                    if($funcionario['idCargo']==7 && isset($daysWork[$index]['pedidos'])){
                                                        $qtdDiaria++;
                                                    }
                                                    if($funcionario['idCargo']==7){
                                                        if(isset($warningsDays[$index])){
                                                            echo "<td><a href=\"javascript:void(0)\" class=\"viewPedidos $classTextPedidos\" data-date=\"$index\" data-funcionario=\"$idFuncionario\" data-tab=\"profile\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                                        } else {
                                                            echo "<td><i class=\"feather icon-plus-circle text-secondary\"></i></td>";
                                                        }
                                                    } else {
                                                        echo "<td><i class=\"feather icon-plus-circle text-secondary\"></i></td>";
                                                    }
                                                } else {
                                                    echo "<td><a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-plus-circle text-info\"></i></a></td>";
                                                }                                                
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    //echo "<td>".Util::pre($hora)."</td></tr>";
                                }  else {
                                    echo "<td>sem dados</td></tr>";
                                }
                            }

                                echo "<tr><td></td><td></td><td></td><td></td><td>Total:</td><td>".AddPlayTime($times)."</td></tr>";
                            //}
                        ?>
                    </tbody>
                </table>
                <?php
                    //Util::pre($timeMonth);
                ?>
                </div>
                    <div class="col-sm-12 col-lg-6">
                        <?php
                            $styleBorderAvatar = ($funcionario['color']) ? 'style="border: '. $funcionario['color'].' solid 3px"' : '';
                            $avatar = ($funcionario['avatar']) ? '<div class="historyBtnProfileModal"><img src="../../uploads/docs/'.$idFuncionario.'/'.$funcionario['avatar'].'" class="avatarUser img-radius wid-100 align-top m-r-15" '.$styleBorderAvatar.'></div>' : '<div class="historyBtnProfile"><img src="../../assets/images/user/avatar-2.jpg" class="avatarUser img-radius wid-100 align-top m-r-15" '.$styleBorderAvatar.'></div>';
                        ?>                        
                        <div class="detalhes">
                                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Resumo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pedidos</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="perfil">                  
                                    <div class="imageProfile"><?php echo $avatar;?></div>
                                        <div class="nome"><?php echo $funcionario['nome']; ?></div>
                                        <div class="cargo"><strong>Cargo:</strong>(<?php echo $funcionario['cargo']; ?>)</div>
                                    </div>
                                    <div class="perfil">                                        
                                        <div class="turno">Turno:(<?php echo ucwords($funcionario['turno']); ?>)</div>
                                    </div>                                    
                                    <div class="infoResumo">
                                        <table>
                                        <tr><td>Horas Mensais:</td><td><?php echo AddPlayTime($timeMonth);?></td></tr>
                                        <tr><td>Horas Extras:</td><td><?php 
                                        //$times[] = "-1:57";                                                                                                                                                                                                                                                                                                   :57:00";
                                        echo AddPlayTime($times);?></td></tr>
                                        <tr><td>Horas Mês:</td><td><?php echo AddPlayTime($timesOfMonth);?></td></tr>
                                        <tr><td>Horas totais:</td><td><?php echo AddPlayTime($totalOfTimes);?></td></tr>
                                        </table>
                                        <?php
                                            
                                        ?>
                                    </div>                                    
                                    <?php if(count($erros)>0){?>
                                    <hr class="hr">
                                    <div>
                                        <h6>Faltando Horário de Entrada / Saída</h6>
                                        <table class="tableModal table table-striped table-bordered nowrap dataTable">
                                            <?php
                                            foreach ($erros as $key => $value) {
                                                echo "<tr><td>".date('d/m/Y',strtotime($key))."</td><td>".$value['nameDayOfWeek']."</td>";
                                                echo "<td>".$erros[$key]['hora'][0]."</td>";
                                                echo "<td><a href=\"javascript:void(0)\" data-date=\"$key\" data-idPonto=\"".$erros[$key]['idPonto']."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <?php } ?>
                                    <hr class="hr">
                                    <h6>Diárias</h6>
                                    <div><?php echo $qtdDiaria;?></div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div>Nenhuma data Selecionada!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            <?php
        }