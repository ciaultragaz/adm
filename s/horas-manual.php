<?php
switch ($action) {
    case 'add':
        $H = new HorasManual();
        $H->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $i = 0;
        foreach ($_REQUEST['form'] as $key => $value) {
            if($value['value']){
                $hours[$i]['hour'] = $value['value'];
                $hours[$i]['date'] = $value['name'];
                $i++;
            }  
        }
        $count = count($hours);
        for($i=0; $i < $count;$i++){
            $H->horario = $hours[$i]['hour'];
            $H->dataPonto = $hours[$i]['date'];
            if($i==($count-1)){
             echo json_encode($H->add());   
            } else {
                $H->add();
            }
        }
        //Util::pre($idMenu);
        /*
        $H = new HorasManual();
        $H->horario = (isset($_REQUEST['hour'])) ? $_REQUEST['hour'] : null;
        $H->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $H->dataPonto = (isset($_REQUEST['date'])) ? $_REQUEST['date'] : null;
        echo json_encode($H->add());
        */
        break;
    case 'delete':
        $H = new HorasManual();
        $H->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;    
        echo json_encode($H->disable());        
        break;
    case 'manual':

            $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
            $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
            $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;

            $Funcionario = new Funcionarios();
            $Funcionario->id = $idFuncionario;
            $dadosFuncionario = $Funcionario->getById();
            $funcionario = $dadosFuncionario['data'];

            $H = new HorasManual();
            $H->month = $month;
            $H->year = $year;
            $H->idFuncionario = $idFuncionario;
            $data = $H->hours();

            $T = new Turnos();
            $T->id = $funcionario['idTurno'];
            $dataTurnos = $T->get();
            $turno = $dataTurnos['data'];

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
            //Util::pre($folgas);
            ?>
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <form id="formHoras">
                        <table id="tableModal" class="table table-striped table-bordered nowrap dataTable">
                            <thead>
                                <tr>
                                    <th>Dia</th>
                                    <th>Dia da semana</th>
                                    <th>Evento</th>
                                    <th>Entrada</th>
                                    <th>Saída</th>
                                    <th>Cumprir</th>
                                    <th>Total</th>
                                    <th><i class="feather icon-plus-circle"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $horas = $data['data'];                                
                                    foreach ($horas as $key => $value) {
                                        $index = $value['data'];                                    
                                        $time1 = 0;
                                        $time2 = 0;
                                        $classType = '';
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
                                        $classText = ($value['weekDay'] == 6) ? 'text-danger' : $classType ;
                                        $coment = (isset($folgas[$index]['coment']))?$folgas[$index]['coment']:'-';
                                        $input = '<input type="text" class="inputTime" name="'.$index.'" data-date="'.$index.'" data-bind="'.$idFuncionario.'">';
                                        echo "<tr class=\"$classText\"><td>".$value['dataFormat']."</td><td>".$value['nameDayOfWeek']."</td><td>$coment</td>";
                                        switch ($value['weekDay']) {
                                            case 5:
                                                $hoursDiff = $turno['qtdHorasSabado'];
                                                break;
                                            case 6:
                                                $hoursDiff = 0;
                                                break;
                                            default:
                                                $hoursDiff = $turno['qtdHorasSegSex'];
                                                break;
                                        }  
                                        if(is_null($value['hora'])){
                                            if($value['weekDay']!=6){
                                                echo "<td>$input</td><td>$input</td><td>".Util::lpad($hoursDiff).":00</td>";
                                            } else {
                                                echo "<td>--:--</td><td>--:--</td><td>--:--</td>";
                                            }
                                        } else {
                                            $hora   = explode(',',$value['hora']);
                                            $idHour = explode(',',$value['idHour']);                            
                                            for($i=0;$i<count($hora);$i++){
                                                if($i == 0){
                                                    $de = '06:00:00';
                                                    $ate = '08:05:00';
                                                    $horario = $hora[$i];
                                                    $beet = (Util::TimeIsBetweenTwoTimes($de,$ate,$horario))?'08:00:00':$hora[$i];
                                                    $time1 = strtotime($beet);                                        
                                                    echo "<td><a href=\"javascript:removeHour(".$idHour[$i].",".$idFuncionario.")\">".$beet."</a></td>";
                                                }
                                                if($i == count($hora)-1){
                                                    if($i==0) {
                                                        echo "<td>$input</td>";
                                                    } else {
                                                        $time2 = strtotime($hora[$i]);
                                                        echo "<td><a href=\"javascript:removeHour(".$idHour[$i].",".$idFuncionario.")\">".$hora[$i]."</a></td>";
                                                        $total          = $time2 - $time1;
                                                        $totalDiff      = $total - ($hoursDiff * 60 * 60) ;
                                                        $hours          = Util::lpad(floor($totalDiff / 60 / 60));
                                                        $minutesx       = Util::lpad(round(($totalDiff - ($hours * 60 * 60)) / 60));
                                                        $times[]        = $hours.":".$minutesx;
                                                    }                                                
                                                }
                                            }
                                            echo "<td>".Util::lpad($hoursDiff).":00</td>";
                                            echo "<td>".$hours.":".$minutesx."</td>";
                                        }                                
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>                    
                </div>
                <div class="col-sm-12 col-lg-4">
                    <?php
                        $styleBorderAvatar = ($funcionario['color']) ? 'style="border: '. $funcionario['color'].' solid 3px"' : '';
                        $avatar = ($funcionario['avatar']) ? '<div class="historyBtnProfileModal"><img src="../../uploads/docs/'.$idFuncionario.'/'.$funcionario['avatar'].'" class="avatarUser img-radius wid-100 align-top m-r-15" '.$styleBorderAvatar.'></div>' : '<div class="historyBtnProfile"><img src="../../assets/images/user/avatar-2.jpg" class="avatarUser img-radius wid-100 align-top m-r-15" '.$styleBorderAvatar.'></div>';
                    ?>                        
                    <div class="detalhes">
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
                            <tr><td>Horas Mensais:</td><td><?php //echo AddPlayTime($timeMonth);?></td></tr>
                            <tr><td>Horas Extras:</td><td><?php echo AddPlayTime($times);?></td></tr>
                            <tr><td>Salvar (<?php echo substr(AddPlayTime($times),0,2);?>) Horas em Holerites</td><td><button id="btnPrintVales"type="button" class="btn btn-primary btn-sm btn-block">Salvar</button></td></tr>
                            </table>
                        </div>                                          
                    </div>
                </div>
            </div>
            <script>
                $('.inputTime').mask('00:00');
            </script>
            <?php
            break;
        case 'setHorasHolerite':
            $HB = new Horas();
            $HB->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
            $HB->horas = (isset($_REQUEST['horas'])) ? $_REQUEST['horas'] : null;
            $HB->mes = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
            $HB->ano = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
            echo json_encode($HB->set());
            break;
        default:
            echo "service Horas Manual";
            break;
    

        }