<?php
switch ($action) {
    case 'addHolerite':
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $ano= (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $F = new FuncionariosMotoristas();        
        $F->idFuncionario = $idFuncionario;
        $funcionario = $F->getByIdFuncionario();

        if($funcionario['total'] > 0){
            $motorista = $funcionario['data']['motorista'];
            $C = new Comissao();
            $C->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
            $C->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;         
            $C->motorista = $motorista;
            $comissao = $C->get();
            $comissao = ($comissao['data']['comissao']==0)?0:$comissao['data']['comissao'];
        } else {
            $comissao = 0;
        }
        $H = new HoleritesItens();
        $H->idFuncionario = $idFuncionario;
        $H->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $H->ano= (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $H->comissao = $comissao;
        echo json_encode($H->add());
        
        break;
    case 'checkHolerite':
        $H = new Holerites();
        $H->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $H->ano= (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $H->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($H->getByIdFuncionarioMonthYear());
        break;
    case 'getAll':
        $F = new FuncionariosHolerites();
        $F->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 50;
        $F->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $F->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $F->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $F->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $F->filterCargo = (isset($_REQUEST['filterCargo'])) ? $_REQUEST['filterCargo'] : null;
        $F->demitidos   = (isset($_REQUEST['showDemitidos'])) ? $_REQUEST['showDemitidos'] : null;
        $F->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $F->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $dados = $F->getAll();

        $C = new Comissao();
        $C->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $C->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $comissoes = $C->comissoes();

        //Util::pre($comissoes);

        foreach ($dados['data'] as $key => $value) {
            $i = $value['id']; 
            if(isset($comissoes[$i]['comissao'])){
                $dados['data'][$key]['comissao'] = $comissoes[$i]['comissao'];
            }
        }    
        echo json_encode($dados);

        break;
    case 'setBonus':
        $B =  new Bonus();
        $B->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $B->bonus = (isset($_REQUEST['bonus'])) ? $_REQUEST['bonus'] : null;
        $B->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $B->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        echo json_encode($B->set());
        break;
    case 'setRange':
        $month = (isset($_REQUEST['month'])) ? $_REQUEST['month'] : null;
        $year = (isset($_REQUEST['year'])) ? $_REQUEST['year'] : null;
        $a_date = "$year-$month-01";
        $lastDay = date("Y-m-t", strtotime($a_date));        
        echo json_encode(date("d/m/Y",strtotime($a_date))." - ".date("d/m/Y",strtotime($lastDay)));
        break;
    case 'setHoras':
        $H =  new Horas();
        $H->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $H->horas = (isset($_REQUEST['horas'])) ? $_REQUEST['horas'] : null;
        $H->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $H->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        echo json_encode($H->set());
        break;
    
        case 'comissao':
        $C = new Comissao();
        $C->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $C->ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;

        $F = new FuncionariosMotoristas();
        $F->idFuncionario = $idFuncionario;
        $funcionario = $F->getByIdFuncionario();
        $motorista = $funcionario['data']['motorista'];
        $C->motorista = $motorista;
        echo json_encode($C->get());
        break;
    case 'getEventos':
        $E = new Eventos();
        $E->month = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $E->year = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;     
        $E->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        echo json_encode($E->getByidFuncionario());
        break;        
    case 'view':
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $meses = Util::meses();
        $mesSelecionado = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        $comissao = (isset($_REQUEST['comissao'])) ? $_REQUEST['comissao'] : null;
        $F = new Funcionarios();
        $F->id = $idFuncionario;
        $dataFuncionario = $F->getById();
        $funcionario = $dataFuncionario['data'];

        $E = new Empresas();
        $E->id = $funcionario['idEmpresa'];
        $empresa = $E->getById();
        $empresa = $empresa['data'];

        $H = new HoleritesItens();
        $H->idFuncionario = $idFuncionario;
        $H->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $H->ano = $ano;
        $H->bonus = (isset($_REQUEST['bonus'])) ? $_REQUEST['bonus'] : null;
        $H->comissao = $comissao;

        $itens = $H->view();    
        
        ?>
        <div class="holerite">
        <div class="line-1-pre">
            <table>
                <tr>
                    <td><?php 
                        $dataContratacao = new DateTime(Util::dateToDb($funcionario['dataContratacao']));
                        $dataSelecionada = new DateTime($ano.'-'.Util::lpad($mesSelecionado).'-01');
                        if($dataContratacao < $dataSelecionada){
                            //echo $dataContratacao->format("Y-m-d") . " é maior que  ". $dataSelecionada->format("Y-m-d");
                            echo strtoupper($empresa['razao']);
                        } else {
                            //echo $dataContratacao->format("Y-m-d") . " é menor que  ". $dataSelecionada->format("Y-m-d");
                        }
                        ?></td>
                    <td>
                        <div class="titleHolerite">Recibo de Pagamento de Salário</div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $empresa['cnpj'];?></td>
                    <td>Referente ao mês de <?php echo $meses[$mesSelecionado]." ".$ano; ?></td>
                </tr>
            </table>
        </div>
        <div class="line-1-pre">
            <table>
                <tr>
                    <td>
                        <div class="label">Código</div>
                    </td>
                    <td>
                        <div class="label">Nome Funcionnário</div>
                    </td>
                    <td>
                        <div class="label">CBO</div>
                    </td>
                    <td>
                        <div class="label">Emp.</div>
                    </td>
                    <td>
                        <div class="label">Local</div>
                    </td>
                    <td>
                        <div class="label">Depto.</div>
                    </td>
                    <td>
                        <div class="label">Setor</div>
                    </td>
                    <td>
                        <div class="label">Seção</div>
                    </td>
                    <td>
                        <div class="label">Fl.</div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $funcionario['id'];?></td>
                    <td><?php echo strtoupper($funcionario['nome']);?></td>
                    <td colspan="7">Referente ao mês de <?php echo $meses[$mesSelecionado]." ".$ano; ?></td>
                </tr>
            </table>
        </div>
        <div></div>
        <table class="itens">
            <thead>
                <tr>
                    <td>
                        <div class="label">Cód.</div>
                    </td>
                    <td>
                        <div class="label">Descrição</div>
                    </td>
                    <td>
                        <div class="label">Referência</div>
                    </td>
                    <td>
                        <div class="label">Vencimentos</div>
                    </td>
                    <td>
                        <div class="label">Descontos</div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalVencimentos = 0;
                    $totalDescontos = 0;
                    //  Util::pre($itens['data']);
                    foreach ($itens['data'] as $key => $value) {
                        $valor = $value['qtdCalc'];
                        $desconto = abs($valor);
                        $collumnDesconto = $value['desconto'];
                        if($value['idTipoItem'] == 14){
                            $collumnDesconto = ($value['descontoVale']) ? 1 : 0 ;
                        }
                        echo "<tr>";
                        echo "<td>".str_pad($value['orderItems'], 2, "0", STR_PAD_LEFT)."</td>";
                        echo "<td>".$value['descricao']."</td>";
                        switch ($collumnDesconto) {
                            case 0:
                                switch ($value['idTipoItem']) {
                                    case 1:
                                        echo "<td>".$value['diasUteisCorrente']."</td>";
                                        $salarioBase = $valor;
                                        break;
                                    case 2:
                                        $periculosidade = $valor;
                                        echo "<td>".$value['diasUteisCorrente']."</td>";
                                        break;
                                    case 3:
                                        echo "<td>".$value['horas']."</td>";
                                        break;
                                    case 6:
                                    case 7:
                                        echo "<td>".$value['referencia']."</td>";
                                        break;
                                    case 10:
                                        echo "<td></td>";
                                        break;
                                    default:
                                        echo "<td></td>";
                                        break;
                                }
                                echo "<td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">".Util::formataMoeda($valor)."</span></div></td><td></td>";
                                $totalVencimentos = $totalVencimentos + $valor;
                                break;
                            case 1:
                                echo "<td></td><td></td><td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">";
                                switch ($value['idTipoItem']) {
                                    case 10:
                                        $Inss = new Inss();
                                        $Inss->data = $ano."-".$mesSelecionado."-01";
                                        $Inss->salario = ($salarioBase+$periculosidade);
                                        echo Util::formataMoeda($Inss->getDiscounts());
                                        break;
                                    
                                    default:
                                        echo Util::formataMoeda($desconto);
                                        $totalDescontos = $totalDescontos + $desconto;
                                        break;
                                }
                                echo "</span></div></td>";
                                break;

                        }
                        echo "</tr>";
                    }
                ?>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" rowspan="4" style="background: #d6fbd9;"></td>
                    <td>
                        <div class="label">Total de Vencimentos</div>
                    </td>
                    <td>
                        <div class="label">Total de Descontos</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalVencimentos);?></span></div>
                    </td>
                    <td>
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalDescontos);?></span></div>
                    </td>
                </tr>
                <tr>
                    <td><div class="label">Valor Líquido</div></td>
                    <td>
                        <?php 
                            $valorLiquido = $totalVencimentos - $totalDescontos;
                            $color = ($valorLiquido > 0)?'':'style="background-color:red"';
                        ?>
                        <div class="divValue" <?php echo $color;?>><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($valorLiquido) ?></span></div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="line-1-pre">
        <table>
            <tr>
                <td><div class="label">Salário Base</div></td>
                <td><div class="label">Sal. Contr.INSS</div></td>
                <td><div class="label">Base Calc. FGTS</div></td>
                <td><div class="label">FGTS do Mês</div></td>
                <td><div class="label">Base Cálc. IRRF</div></td>
                <td><div class="label">Faixa IRRF</div></td>
            </tr>
            <tr>
                <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase);?></td>
                <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase + $periculosidade);?></td>
                <td style="text-align:center"><?php $baseCalcFgts = $salarioBase + $periculosidade ; echo Util::formataMoeda($baseCalcFgts);?></td>
                <td style="text-align:center"><?php 
                                                $fgts = (8 / 100) * $baseCalcFgts;
                                                echo Util::formataMoeda($fgts); ?></td>
                <td style="text-align:center"><?php 
                //$irpf = ($baseCalcFgts - $fgts);
                //$irpf = number_format($irpf, 2);
                //echo Util::formataMoeda($irpf);
                echo Util::formataMoeda($baseCalcFgts - $fgts);
                ?>
                </td>
                <td style="text-align:center"></td>
            </tr>
        </table>
        </div>
    </div>
    <?php
        break;
    case 'holerite':
        $idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
        $idHolerite = (isset($_REQUEST['idHolerite'])) ? $_REQUEST['idHolerite'] : null;
        $meses = Util::meses();
        $mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;
        
        $F = new Funcionarios();
        $F->id = $idFuncionario;
        $dataFuncionario = $F->getById();
        $funcionario = $dataFuncionario['data'];
        //Uti::pre($funcionario);
        $E = new Empresas();
        $E->id = $funcionario['idEmpresa'];
        $empresa = $E->getById();
        $empresa = $empresa['data'];

        $Holerite = new Holerites();
        $Holerite->id = $idHolerite;
        $holerite = $Holerite->get();
        $holerite = $holerite['data'];

        $H = new HoleritesItens();
        $H->idHolerite = $idHolerite;
        $H->mes = (isset($_REQUEST['mes'])) ? $_REQUEST['mes'] : null;
        $H->ano = $ano;

        $itens = $H->getByIdHolerite();
        
        //echo "<div class='pre'>";
        //Util::pre($itens['data']);
        //Util::prexit($comissao);
        //echo "</div>";
        
        ?>
        <div class="holerite">
        <div class="line-1">
            <table>
                <tr>
                    <td><?php 

                        echo strtoupper($empresa['razao']);
                        
                        ?></td>
                    <td>
                        <div class="titleHolerite">Recibo de Pagamento de Salário</div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $empresa['cnpj'];?></td>
                    <td>Referente ao mês de <?php echo $meses[$mes]." ".$ano; ?></td>
                </tr>
            </table>
        </div>
        <div class="line-1">
            <table>
                <tr>
                    <td>
                        <div class="label">Código</div>
                    </td>
                    <td>
                        <div class="label">Nome Funcionnário</div>
                    </td>
                    <td>
                        <div class="label">CBO</div>
                    </td>
                    <td>
                        <div class="label">Emp.</div>
                    </td>
                    <td>
                        <div class="label">Local</div>
                    </td>
                    <td>
                        <div class="label">Depto.</div>
                    </td>
                    <td>
                        <div class="label">Setor</div>
                    </td>
                    <td>
                        <div class="label">Seção</div>
                    </td>
                    <td>
                        <div class="label">Fl.</div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $funcionario['id'];?></td>
                    <td><?php echo strtoupper($funcionario['nome']);?></td>
                    <td colspan="7">Referente ao mês de <?php echo $meses[$mes]." ".$ano; ?></td>
                </tr>
            </table>
        </div>
        <div></div>
        <table class="itens">
            <thead>
                <tr>
                    <td>
                        <div class="label">Cód.</div>
                    </td>
                    <td>
                        <div class="label">Descrição</div>
                    </td>
                    <td>
                        <div class="label">Referência</div>
                    </td>
                    <td>
                        <div class="label">Vencimentos</div>
                    </td>
                    <td>
                        <div class="label">Descontos</div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalVencimentos = 0;
                    $totalDescontos = 0;
                    foreach ($itens['data'] as $key => $value) {
                        $valor = $value['valor'];
                        $desconto = abs($valor);
                        echo "<tr>";
                        echo "<td>".str_pad($value['idTipoItem'], 2, "0", STR_PAD_LEFT)."</td>";
                        echo "<td>".$value['descricao']."</td>";
                        switch ($value['desconto']) {
                            case 1:
                                echo "<td></td><td></td><td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">".Util::formataMoeda($desconto)."</span></div></td>";
                                $totalDescontos = $totalDescontos + $desconto;
                                break;
                            case 0:
                                switch ($value['idTipoItem']) {
                                    case 1:
                                        echo "<td>".$value['diasUteis']."</td>";
                                        $salarioBase = $valor;
                                        break;
                                    case 2:
                                        $periculosidade = $valor;
                                        echo "<td>".$value['diasUteis']."</td>";
                                        break;
                                    case 3:
                                        echo "<td>".$holerite['horas']."</td>";
                                        break;
                                    case 6:
                                    case 7:
                                        echo "<td>".$holerite['diasUteis']."</td>";
                                        break;
                                    default:
                                        echo "<td></td>";
                                        break;
                                }
                                echo "<td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">".Util::formataMoeda($valor)."</span></div></td><td></td>";
                                $totalVencimentos = $totalVencimentos + $valor;
                                break;                          
                        }
                        echo "</tr>";
                    }
                ?>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td></td><td></td><td></td><td></td><td></td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" rowspan="4" style="background: #d6fbd9;"></td>
                    <td>
                        <div class="label">Total de Vencimentos</div>
                    </td>
                    <td>
                        <div class="label">Total de Descontos</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalVencimentos);?></span></div>
                    </td>
                    <td>
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalDescontos);?></span></div>
                    </td>
                </tr>
                <tr>
                    <td><div class="label">Valor Líquido</div></td>
                    <td>
                        <?php 
                            $valorLiquido = $totalVencimentos - $totalDescontos;
                            $color = ($valorLiquido > 0)?'':'style="background-color:red"';
                        ?>
                        <div class="divValue" <?php echo $color;?>><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($valorLiquido) ?></span></div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="line-1">
        <table>
            <tr>
                <td><div class="label">Salário Base</div></td>
                <td><div class="label">Sal. Contr.INSS</div></td>
                <td><div class="label">Base Calc. FGTS</div></td>
                <td><div class="label">FGTS do Mês</div></td>
                <td><div class="label">Base Cálc. IRRF</div></td>
                <td><div class="label">Faixa IRRF</div></td>
            </tr>
            <tr>
                <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase);?></td>
                <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase + $periculosidade);?></td>
                <td style="text-align:center"><?php $baseCalcFgts = $salarioBase + $periculosidade ; echo Util::formataMoeda($baseCalcFgts);?></td>
                <td style="text-align:center"><?php 
                                                $fgts = (8 / 100) * $baseCalcFgts;
                                                echo Util::formataMoeda($fgts); ?></td>
                <td style="text-align:center"><?php 
                echo Util::formataMoeda($baseCalcFgts - $fgts);
                ?>
                </td>
                <td style="text-align:center"></td>
            </tr>
        </table>
        </div>
    </div>
    <?php
        break;
    default:
        echo "service Funcionários Holerite";
        break;

}