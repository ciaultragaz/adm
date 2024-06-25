<?php 
/**
$M= new Motoristas();
Util::pre($M->showAll());
**/ ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Pedidos</h5>
                <div class="card-header-right">
                    <a class="iconRightCard btnShowFilter" data-toggle="tooltip" data-placement="bottom"
                        title="Filtros" href="javascript:showHideFilters()"><i class="feather icon-filter"></i></a>
                    <a class="iconRightCard" data-placement="bottom" title="Pedido" href="javascript:void(0)"
                        data-toggle="modal" data-target="#modalPedido"><i class="feather icon-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div id="divFiltros">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="fieldSet text-success border-warning">
                                <legend class="text-warning"><i class="feather feather icon-filter"></i> Tipos:</legend>
                                <div class="form-group fill">
                                    <div class="input-group">
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                            id="tipoCliente">
                                            <?php
                                                    $C = new Clientes();
                                                    $tipos = $C->getAllTipos();
                                                    $tipos = $tipos['data'];
                                                    for($i=0; $i<count($tipos); $i++ ){
                                                        echo "<option value=\"".$tipos[$i]['Tipo']."\">".$tipos[$i]['Tipo']."</option>";
                                                    }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="fieldSet text-purple-a border-purple">
                                <legend class="text-purple-a"><i class="feather feather icon-filter"></i> Motoristas:
                                </legend>
                                <div class="form-group fill">
                                    <div class="input-group">
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                            id="motoristas">
                                            <?php
                                                    $M = new Motoristas();
                                                    $motoristas = $M->showAll();
                                                    //$motoristas = $motoristas['data'];
                                                    for($i=0; $i<count($motoristas); $i++ ){
                                                        echo "<option value=\"".$motoristas[$i]."\">".$motoristas[$i]."</option>";
                                                    }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
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
                            <div class="col-sm-12 col-md-6">
                                <div>
                                    <input id="search" type="search" class="form-control form-control-sm"
                                        placeholder="Procurar">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div>
                                    <input id="dataSelecionada" type="text" class="form-control form-control-sm"
                                        value="<?php echo date('d/m/Y');?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tbl-pedidos" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Local</th>
                                            <th>Data Hora</th>
                                            <th>Tipo</th>
                                            <th>Endereço</th>
                                            <th>Qtd</th>
                                            <th>Preço</th>
                                            <th>Prod</th>
                                            <th>Tempo</th>
                                            <th>Motorista</th>
                                            <th>Origem</th>
                                            <th>Status</th>
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Large Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-labelledby="modalPedido" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPedidoLabel">Adicionar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" autocomplete="off"
                        placeholder="Procure por endereço">
                    <div id="enderecoSelecionado"></div>
                </div>
                <table id="listEndereco">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Complemento</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="row" id="pagesEnds">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="simpletable_infoModal"></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginateModal">
                            <ul id="paginationModal" class="pagination"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="divProdutos">
                    <div class="form-group fill">
                        <label for="exampleFormControlSelect1">Produtos:</label>
                        <select class="form-control" id="produto">
                            <option value="0">Selecione um Produto</option>
                            <?php
                                $P = new Produtos();
                                $produtos = $P->getAll();
                                foreach ($produtos['data'] as $key => $value) {
                                    echo "<option value=\"".$value['Cod']."\">".$value['Produto']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" id="cart">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pedido</h5>
                        </div>
                        <div class="card-body">
                            <table id="table-cart">
                                <tbody></tbody>
                            </table>
                            <hr>
                            <h6 class="mb-0">Valor Total: <span class="float-right">$2900</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="divFormasPagto">
                    <div class="form-group fill">
                        <label for="exampleFormControlSelect1">Formas de Pagamento:</label>
                        <select class="form-control" id="formasPagto">
                            <option value="0">Selecione a forma de Pagamento</option>
                            <?php
                                $F = new FormasPagamento();
                                $formasPagto = $F->showAll();
                                foreach ($formasPagto as $key => $value) {
                                    echo "<option value=\"".$value."\">".$value."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <form>
                    <input type="hidden" id="idCliente">
                </form>
            </div>
        </div>
    </div>
</div>