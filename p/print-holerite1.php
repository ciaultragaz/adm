<?php
require_once('../_config.php');
?>

<html>

<head>
  <style>
/* Configurações básicas e reset */
body {
    font-family: Arial, sans-serif;
    background-color: #f3f4f6;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Estilos para holerite */
.holerite {
    width: 800px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    overflow: hidden;
}

.line-1 {
    background: #e9f8e5;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
}

/* Estilos para tabelas */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.label, .titleHolerite {
    font-weight: bold;
}

.label {
    color: #777;
    font-size: 12px;
}

.titleHolerite {
    font-size: 20px;
    color: #2c7a2c;
    margin-bottom: 10px;
}

.itens thead tr td, .itens tbody tr td {
    padding: 5px;
    border: 1px solid #cde0cd;
}

.itens thead tr td {
    background: #d5e9d4;
}

.itens tfoot tr td {
    border-top: 2px solid #2c7a2c;
}

/* Estilos para divisões de valores e assinaturas */
.divValue .value {
    float: right;
}

.divValue .sign {
    float: left;
}

.assinatura {
    width: 100%;
    border-top: 1px dashed #aaa;
    margin-top: 20px;
    padding-top: 20px;
    text-align: center;
}

.dadosAss {
    text-align: center;
    font-size: 14px;
    color: #777;
}

.page-break {
    page-break-before: always;
}

/* Configurações de impressão */
@media print {
    body {
        background-color: #fff;
        color: #000;
    }

    .holerite {
        box-shadow: none;
    }
}

/* Temas */
body.dark {
    background-color: #292c35;
    color: #eaeaea;
}

body.light {
    background-color: #f6f6f6;
    color: #333;
}

/* Modelos para holerite */
.holerite.moderno {
    border: none;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
    background-color: #e9f8e5;
    border-left: 5px solid #2c7a2c;
}

.holerite.classico {
    border: none;
    box-shadow: none;
}

/* Posições para assinaturas */
.assinatura.esquerda {
    text-align: left;
}

.assinatura.direita {
    text-align: right;
}

/* Painel de controle */
#painelControle {
    padding: 15px;
    background-color: #333333;
    border-radius: 5px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgb(21 30 19 / 76%);
    position: fixed;
    top: 15px;
    right: 15px;
    transition: all 0.3s ease-in-out;
    z-index: 1000; /* Certificando que o painel estará acima dos outros elementos */
}

#painelControle label,
#painelControle select,
#painelControle input {
    margin-bottom: 10px;
    display: block;
    font-size: 14px;
    color: #fff;
}

#painelControle select {
    padding: 5px;
    border: none;
    background-color: #fff;
    color: #333;
}

#painelControle:hover {
    background-color: #3d943d;
    cursor: pointer;
}

@media print {
    #painelControle {
        display: none; /* Escondendo o painel de controle ao imprimir */
    }
}

#painelControle:hover #modelo {
    display: block;
}

#painelControle:hover #modelo option:hover {
    background-color: #2c7a2c;
    color: #fff;
}

/* Rodapé e cabeçalho */
.footer, .header {
    position: absolute;
    width: 100%;
    height: auto;
    text-align: center;
    font-size: 12px;
    color: #777;
}

.footer {
    bottom: -50px;
    padding-top: 10px;
    border-top: 1px solid #aaa;
}

.header {
    top: -50px;
    padding-bottom: 10px;
    border-bottom: 1px solid #aaa;
}

/* Marca d'água */
.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    opacity: .5;
}

/* Efeitos diversos */
.zoom:hover {
    transform: scale(1.1);
}

.transition {
    transition: all .3s ease-in-out;
}

.shadow:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, .2);
}

.rounded {
    border-radius: 5px;
}

