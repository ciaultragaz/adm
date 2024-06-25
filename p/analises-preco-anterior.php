<div class="row">
    <div class="col-md-12" id="divFilters">
        <div class="card">
            <div class="card-header">
                <h5>Filtros</h5>
                <div class="card-header-right"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-warning border-warning">
                            <legend class="text-warning"><i class="feather icon-layers"></i> Filtro de Data:
                            </legend>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Selecione a data" id="dtFiltro"
                                    autocomplete="off">
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-habilitacao">
                            <legend class="text-purple-a"><i class="feather icon-user"></i> Motorista:</legend>
                            <div class="form-group fill">
                                <div class="input-group mb-3">
                                    <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple"
                                        id="motoristas">
                                        <option value="0">Selecione</option>
                                        <?php
                                            $M = new Motoristas();
                                            $m = $M->showAll();
                                            foreach ($m as $key => $value) {
                                                echo '<option value="'.$value.'">'.$value.'</option>';
                                            }                                            
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-info btn-block btnPesquisar">Pesquisar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="divTable">
        <div class="card">
            <div class="card-header">
                <h5>Empresas</h5>
                <div class="card-header-right"></div>
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
                                            <option value="50" selected>50</option>
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
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" >Total de registros (129)</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th aria-label="Entregador" class="sorting">Entregador</th>
                                            <th aria-label="Data" class="sorting">Data</th>
                                            <th aria-label="precoMaior" class="sorting">
                                                < Preço </th>
                                            <th aria-label="precoAnterior" class="sorting">Preço ></th>
                                            <th aria-label="dataAnterior" class="sorting">Anterior</th>
                                            <th aria-label="entregadorAnterior" class="sorting">Entregador</th>
                                            <th aria-label="endereco" class="sorting">Endereço</th>
                                            <th aria-label="memo">Memo</th>
                                            <th aria-label="tipo">ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="20" style="text-align:center">
                                                <div class="spinner-border text-light" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Carregando .. .. ..
                                            </td>
                                        </tr>

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