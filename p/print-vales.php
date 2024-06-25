<?php 
require_once('../_config.php');
$F = new Funcionarios();
$F->id = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
$f = $F->getById();
$f = $f['data'];
$V =  new Vales();
$V->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;
$V->range = (isset($_REQUEST['range'])) ? $_REQUEST['range'] : null;
$V->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
$V->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
$V->fieldSort = 'dataVencimento';
$V->sort = 'ASC';
$V->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
$d = $V->getByIdFuncionario();
$d = $d['data'];
$dateRange =  explode ( " - ", $V->range );
?>
<html>
<head>
    <link rel="icon" href="<?php echo $domain;?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $domain;?>assets/css/plugins/bootstrap.min.css">
    <style>
        html,
        body {
            padding: 5px;
        }

        fieldset {
            border: black solid 1px;
            padding: 15px;
        }

        fieldset legend {
            width: auto;
            padding: 7px;
            margin-bottom: -14px;
        }

        table {
            width: 100%;
        }
        table thead tr{
            background: #b1b1b1;
        }
        table tbody tr {
            border-bottom: #1e2021 solid 1px;
        }
        table tbody tr:nth-child(even){
            background: #eeeeee;
        }
        table tbody tr td:nth-child(6){
         
        }
        .assinatura {
            color: #000912;
            width: 485px;
            border-top: 1px solid #000000;
        }

        .dadosAss {
            text-align: center;
        }

        .divAss {
            display: none;
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
<title>Relatório de Vales -<?php echo $f['nome']; ?></title>
<body>
    <div class="container">
        <table>
            <tr>
                <td rowspan="4"><img src="../img/logo-vertical.png" width="110"></td>
                <td rowspan="4" style="    font-size: 23px;font-weight: 700;">Relatório de Vales</td>
                <td style="text-align:center"><?php echo $f['nome']; ?></td>
            </tr>
            <tr><td style="text-align:right;font-size: 13px;"><strong>Período:</strong> <?php echo $dateRange[0]; ?> <strong>até</strong>: <?php echo $dateRange[1]; ?></td></tr>
        </table>
        <hr>
        <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Data</th>
                        <th>Id</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($d as $key => $value) {
                        $total = $total + $value['valor'];
                        $vale = ($value['valor'] < 0) ? 'Vale' : 'Crédito';
                        echo "<tr>
                            <td>".($key+1)."</td>
                            <td>".$value['dataVencimento']."</td>
                            <td>".$value['id']."</td>
                            <td>R$ ".Util::formataMoeda(($value['valor']))."</td>
                            <td>".$vale."</td>
                            <td>&nbsp;&nbsp;&nbsp;".$value['obs']."</td>
                            </tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total:</td>
                        <td>R$
                            <?php echo Util::formataMoeda($total);?>
                        </td>
                        <td>
                            <?php  
                                if (Util::formataMoeda($total) != '0,00' ){
                                    echo ($total > 0 ) ? 'Credor': 'Devedor';
                                }
                            ?>
                        </td>
                    </tr>
                </tfoot>
        </table>        
        <div class="divAss">
            <hr class="assinatura">
            <div class="dadosAss">
                <?php echo $f['nome']; ?><br> 
                CPF:
                <?php echo $f['cpf']; ?>
            </div>
        </div>
        <div class="page-break"></div>
        <div class="page-2">
        <table>
            <tr>
                <td rowspan="4"><img src="../img/logo-vertical.png" width="110"></td>
                <td rowspan="4" style="    font-size: 23px;font-weight: 700;">Relatório de Vales</td>
                <td style="text-align:center"><?php echo $f['nome']; ?></td>
            </tr>
            <tr><td style="text-align:right;font-size: 13px;"><strong>Período:</strong> <?php echo $dateRange[0]; ?> <strong>até</strong>: <?php echo $dateRange[1]; ?></td></tr>
        </table>
        <hr>
        <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Data</th>
                        <th>Id</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($d as $key => $value) {
                        $total = $total + $value['valor'];
                        $vale = ($value['valor'] < 0) ? 'Vale' : 'Crédito';
                        echo "<tr>
                            <td>".($key+1)."</td>
                            <td>".$value['dataVencimento']."</td>
                            <td>".$value['id']."</td>
                            <td>R$ ".Util::formataMoeda(($value['valor']))."</td>
                            <td>".$vale."</td>
                            <td>&nbsp;&nbsp;&nbsp;".$value['obs']."</td>
                            </tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total:</td>
                        <td>R$
                            <?php echo Util::formataMoeda($total);?>
                        </td>
                        <td>
                            <?php  
                                if (Util::formataMoeda($total) != '0,00' ){
                                    echo ($total > 0 ) ? 'Credor': 'Devedor';
                                }
                            ?>
                        </td>
                    </tr>
                </tfoot>
        </table>        
        <div class="divAss">
            <hr class="assinatura">
            <div class="dadosAss">
                <?php echo $f['nome']; ?><br>
                CPF:
                <?php echo $f['cpf']; ?>
            </div>
        </div>
        </div>
    </div>

</body>

</html>