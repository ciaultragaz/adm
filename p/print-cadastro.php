<?php 
require_once('../_config.php');
$idFuncionario = $_REQUEST['idFuncionario'];
$F =  new Funcionarios();
$FB = new FuncionariosBeneficiarios();
$FT = new FuncionariosTurnos();
$F->id = $idFuncionario;
$d = $F->getById();
$d = $d['data'];
?>
<html>

<head>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo $domain;?>assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
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

        table tbody tr {
            border-bottom: #1e2021 solid 1px;
        }

        .assinatura {
            text-align: center;
            margin-top: 58px;
        }
        .page-break {page-break-after: always;}        
    </style>
</head>

<body>
    <div class="container">
        <title>FICHA DE REGISTRO DE EMPREGO - <?php echo $d['nome']; ?></title>
        <h3 class="text-center">FICHA DE REGISTRO DE EMPREGO</h3>
        <fieldset>
            <div class="row">
                <div class="col">
                    <strong>Nome Funcionário:</strong> <?php echo $d['nome']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong>Data Admissão:</strong> <?php echo $d['dataAdmissao']; ?>
                </div>
                <div class="col">
                    <strong>Número do Registro:</strong> <?php echo $d['id']; ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <?php 
                $E = new Empresas();
                $E->id = $d['idEmpresa'];
                $e = $E->getById();
                $e = (isset($e['data'])) ? $e['data'] : null;
                $U = new Util();
            ?>
            <legend>Dados da Empresa</legend>
            <div class="row">
                <div class="col">
                    <strong>Razão Social:</strong> <?php echo (isset($e['razao'])) ? $e['razao'] : null; ?>
                </div>
                <div class="col">
                    <strong>CNPJ:</strong> <?php echo (isset($e['cnpj'])) ? $e['cnpj'] : null;; ?>
                </div>
            </div>
            <div class="row">
                <div class="col"><strong>Nome Fantasia:</strong> <?php echo (isset($e['fantasia'])) ? $e['fantasia'] : null; ?></div>
                <div class="col"><strong>Cod. Municipal:</strong> <?php echo (isset($e['codigo_municipal']))?$e['codigo_municipal']:null; ?></div>
                <div class="col"><strong>Cod. Atividade:</strong> <?php echo (isset($e['codigo_atividade']))?$e['codigo_atividade']:null; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Endereço:</strong> <?php echo (isset($e['endereco']))?$e['endereco']:null; ?></div>
                <div class="col"><strong>Número:</strong> <?php echo   (isset($e['numero']))?$e['numero']:null; ?></div>
            </div>
            <div class="row">
                <div class="col-3"><strong>Complemento:</strong> <?php echo (isset($e['complemento']))?$e['complemento']:null;          ?></div>
                <div class="col-3"><strong>Bairro:</strong> <?php      echo (isset($e['bairro']))?$e['bairro']:null;                ?></div>
                <div class="col-2"><strong>Cidade:</strong> <?php      echo (isset($e['cidade']))?$e['cidade']:null;                ?></div>
                <div class="col-2"><strong>Estado:</strong> <?php      echo (isset($e['uf']))?$e['uf']:null;                      ?></div>
                <div class="col-2"><strong>CEP:</strong> <?php         echo (isset($e['cep']))?$e['cep']:null;                      ?></div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Dados do Empregado</legend>
            <div class="row">
                <div class="col"><strong>Nome da Mãe:</strong> <?php echo $d['mae']; ?></div>
                <div class="col"><strong>Nome do Pai:</strong> <?php echo $d['pai']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Estado Civil:</strong> <?php echo $d['estadoCivil']; ?></div>
                <div class="col"><strong>Natural de:</strong> <?php echo $d['natural']; ?></div>
                <div class="col"><strong>Estado:</strong> <?php echo $d['ufRg']; ?></div>
                <div class="col"><strong>Nacionalidade:</strong> <?php echo $d['nacionalidade']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Data Nascimento:</strong> <?php echo $d['aniversario']; ?></div>
                <div class="col"><strong>Sexo:</strong> <?php echo ($d['genero']=="M")?'Masculino':'Feminino'; ?></div>
                <div class="col"><strong>Instrução:</strong> <?php echo $d['escolaridade']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Endereço:</strong> <?php echo $d['endereco']; ?></div>
                <div class="col"><strong>Número:</strong> <?php echo $d['numero']; ?></div>
            </div>
            <div class="row">
                <div class="col-3"><strong>Complemento:</strong> <?php echo $d['complemento']; ?></div>
                <div class="col-3"><strong>Bairro:</strong> <?php echo $d['bairro']; ?></div>
                <div class="col-2"><strong>Cidade:</strong> <?php echo $d['cidade']; ?></div>
                <div class="col-2"><strong>Estado:</strong> <?php echo $d['uf']; ?></div>
                <div class="col-2"><strong>CEP:</strong> <?php echo $d['cep']; ?></div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Dados do Funcionais</legend>
            <div class="row">
                <div class="col"><strong>Salário Admissão:</strong> <?php echo $d['salario']; ?></div>
                <div class="col"><strong>Cargo Admissão:</strong> <?php echo $d['dataAdmissao']; ?></div>
                <div class="col"><strong>Data exame médico:</strong> <?php echo $d['dataExame']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Horas Semanais:</strong> <?php echo $d['horasSemanais']; ?></div>
                <div class="col"><strong>Horas Mensais:</strong> <?php echo $d['horasMensais']; ?></div>
                <div class="col"><strong>Forma de Pagto:</strong> <?php echo $d['tipoPagto']; ?></div>
            </div>            
        </fieldset>
        <fieldset>
            <legend>Documentos</legend>
            <div class="row">
                <div class="col"><strong>CTPS:</strong> <?php echo $d['ctps']; ?></div>
                <div class="col"><strong>Data Expedição:</strong> <?php echo $d['dataExpedicaoCtps']; ?></div>
                <div class="col"><strong>PIS:</strong> <?php echo $d['pis']; ?></div>
                <div class="col"><strong>Data Cadastro:</strong> <?php echo $d['dataCadastroPis']; ?></div>
            </div>
            <div class="row">
                <div class="col-3"><strong>RG:</strong> <?php echo $d['rg']; ?></div>
                <div class="col-3"><strong>Data Cadastro:</strong> <?php echo $d['dataCadastroRg']; ?></div>
                <div class="col-5"><strong>Orgão Expeditor:</strong> <?php echo $d['orgaoExpeditor']; ?></div>
                <div class="col-1"><strong>UF:</strong> <?php echo $d['ufRg']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Habilitação:</strong> <?php echo $d['habilitacao']; ?></div>
                <div class="col"><strong>Categoria:</strong> <?php echo $d['categoria']; ?></div>
                <div class="col"><strong>Data do Vencimento:</strong> <?php echo $d['dataVencimentoHabilitacao']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col"><strong>Doc. Militar:</strong> <?php echo $d['docMilitar']; ?></div>
                <div class="col"><strong>Nro Doc Militar:</strong> <?php echo $d['numDocMilitar']; ?></div>
                <div class="col"><strong>Cat Doc Militar:</strong> <?php echo $d['catDocMilitar']; ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Titulo Eleitor:</strong> <?php echo $d['tituloEleitor']; ?></div>
                <div class="col"><strong>Zona:</strong> <?php echo $d['zonaEleitoral']; ?></div>
                <div class="col"><strong>Seção:</strong> <?php echo $d['secaoEleitoral']; ?></div>
                <div class="col"><strong>CPF:</strong> <?php echo $d['cpf']; ?></div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Dados Estrangeiros</legend>
            <div class="row">
                <div class="col"><strong>RNE:</strong> <?php echo $d['rne']; ?></div>
                <div class="col"><strong>Tipo de Visto:</strong> <?php echo $d['visto']; ?></div>
                <div class="col"><strong>Validade:</strong> <?php echo $d['dataVencimentoVisto']; ?></div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Horário</legend>
            <table>
                <thead>
                    <tr>
                        <th>Dias da Semana</th>
                        <th class="text-center">Horário de Trabalho</th>
                        <th class="text-center">Intervalo para Repouso e Alimentação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $FT->idFuncionario = $idFuncionario;
                    $b = $FT->get();
                    $dia = Util::diasDaSemana();
                    if($b['total']>=1){
                        foreach ($b['data'] as $key => $value) {
                            echo "<tr>";
                            echo "<td>".$dia[$value['dia']]."</td>";
                            echo "<td class=\"text-center\">".$value['entrada']." as ".$value['saida']."</td>";
                            echo "<td class=\"text-center\">".$value['intervalo']." as ".$value['retorno']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Situação Perante o FGTS</legend>
            <div class="row">
                <div class="col"><strong>É optante:</strong> <?php echo $d['optanteFgts']; ?></div>
                <div class="col"><strong>Data Opção:</strong> <?php echo $d['dataOpcaoFgts']; ?></div>
                <div class="col"><strong>Data Retratação:</strong> <?php echo $d['dataRetratacao']; ?></div>
            </div>
            <div>
                <strong>Banco Depositário:</strong> <?php echo $d['bancoDepositanteFgts']; ?>
            </div>
        </fieldset>
        <div class="page-break"></div>        
        <fieldset>
            <legend>Beneficiarios</legend>
            <?php   
                    $FB->idFuncionario = $idFuncionario;
                    $b = $FB->getallById();
                ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Parentesco</th>
                        <th class="text-center">Data Nascimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($b['total']>=1){
                        foreach ($b['data'] as $key => $value) {
                            echo "<tr>";
                            echo "<td>".$value['nome']."</td>";
                            echo "<td>".$value['grau']."</td>";
                            echo "<td class=\"text-center\">".$value['dataNascimento']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Observações</legend>
            <div class="row">
                <div class="col"><strong>Data Admissão:</strong> <?php echo $d['dataAdmissao']; ?></div>
                <div class="col"><strong>Data Demissão:</strong> <?php echo $d['dataDemissao']; ?></div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="assinatura">
                        <hr><?php echo $d['nome']; ?></div>
                </div>
                <div class="col">
                    <div class="assinatura">
                        <hr><?php echo $d['nome']; ?></div>
                </div>
            </div>
        </fieldset>
    </div>
</body>

</html>