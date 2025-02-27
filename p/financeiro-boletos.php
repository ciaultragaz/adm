<div class="row">
    <div class="col-sm-12" id="colUsers">
        <div class="card">
            <div class="card-header">
                <h5>Usuários</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Usuário"
                        href="javascript:showHideCadastro(1)"><i class="feather icon-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <?php
                    $B = new Boletos();
                    $B->getAll();
                ?>
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
                                            <th class="sorting" aria-label="nome">Nome</th>
                                            <th class="sorting" aria-label="email">E-mail</th>
                                            <th class="sorting" aria-label="cor">Cor</th>
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
                <h5>Formulário</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Formulário"
                        href="javascript:showHideForm(0)"><i class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12" id="myTreeview">
                </div>
            </div>
        </div>
    </div>
</div>