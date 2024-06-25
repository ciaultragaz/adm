<div class="row" id="divCadastro">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>cadastrar Tarefas</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Usuário"
                        href="javascript:hideCadastro(1)"><i class="feather icon-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                            <form id="formCadastro">
                                <table id="tableForm" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="tarefa">Tarefa</th>
                                            <th class="sorting" aria-label="exemplo">exemplo</th>
                                            <th class="sorting" aria-label="cor">modulo</th>
                                            <th class="sorting" aria-label="status">status</th>
                                            <th class="sorting" aria-label="atribuido">atribuido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row">
                                            <td><input type="text" class="form-control form-control-sm" id="tarefa"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="exemplo"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="modulo"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="status"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="idAttr"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="10"><button id="btnAdd" class="btn btn-info btn-sm btn-block">Cadastrar</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12" id="colUsers">
        <div class="card">
            <div class="card-header">
                <h5>Tarefas</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Usuário"
                        href="javascript:showHideCadastro(1)"><i class="feather icon-plus"></i></a>
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
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
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
                                            aria-controls="dom-table"></label>
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
                                            <th class="sorting" aria-label="tarefa">Tarefa</th>
                                            <th class="sorting" aria-label="exemplo">exemplo</th>
                                            <th class="sorting" aria-label="cor">modulo</th>
                                            <th class="sorting" aria-label="status">status</th>
                                            <th class="sorting" aria-label="atribuido">atribuido</th>
                                            <th class="sorting" aria-label="dataRegistro">data Registro</th>
                                            <th class="sorting" aria-label="dataConclusao">data Conclusão</th>
                                            <th aria-label="acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="simpletable_info"></div>
                            </div>
                            <div class="col-sm-12 col-md-7">
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
    <div class="col-sm-4" id="colForm">
        <div class="card" id="cardMenuAccess">
            <div class="card-header">
                <h5>Acesso ao Menu</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Expandir" href="javascript:expandContractAllMenu(1);"><i class="feather icon-maximize"></i></a>
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Contrair" href="javascript:expandContractAllMenu(0);"><i class="feather icon-minimize"></i></a>
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Formulário" href="javascript:showHideForm(0)"><i class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="formMenuAccess">
                    <input type="hidden" id="idUsuario">
                    <div class="col-sm-12" id="myTreeview">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>