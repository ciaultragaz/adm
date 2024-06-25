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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $domain; ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $domain; ?>assets/css/plugins/bootstrap.min.css">
    <style>
        /* Estilos CSS aqui */
    </style>
    <title>Relatório de Vales - <?php echo $f['nome'] ?? ''; ?></title>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <td rowspan="4"><img src="../img/logo-vertical.png" width="110"></td>
                <td rowspan="4" style="font-size: 23px; font-weight: 700;">Relatório de Vales</td>
                <td style="text-align: center;"><?php echo $f['nome'] ?? ''; ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-size: 13px;">
                    <strong>Período:</strong> <?php echo $dateRange[0]; ?> <strong>até</strong>: <?php echo $dateRange[1]; ?>
                </td>
            </tr>
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
                <?php foreach ($d as $key => $value) { ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['dataVencimento']; ?></td>
                        <td><?php echo $value['id']; ?></td>
                        <td>R$ <?php echo Util::formataMoeda($value['valor']); ?></td>
                        <td><?php echo ($value['valor'] < 0) ? 'Vale' : 'Crédito'; ?></td>
                        <td><?php echo $value['obs']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td>Total:</td>
                    <td>R$ <?php echo Util::formataMoeda($total); ?></td>
                    <td><?php echo ($total != '0,00') ? ($total > 0 ? 'Credor' : 'Devedor') : ''; ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="divAss">
            <hr class="assinatura">
            <div class="dadosAss">
                <?php echo $f['nome'] ?? ''; ?><br> 
                CPF: <?php echo $f['cpf'] ?? ''; ?>
            </div>
        </div>
        <div class="page-break"></div>
        <div class="page-2">
            <!-- Repetição da tabela com dados adicionais, se necessário -->
        </div>
    </div>
</body>
</html>
