<div class="row">
    <div class="col-md-12" id="divParametros">
        <div class="card">
            <div class="card-header">
                <h5>Parâmetros</h5>
                <div class="card-header-right">
                    <a class="iconRightCard btnAddNew" data-toggle="tooltip" data-placement="bottom" title="Cadastrar Parâmetro"
                        href="javascript:void(0)"><i class="feather icon-plus"></i></a>
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
                                            <th class="sorting" aria-label="parametro">Parâmetro</th>
                                            <th class="sorting" aria-label="tipo">Tipo</th>
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
    <div class="col-md-4" id="divForm">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title=""
                        href="javascript:showHideForm(0)" data-original-title="Esconder"><i
                            class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div id="dom-table_filter" class="dataTables_filter">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="formCadastro">
                                    <input type="hidden" id="idParametro" value="0">
                                    <fieldset class="fieldSet text-info border-info" id="fieldset-admissionais">
                                        <legend class="text-info"><i class="fas fa-braille"></i> Parâmetro:
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group fill">
                                                    <label>Parâmetro</label>
                                                    <div class="input-group mb-12">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-info"><i
                                                                    class="fas fa-braille"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control text-info"
                                                            placeholder="Parâmetro" id="parametro">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border-info">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group fill">
                                                    <label>Tipo</label>
                                                    <div class="input-group mb-12">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-info"><i
                                                                    class="fas fa-th-list"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control text-info"
                                                            placeholder="Tipo" id="tipo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="button"
                                                    class="btn btn-info btn-block btnAdd">Salvar</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>