<?php
switch ($action) {
    case 'addHour':
        $H = new FuncionariosHoras();
        $H->horario =(isset($_REQUEST['hour'])) ? $_REQUEST['hour'] : null;
        $H->dataPonto =(isset($_REQUEST['date'])) ? $_REQUEST['date'] : null;
        $H->nome =(isset($_REQUEST['nome'])) ? $_REQUEST['nome'] : null;
        $H->idPonto =(isset($_REQUEST['idPonto'])) ? $_REQUEST['idPonto'] : null;
        $H->idRegister = 0 ;
        $H->sis = 0 ;
        echo json_encode($H->add());
        break;
    case 'delete':
        $H = new FuncionariosHoras();
        $H->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($H->disable());
        break;
    case 'deletePedido':
        $P = new Pedidos();
        $P->id = (isset($_REQUEST['idPedido'])) ? $_REQUEST['idPedido'] : null;
        echo json_encode($P->disable());
        break;
    case 'getAll':
        $H = new FuncionariosHoras();
        $H->month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $H->year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        echo json_encode($H->list());
        break;
    case 'getDataPonto':
        $H = new FuncionariosHoras();
        echo json_encode($H->getPontoNotRelation());
        break;
    case 'getFuncionarioByIdPonto':
        $H = new FuncionariosHoras();
        $H->idPonto = (isset($_REQUEST['idPonto'])) ? $_REQUEST['idPonto'] : null;
        echo json_encode($H->funcionario());
        break;
    case 'getFuncionarios':
        $F = new FuncionariosHoras();
        echo json_encode($F->getFuncionariosUnrelated());
        break;
    case 'newHours':
        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        $idPonto = (isset($_REQUEST['idPonto'])) ? $_REQUEST['idPonto'] : null;
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
                        $folgas[$value['dataEvento']]['idRef']      = $value['idRef'];
                        $folgas[$value['dataEvento']]['coment']     = $value['evento'];
                        $folgas[$value['dataEvento']]['tipo']       = $value['parametro'];
                        $folgas[$value['dataEvento']]['user']       = (isset($value['user']))?$value['user']:0;
                        $folgas[$value['dataEvento']]['idAction']   = (isset($value['idAction']))?$value['idAction']:0;
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
                                        if($funcionario['idCargo']==7){ ?> <th><i class="feather icon-shopping-cart"></i></th> <?php } ?>
                                <?php } ?>
                                <th><i class="feather icon-plus-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $horas = $data['data'];
                                $times = array();
                                $totalExtras = array();
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
                                    $tdWarningHour = "<td><a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a></td>";
                                    if($funcionario['idCargo']==7){
                                        $haveSell = false;
                                        if(isset($daysWork[$index])){
                                            $haveSell = true;
                                            $classTextPedidos = ($value['weekDay']==6) ? 'text-danger' : '';
                                            $classTextPedidos = (isset($warningsDays[$index])) ? 'text-warning':$classTextPedidos;
                                            $tdPedidos =  "<td><a href=\"javascript:void(0)\" class=\"viewPedidos $classTextPedidos\" data-date=\"$index\" data-funcionario=\"$idFuncionario\" data-tab=\"profile\">".Util::lpad($daysWork[$index]['pedidos'])."</a></td>";
                                        } else {
                                            $haveSell = false;
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
                                            if(isset($folgas[$index]['idRef']) && $folgas[$index]['idRef']==13){
                                                $horasPorDia = "0";    
                                            } else {
                                                $hoursDiffFormated = ($hoursDiff).":00:00";
                                                $horasPorDia = ($hoursDiff-1);
                                                $timesOfMonth[] = ($hoursDiff-1).":00:00";
                                            }                                            
                                            break;
                                        case 5:
                                            if(isset($folgas[$index]['idRef']) && $folgas[$index]['idRef']==13){
                                                $horasPorDia = "0";    
                                            } else {
                                                $hoursDiff = $turno['qtdHorasSabado'];
                                                $hoursDiffFormated = ($hoursDiff).":00:00";
                                                $horasPorDia = ($hoursDiff);
                                                $timesOfMonth[] = ($hoursDiff).":00:00";
                                            }                                            
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
                                    $btnAlertHour = "<a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\"><i class=\"feather icon-alert-triangle text-danger\"></i></a>";
                                    $btnAddHour = "<a href=\"javascript:void(0)\" data-date=\"$index\" data-idPonto=\"".$idPonto."\" class=\"btnWarning\">->:<-</a>";
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
                                            $tdDeleteHour = "<td><a href=\"javascript:deleteHour(".$idHour[$i].")\">".($hora[$i])."</a></td>";
                                            if($i==0){
                                                $time1  = ($hora[$i]);
                                                $de     = '06:00:00';
                                                $ate    = '08:05:00';
                                                $beet   = (Util::TimeIsBetweenTwoTimes($de,$ate,$time1))?'08:00:00':$time1;
                                                $time1  = $beet;
                                                echo $tdDeleteHour;
                                            }
                                            if( ($i == count($hora)-1) && ($i != 0) ){
                                                $time2 = ($hora[$i]);
                                                echo $tdDeleteHour;
                                                if(!$diaria){
                                                    $totalHoras = calcHours($time1,$time2);
                                                    $horasExtras = (calcHours($hoursDiffFormated,$totalHoras) < 0)?'00:00:00':calcHours($hoursDiffFormated,$totalHoras);
                                                    $totalExtras[] = $horasExtras;
                                                    $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                    $aa = intervalo($trabalhadas);
                                                    $bb = intervalo($timesOfMonth);
                                                    echo "<td>".intervalo($totalExtras)."</td>";
                                                    if($funcionario['idCargo']==7){
                                                        echo $tdPedidos;
                                                    }
                                                    echo $tdSuccess;
                                                } else {
                                                    if(isset($folgas[$index]['idRef']) && $folgas[$index]['idRef'] == 22 ){
                                                        $date = new DateTime('08:00:00');
                                                        $date->add(new DateInterval('PT'.$hoursDiff.'H'));
                                                        $horaSaida = $date->format('H:i');
                                                        $totalHoras = calcHours('08:00:00',$horaSaida);
                                                        $horasExtras = '00:00:00';
                                                        $totalExtras[] = $horasExtras;
                                                        $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                        $aa = intervalo($trabalhadas);
                                                        $bb = intervalo($timesOfMonth);
                                                        echo "<td>".intervalo($totalExtras)."</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        }
                                                    } else if(isset($folgas[$index]['idRef']) && $folgas[$index]['idRef'] == 13 ){
                                                        echo "<td>".$btnAddHour."</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    }
                                                    
                                                }
                                            } 
                                            if( ($i == count($hora)-1) && ($i == 0) ) {
                                                if($funcionario['idCargo'] == 7){
                                                    echo "<td>".$btnAddHour."</td><td>--:--</td>".$tdPedidos.$tdWarningHour;
                                                } else {
                                                    echo "<td>".$btnAddHour."</td><td>--:--</td>".$tdWarningHour;
                                                }
                                            }
                                            
                                        }
                                    } else {
                                        if($value['weekDay'] == 6){
                                            $defaultLine = "<td>--:--</td><td>--:--</td><td>--:--</td>";
                                        }else{
                                            $defaultLine = "<td>".$btnAddHour."</td><td>".$btnAddHour."</td><td>--:--</td>";
                                        }
                                        if($funcionario['idCargo'] == 7){
                                            $defaultLine = ($haveSell && $value['weekDay']!=6) ? $defaultLine.$tdPedidos.$tdWarningHour : $defaultLine.$tdPedidos.$tdSuccess;
                                        } else {
                                            $defaultLine = $defaultLine.$tdSuccess;
                                        }
                                        if(isset($folgas[$index]['idRef'])){
                                            switch ($folgas[$index]['idRef']) {
                                                case '26': //Atestado
                                                case '22': //Falta
                                                    if($value['weekDay']!=6){
                                                        $date = new DateTime('08:00:00');
                                                        $date->add(new DateInterval('PT'.$hoursDiff.'H'));
                                                        $horaSaida = $date->format('H:i');
                                                        $totalHoras = calcHours('08:00:00',$horaSaida);
                                                        $horasExtras = '00:00:00';
                                                        $totalExtras[] = $horasExtras;
                                                        $trabalhadas[] = ($value['weekDay']!=5) ? calcHours('01:00:00',$totalHoras) : $totalHoras;
                                                        echo "<td> 08:00:00</td>";
                                                        echo "<td> ".$horaSaida."</td>";
                                                        $aa = intervalo($trabalhadas);
                                                        $bb = intervalo($timesOfMonth);
                                                        echo "<td>".intervalo($totalExtras)."</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    } else {
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    }
                                                    break;
                                                case '18':
                                                    # folga
                                                    if($value['weekDay']!=6){
                                                        $date = new DateTime('08:00:00');
                                                        $date->add(new DateInterval('PT'.$hoursDiff.'H'));
                                                        $horaSaida = $date->format('H:i');
                                                        $totalHoras = calcHours('08:00:00',$horaSaida);
                                                        $horasExtras = calcHours('01:00:00',$totalHoras);
                                                        $totalExtras[] = "-0".substr($horasExtras,1,1).":00:00";
    
                                                        echo "<td>00:00:00</td><td>00:00:00</td><td>".intervalo($totalExtras)."</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    } else {
                                                        echo "<td>--:--</td><td>--:--</td><td>--:--</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    }
                                                    break;
                                                case '21':
                                                        echo "<td>--:--</td><td>--:--</td><td>--:--</td>";
                                                        if($funcionario['idCargo']==7){
                                                            echo $tdPedidos.$tdSuccess;
                                                        } else {
                                                            echo $tdSuccess;
                                                        }
                                                    break;
                                            }

                                        } else {
                                            echo $defaultLine;
                                        }                                        
                                    }
                                    echo "</tr>";
                                }
                                //echo "<tr><td>".intervalo($totalExtras) ."</td></tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
                        <?php

        }       
        ?></div</div>
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
                                        <tr><td>Horas Trabalhadas:</td><td><?php echo AddPlayTime($trabalhadas);?></td></tr>
                                        <tr><td>Horas Extras:</td><td><?php echo AddPlayTime($totalExtras);?></td></tr>
                                        <tr><td>Horas Mês:</td><td><?php echo AddPlayTime($timesOfMonth);?></td></tr>
                                        </table>
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
        break;
        case 'hours':
        
        break;        
    case 'addRelation':
        $F = new FuncionariosHoras();
        $F->idPonto = (isset($_REQUEST['idPonto'])) ? $_REQUEST['idPonto'] : null;
        $F->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->addRelation());
    break;
    case 'unlink':
        $F = new FuncionariosHoras();
        $F->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->unlink());
        break;
    
    case 'list':
        $H = new FuncionariosHoras();
        $H->month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $H->year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        $H->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $H->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $H->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        echo json_encode($H->list());
        break;
    case 'testeProcessa':
        $H = new FuncionariosHoras();
        $H->month = 2;
        $H->year = 2021;
        $H->testeProcessa();
        break;
    case 'unlinkTurno':
        $F = new Funcionarios();
        $F->id = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($F->deleteTurno());
        break;
    case 'processa':
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $idPonto = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;

        $H = new FuncionariosHoras();
        $H->month =   02;
        $H->year =    2021;
        $H->idPonto = 22;
        $horas = $H->hours();

        ?>
            <table>
                <?php
                    $horas = $horas['data'];
                    for($i=0;$i<count($horas);$i++){
                        echo "<tr><td>".$horas[$i]['dataFormat']."</td><td>".$horas[$i]['nameDayOfWeek']."</td><td>".$horas[$i]['xxx']."</td></tr>";
                    }
                ?>    
            </table>
            <div><?php Util::pre($H->processHours());?></div>
        <?php

        break;
    case 'processar':
        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        $H = new FuncionariosHoras();
        $H->month =$month;
        $H->year = $year;
        $funcionarios = $H->getAll();
        //Util::pre($funcionarios['data']);
        foreach ($funcionarios['data'] as $key => $value) {
            if($value['idFuncionario']){
                echo "<h6>".$value['nome']."</h6>";
                $H = new FuncionariosHoras();
                $H->month = $month;
                $H->year = $year;
                $H->idPonto = $value['idPonto'];
                $data = $H->hours();
                $erro = 0;
                for($i =0; $i <count($data['data']);$i++){
                    if(isset($data['data'][$i]['hora'])){
                        $horas = explode(',',$data['data'][$i]['hora']);
                        $entradaSaida = count($horas);
                        if($entradaSaida == 1 && $horas[0] !=""){
                            $erro = 1;
                        }
                    }
                    if($i == count($data['data'])-1){
                        $Hw =  new HorasWarning();
                        $Hw->idFuncionario = $value['idFuncionario'];
                        $Hw->month = $month;
                        $Hw->year = $year;
                        $Hw->warning = $erro;
                        $Hw->set();
                    }
                }
            }
        }
        break;
    case 'setTurno':
        $F = new Funcionarios();
        $F->idTurno = (isset($_REQUEST['idTurno'])) ? $_REQUEST['idTurno'] : null;
        $F->id      = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        //Util::pre($_REQUEST);
        echo json_encode($F->addTurno());
        break;
    case 'turnos': 
        $T = new Turnos();
        echo json_encode($T->getAll());
        break;
    case 'viewPedidos':
        $F = new FuncionariosMotoristas();
        $F->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $data = $F->getByIdFuncionario();
        $dataPedido = (isset($_REQUEST['dataPedidos'])) ? $_REQUEST['dataPedidos'] : null;
        $P = new Pedidos();
        $P->dia = $dataPedido;
        $P->motorista = $data['data']['motorista'];
        $P->onlyProduct = 1;
        $P->cancelados = false;
        $pedidos = $P->getPedidosEnderecos();
        ?> 
            <table class="tableModal table table-striped table-bordered nowrap dataTable">
                <tbody>
                <?php
                    $i=1;
                    $totalDay = 0;
                    $end = '';
                    foreach ($pedidos['data'] as $key => $value) {
                        $total = ($value['Precounit']*$value['Qt']);
                        $totalDay = $totalDay + $total;
                        $classEnd = ($end == $value['endereco']) ? ' class="text-warning"' : '';
                        $end = $value['endereco'];
                        echo "<tr$classEnd><td>$i</td><td>".$value['endereco']."</td><td>".substr($value['Formapag'],0,6)."</td><td>".$value['Produto']."</td><td>".date( 'd/m/Y' , strtotime($value['Data']) )."</td><td>".date( 'H:m' , strtotime($value['Hora']) )."</td>\n
                        <td>".Util::formataMoeda($total)."</td>\n
                        <td><a href=\"javascript:void(0)\" class=\"btnDeletePedido text-danger\" data-pedido=\"".$value['Cod']."\"><i class=\"feather icon-x\"></i></a></td>
                        </tr>";
                        $i++;
                    }
                    echo "<tr><td colspan=\"5\"></td><td>Total</td><td>".Util::formataMoeda($totalDay)."</td><td></td></tr>"
                ?>
                </tbody>
            </table>
        <?php

        break;
    default:
    echo "service Funcionários Horas";
    break;
}