<div class="row">
    <div class="col-md-12" id="divDespesas">
        <div class="card">
            <div class="card-header">
                <h5>Despesas</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Lançar Vale"
                        href="javascript:showHideLancamento(1)"><i class="feather icon-plus"></i></a>
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Cadastrar tipos de Despesas"
                        href="javascript:showHideCadDespesas(1)"><i class="fas fa-plus-square"></i></a>
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
                                            id="registros">
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
                                    <label>Procurar:<input id="search" type="search"
                                            class="form-control form-control-sm" placeholder="Procurar"
                                            aria-controls="dom-table" style="width: 111px;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="id">ID</th>
                                            <th class="sorting" aria-label="nome">Despesa</th>
                                            <th class="sorting" aria-label="dataCadastro">Data Cadastro</th>
                                            <th class="sorting" aria-label="valor">Valor</th>
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
    <div class="col-md-6" id="divExtrato">
        <div class="card" id="cardExtrato">
            <div class="card-header" id="headExtrato">
                <h5>Extrato</h5>
                <div class="card-header-right">
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
                                            id="registros">
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
                                <table id="tableExtrato" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="dataCadastro">Data</th>
                                            <th class="sorting" aria-label="valor">Valor</th>
                                            <th class="sorting" aria-label="obs">Observações</th>
                                            <th>Ações</th>
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
<div id="floatDespesas">
    <form id="formDespesas">
        <div class="card">
            <div class="card-header">
                <h5>Lançar Despesa</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:showHideLancamento(0)"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div id="selects">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-funcionarios">
                        <legend class="text-purple-a"><i class="fas fa-vote-yea"></i> Despesa:</legend>
                        <div class="form-group fill">
                            <div class="input-group">
                                <select class="js-example-placeholder-multiple" id="despesas" tabindex="1">
                                    <option value="0">Selecione a Despesa</option>
                                    <?php
                                        $P = new Parametros();
                                        $P->tipo = 'despesas';
                                        $p = $P->getAll();
                                        $p = $p['data'];
                                        for($i=0;$i<count($p);$i++){
                                            echo '<option value="'.$p[$i]['id'].'">'.$p[$i]['parametro'].'</option>';
                                        }
                                    ?>
                                </select>
                                <select id="empresas" tabindex="2">
                                    <option value="0">Selecione a Empresa</option>
                                    <?php
                                        $E = new Empresas();
                                        $E->filter = 'idParametro';
                                        $E->filterValue = 9;
                                        $e = $E->getAllSelect();
                                        $e = $e['data'];
                                        for($i=0;$i<count($e);$i++){
                                            echo '<option value="'.$e[$i]['id'].'">'.$e[$i]['empresa'].'</option>';
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
                            <input type="text" class="form-control" placeholder="Data Vencimento" id="dtVencimento"  tabindex="3">
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
<div id="floatCadDespesas">
    <form id="formCadDespesas">
        <div class="card">
            <div class="card-header">
                <h5>Cadastrar Despesa</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:showHideCadDespesas(0)"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div id="selectFuncionariox">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-funcionarios">
                        <legend class="text-purple-a"><i class="fas fa-vote-yea"></i> Despesa:</legend>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Despesa" id="despesa">
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-info btn-block btnAddDespesa">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>