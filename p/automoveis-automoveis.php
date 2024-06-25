<div class="row">
    <div class="col-sm-12" id="divCadastro">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de Automóveis</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                        title="Esconder Formulário de Cadastro" href="javascript:showHideCadastro(0)"><i
                            class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="formCadastro">
                <input type="hidden" value="0" id="idCarro" >
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group fill" id="group-placa">
                                <label>Placa</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-car"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Placa" id="placa">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group fill" id="group-renavam">
                                <label>Renavam</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Renavam" id="renavam">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-chassi">
                                <label>Chassi</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Chassi" id="chassi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-marca">
                                <label>Marca</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Marca" id="marca">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-modelo">
                                <label>Modelo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Modelo" id="modelo">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill">
                                <label>Ano</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Ano" id="ano">
                                </div>
                            </div>
                        </div>                                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-block btnAdd">Salvar</button>
                        </div>
                    </div>             
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="colEmpresas">
        <div class="card">
            <div class="card-header">
                <h5>Empresas</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Funcionário"
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
                                            <th class="sorting" aria-label="placa">Placa</th>
                                            <th class="sorting" aria-label="renavam">Renavam</th>
                                            <th class="sorting" aria-label="chassi">Chassi</th>
                                            <th class="sorting" aria-label="marca">Marca</th>
                                            <th class="sorting" aria-label="modelo">Modelo</th>
                                            <th class="sorting" aria-label="ano">Ano</th>                                            
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
</div>