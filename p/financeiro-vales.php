<div class="row">
    <div class="col-md-12">
        <!-- support-section start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card support-bar overflow-hidden cardGraph">
                    <div class="card-body pb-0">
                        <h2 class="m-0 text-purple-a" id="idTotalVales"></h2>
                        <div class="card-header-right">
                            <a class="iconRightCardGraph" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                                href="javascript:showHideGraph(0)"><i class="feather icon-eye-off"></i></a>
                        </div>
                        <span class="text-c-green">Vales</span>
                        <p class="mb-3 mt-3">Saldo de vales dos últimos 12 meses.</p>
                    </div>
                    <div id="support-chart1"></div>
                </div>
            </div>
        </div>
        <!-- support-section end -->
    </div>
    <div class="col-md-12" id="historico">
        <div class="card" id="cardHistorico">
            <div class="card-header" id="headHistorico">
                <h5>Histórico</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:hideHistory()"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="fieldSet text-warning border-warning">
                                    <legend class="text-warning"><i class="feather icon-layers"></i> Filtro de
                                        Funcionários:</legend>
                                    <div class="input-group">
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                            id="multi">
                                            <?php
                                                $F = new Funcionarios();
                                                $funcs = $F->getAllFuncionarios();
                                                $funcs = $funcs['data'];
                                                for($i=0;$i<count($funcs);$i++){
                                                    echo '<option value="'.$funcs[$i]['id'].'">'.$funcs[$i]['id'].' '.$funcs[$i]['nome'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tableHistorico" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="line"></th>
                                            <th class="sorting" aria-label="dataVencimento">ID</th>
                                            <th class="sorting" aria-label="id">Nome</th>
                                            <th class="sorting" aria-label="valor">Data</th>
                                            <th class="sorting" aria-label="obs">Valor</th>
                                            <th class="sorting" aria-label="obs">Observação</th>
                                            <th class="sorting" aria-label="obs">Usuário</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="divFuncionarios">
        <div class="card">
            <div class="card-header">
                <h5>Funcionários</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Lançar Vale"
                        href="javascript:newRegister()"><i class="feather icon-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="dataTables_length">
                                    <label>
                                        Registros:
                                        <select name="dom-table_length" aria-controls="dom-table"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            id="registros">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <input type="text" class="form-control" placeholder="Selecione a data da Atividade"
                                    id="dtAtividade" autocomplete="off">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <input id="search" type="search" class="form-control form-control-sm"
                                    placeholder="Procurar" aria-controls="dom-table">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="id">ID</th>
                                            <th class="sorting" aria-label="nome">Nome</th>
                                            <th class="sorting" aria-label="dataCadastro">Data Cadastro</th>
                                            <th class="sorting" aria-label="saldo">Saldo</th>
                                            <th aria-label="acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="simpletable_info"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
                                    <ul id="pagination" class="pagination"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="divExtrato">
        <div class="card" id="cardExtrato">
            <div class="card-header" id="headExtrato">
                <h5>Extrato</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Lançar Vale"
                    href="javascript:newRegister()"><i class="feather icon-plus"></i></a>
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:hideExtrato(1)"><i class="feather icon-chevron-down"></i></a>
                </div>
                <div class="card-header-right">
                </div>
                <div class="row rowExtrato">
                    <div>
                        <label>Débito</label>
                        <div id="extratoDebito"></div>
                    </div>
                    <div>
                        <label>Crédito</label>
                        <div id="extratoCredito"></div>
                    </div>
                    <div>
                        <label>Saldo</label>
                        <div id="extratoSaldo"></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length">
                                    <label>
                                        Registros:
                                        <select name="dom-table_length" aria-controls="dom-table"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            id="registros_">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dom-table_filter" class="dataTables_filter">
                                    <label>Data:<input id="dataVale" type="search" class="form-control form-control-sm"
                                            placeholder="Data" aria-controls="dom-table" style="width: 200px;"
                                            autocomplete="off"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input id="buscaIn" type="search" class="form-control form-control-sm"
                                    placeholder="Buscar" aria-controls="dom-table" style="width: 100%;"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tableExtrato" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="A.dataVencimento">Data</th>
                                            <th class="sorting" aria-label="id">ID</th>
                                            <th class="sorting" aria-label="valor">Valor</th>
                                            <th class="sorting" aria-label="obs">Observações</th>
                                            <th class="sorting" aria-label="A.dataCadastro">Cadastrado</th>
                                            <th aria-label="acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="simpletable_info_"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate_">
                                    <ul id="pagination_" class="pagination"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="floatVale">
    <form id="formVale">
        <input type="hidden" id="idEdit">
        <div class="card">
            <div class="card-header" id="headerForm">
                <h5>Lançar Vale</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Lançar Vale"
                        href="javascript:showHideLancamento(0)"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="switch switch-primary d-inline m-r-10">
                                <input type="checkbox" id="switch-p-1" checked="">
                                <label for="switch-p-1" class="cr"></label>
                            </div>
                            <label id="labelDebitoCredito">Vale</label>
                        </div>
                    </div>
                </div>
                <div id="selectFuncionario">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-funcionarios">
                        <legend class="text-purple-a"><i class="feather icon-user"></i> Funcionário:</legend>
                        <div class="form-group fill">
                            <div class="input-group">
                                <select class="js-example-placeholder-multiple" id="funcs">
                                    <option value="0">Selecione</option>
                                    <?php
                                        $F = new Funcionarios();
                                        $funcs = $F->getAllFuncionarios();
                                        $funcs = $funcs['data'];
                                        for($i=0;$i<count($funcs);$i++){
                                            echo '<option value="'.$funcs[$i]['id'].'">'.$funcs[$i]['id'].' '.$funcs[$i]['nome'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div id="fieldValores">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-valores">
                        <legend class="text-purple-a"><i class="feather icon-layers"></i> Vale:</legend>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Data Vencimento" id="dtVencimento">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="valor" placeholder="R$ 0,00">
                            <input type="text" class="form-control" id="obs" placeholder="Observações">
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-info btn-block btnAdd">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>