.gradient {
    background: linear-gradient(to bottom, #f6f6f6, #eaeaea);
}

.dotted {
    border: 1px dotted #ccc;
}

.dashed {
    border: 1px dashed #ccc;
}

/* Animações */
.rotate {
    animation: rotate .8s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.fade-in {
    opacity: 0;
    animation: fade-in .5s ease-in-out forwards;
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.fade-out {
    opacity: 1;
    animation: fade-out .5s ease-in-out forwards;
}

@keyframes fade-out {
    from { opacity: 1; }
    to { opacity: 0; }
}

.slide-in {
    transform: translateX(-100%);
    animation: slide-in .5s ease-in-out forwards;
}

@keyframes slide-in {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}

.slide-out {
    transform: translateX(0);
    animation: slide-out .5s ease-in-out forwards;
}

@keyframes slide-out {
    from { transform: translateX(0); }
    to { transform: translateX(-100%); }
}

.bounce {
    animation: bounce .5s ease-in-out forwards;
}

@keyframes bounce {
    from { transform: translateY(0); }
    to { transform: translateY(-10px); }
}

/* Ícones e botões personalizados */
.icon:before {
    content: "\f007";
    font-family: "Font Awesome 5 Free";
    font-weight: bold;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #2c7a2c;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
}

.btn:hover {
    background-color: #3d943d;
}

</style>
</head>
<?php
$idFuncionario = isset($_REQUEST['idFuncionario']) ? $_REQUEST['idFuncionario'] : null;
$idHolerite = isset($_REQUEST['idHolerite']) ? $_REQUEST['idHolerite'] : null;

$meses = Util::meses();
$mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null;
$ano = (isset($_REQUEST['ano'])) ? $_REQUEST['ano'] : null;

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
    <div id="painelControle">
      <label>Escolha a Cor: </label>
      <select id="corTema">
        <option value="default">Padrão</option>
        <option value="dark">Escuro</option>
        <option value="light">Claro</option>
      </select>

      <label>Modelo: </label>
      <select id="modelo" style="z-index: 1000; position: relative;">
        <option value="default">Padrão</option>
        <option value="moderno">Moderno</option>
        <option value="classico">Clássico</option>
      </select>

      <label>Posição da Assinatura: </label>
      <select id="posicaoAssinatura">
        <option value="default">Centro</option>
        <option value="esquerda">Esquerda</option>
        <option value="direita">Direita</option>
      </select>
    </div>
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
    
    if ($value['desconto'] == 1) {
        echo "<td></td><td></td><td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">" . Util::formataMoeda($desconto) . "</span></div></td>";
        $totalDescontos += $desconto;
    } else {
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
        $totalVencimentos += $valor;
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
          <td colspan="3" rowspan="4" style="background: #;"></td>
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
    </div>
  </div>

  <!-- Second Copy with Employee's Signature and CPF -->
  <div class="page-break"></div>
  <div class="page-2">
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
    
    if ($value['desconto'] == 1) {
        echo "<td></td><td></td><td><div class=\"divValue\"><span class=\"sign\">R$</span><span class=\"value\">" . Util::formataMoeda($desconto) . "</span></div></td>";
        $totalDescontos += $desconto;
    } else {
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
        $totalVencimentos += $valor;
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
            <td colspan="3" rowspan="4" style="background: #;"></td>
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
      </div>
    </div>

    <div class="divAss">
      <hr class="assinatura">
      <div class="dadosAss">
        <?php echo strtoupper($funcionario['nome']); ?><br>
        CPF: <?php echo $funcionario['cpf']; ?>
      </div>
    </div>
  </div>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    var selectCorTema = document.getElementById('corTema');
    var selectModelo = document.getElementById('modelo');
    var selectPosicaoAssinatura = document.getElementById('posicaoAssinatura');
    var holerite = document.querySelector('.holerite');
    var assinatura = document.querySelector('.assinatura');

    // Atualiza a cor do tema conforme a seleção
    selectCorTema.addEventListener('change', function() {
        var escolhaCor = selectCorTema.value;
        document.body.className = escolhaCor;
        switch (escolhaCor) {
            case 'dark':
                holerite.style.color = '#eaeaea';
                break;
            case 'light':
            default:
                holerite.style.color = '#333';
        }
    });

    // Atualiza o modelo conforme a seleção
    selectModelo.addEventListener('change', function() {
        holerite.classList.remove("moderno", "classico"); // Limpa as classes
        var escolhaModelo = selectModelo.value;
        if (escolhaModelo !== 'default') {
            holerite.classList.add(escolhaModelo);
        }
    });

    // Atualiza a posição da assinatura conforme a seleção
    selectPosicaoAssinatura.addEventListener('change', function() {
        var escolhaPosicao = selectPosicaoAssinatura.value;
        if (escolhaPosicao !== 'default') {
            assinatura.className = 'assinatura ' + escolhaPosicao;
        } else {
            assinatura.className = 'assinatura';
        }
    });

    // Define o tema como padrão antes de imprimir
    window.addEventListener("beforeprint", function() {
        document.body.className = 'default';
        holerite.style.color = '#333';
    });
});
  </script>
</body>

</html>