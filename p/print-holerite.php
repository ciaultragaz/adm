<?php
require_once('../_config.php');
?>

<html>
<head>
<style>
    .holerite {
        width: 800px;
        font-family: Consolas, monaco, monospace;
        color: #37643a; /* Move color rule up here to avoid repetition */
    }

    .column {
        width: 50%;
        float: left;
    }

    .line-1 {
        background: linear-gradient(180deg, rgba(255, 255, 255, 1) 14%, rgba(173, 247, 179, 1) 100%);
    }

    table {
        width: 100%;
        border-collapse: collapse; /* Move border-collapse up here to apply to all tables */
    }

    .titleHolerite {
        text-align: center;
        color: #127611;
        font-weight: bold;
        width: 100%;
        padding: 6px;
        font-size: 18px;
    }

    /* Combine repeated rules using comma selector */
    .itens thead tr td,
    .itens tbody tr td,
    .itens tfoot tr td {
        background: linear-gradient(90deg, rgba(255, 255, 255, 1) 50%, rgba(173, 247, 179, 1) 100%);
        margin: 0;
        padding: 0;
    }

    /* Use :nth-child selector to apply rules to specific cells */
    .itens tbody tr td:nth-child(1),
    .itens tbody tr td:nth-child(3) {
        text-align: center;
        width: 50px;
    }

    .itens tbody tr td:nth-child(2) {
        text-align: left;
    }

    .itens tbody tr td:nth-child(4),
    .itens tbody tr td:last-child {
        width: 123px;
    }

    /* Use relative positioning and right padding for the .value class */
    .divValue {
        position: relative;
        width: 100%;            
    }

    .divValue .value {
        position: absolute;
        text-align: right;
        right: 0;
        padding-right: 8px;
    }

    span.sign {
        padding: 7px;
    }

    .itens tbody tr {
        height:19px;
    }

    .assinatura {
        color: #000912;
        width: 485px;
        border-top: 1px solid #000000;
    }

    .dadosAss {
        text-align: center;
    }

    /* Combine .divAss and .page-2 into one rule */
    .divAss, .page-2 {
        display: none;
    }

    @media all {
        .page-break {
            display: none;
        }
    }

    @media print {
        .divAss, .page-2 {
            display: block;
        }
        .divAss {
            bottom: 59px;
            position: fixed;
            left: 25%;
        }
        .page-break {
            display: block;
            page-break-before: always;
        }
         .page-2{
            display: none;
        }

        @media all {
            .page-break {
                display: none;
            }
        }

        @media print {
            .divAss {
                display: block;
                bottom: 59px;
                position: fixed;
                left: 25%;
            }
            .page-2{
                display:block;
            }
            .page-break {
                display: block;
                page-break-before: always;
            }
        }
</style>
</head>
<?php
$idFuncionario = $_REQUEST['idFuncionario'] ?? null;
$idHolerite = $_REQUEST['idHolerite'] ?? null;
$meses = Util::meses();
$mes = $_REQUEST['mes'] ?? null;
$ano = $_REQUEST['ano'] ?? null;
$V->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
$F = new Funcionarios();
$F->id = $idFuncionario;
$dataFuncionario = $F->getById();
$funcionario = $dataFuncionario['data'];

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
$H->mes = $mes;
$H->ano = $ano;

$itens = $H->getByIdHolerite();
?>
<body>
    <div class="holerite">
        <div class="line-1">
            <table>
                <tr>
                    <td><?php echo strtoupper($empresa['razao']); ?></td>
                    <td>
                        <div class="titleHolerite">Recibo de Pagamento de Salário</div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $empresa['cnpj']; ?></td>
                    <td>Referente ao mês de <?php echo $meses[$mes] . " " . $ano; ?></td>
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
                        <div class="label">Nome Funcionário</div>
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
                    <td><?php echo $funcionario['id']; ?></td>
                    <td><?php echo strtoupper($funcionario['nome']); ?></td>
                    <td colspan="7">Referente ao mês de <?php echo $meses[$mes] . " " . $ano; ?></td>
                </tr>
            </table>
        </div>
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
                    echo "<td>" . str_pad($value['idTipoItem'], 2, "0", STR_PAD_LEFT) . "</td>";
                    echo "<td>" . $value['descricao'] . "</td>";
                    switch ($value['desconto']) {
                        case 1:
                            echo "<td></td><td></td><td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">" . Util::formataMoeda($desconto) . "</span></div></td>";
                            $totalDescontos = $totalDescontos + $desconto;
                            break;
                        case 0:
                            switch ($value['idTipoItem']) {
                                case 1:
                                    echo "<td>" . $value['diasUteis'] . "</td>";
                                    $salarioBase = $valor;
                                    break;
                                case 2:
                                    $periculosidade = $valor;
                                    echo "<td>" . $value['diasUteis'] . "</td>";
                                    break;
                                case 3:
                                    echo "<td>" . $holerite['horas'] . "</td>";
                                    break;
                                case 6:
                                case 7:
                                    echo "<td>" . $holerite['diasUteis'] . "</td>";
                                    break;
                                default:
                                    echo "<td></td>";
                                    break;
                            }
                            echo "<td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">" . Util::formataMoeda($valor) . "</span></div></td><td></td>";
                            $totalVencimentos = $totalVencimentos + $valor;
                            break;
                    }
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalVencimentos); ?></span></div>
                    </td>
                    <td>
                        <div class="divValue"><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($totalDescontos); ?></span></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Valor Líquido</div>
                    </td>
                    <td>
                        <?php
                        $valorLiquido = $totalVencimentos - $totalDescontos;
                        $color = ($valorLiquido > 0) ? '' : 'style="background-color:red"';
                        ?>
                        <div class="divValue" <?php echo $color; ?>><span class="sign">R$</span><span class="value"><?php echo Util::formataMoeda($valorLiquido) ?></span></div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="line-1">
            <table>
                <tr>
                    <td>
                        <div class="label">Salário Base</div>
                    </td>
                    <td>
                        <div class="label">Sal. Contr.INSS</div>
                    </td>
                    <td>
                        <div class="label">Base Calc. FGTS</div>
                    </td>
                    <td>
                        <div class="label">FGTS do Mês</div>
                    </td>
                    <td>
                        <div class="label">Base Cálc. IRRF</div>
                    </td>
                    <td>
                        <div class="label">Faixa IRRF</div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase); ?></td>
                    <td style="text-align:center"><?php echo Util::formataMoeda($salarioBase + $periculosidade); ?></td>
                    <td style="text-align:center"><?php $baseCalcFgts = $salarioBase + $periculosidade; echo Util::formataMoeda($baseCalcFgts); ?></td>
                    <td style="text-align:center"><?php 
                        $fgts = (8 / 100) * $baseCalcFgts;
                        echo Util::formataMoeda($fgts);
                        ?></td>
                    <td style="text-align:center"><?php 
                        echo Util::formataMoeda($baseCalcFgts - $fgts);
                        ?>
                    </td>
                    <td style="text-align:center"></td>
                </tr>
        </table>        
        <div class="divAss">
            <hr class="assinatura">
            <div class="dadosAss">
                <?php echo $funcionario['nome']; ?><br>
                CPF:
                <?php echo $funcionario['cpf']; ?>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
