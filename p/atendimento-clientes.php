<div class="row">
    <div class="col-md-6">
        <a href="/atendimento/clientes">
            <div class="card bg-c-blue order-card">
                <div class="card-body">
                    <h6 class="text-white">Clientes</h6>
                    <h2 class="text-white" id="qtdClientes">
                        <?php 
                        $C = new Clientes();
                        $d = $C->getCount();
                        echo $d['data']['qtd'];
                        ?>
                    </h2>
                    <p class="m-b-0">&nbsp;</p>
                    <i class="card-icon feather icon-users"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="/atendimento/clientes/localizados">
            <div class="card bg-c-green order-card">
                <div class="card-body">
                    <h6 class="text-white">Localização</h6>
                    <h2 class="text-white" id="qtdLocalizados">0</h2>
                    <p class="m-b-0">&nbsp;</p>
                    <i class="card-icon feather icon-map-pin text-purple-a"></i>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12" id="divCadastro">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de Cliente</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                        title="Esconder Formulário de Cadastro" href="javascript:showHideCadastro(0)"><i
                            class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="formCadastro">
                    <input type="hidden" value="0" id="codigo" name="codigo">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fill" id="group-nome">
                                <label>Nome</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group fill">
                                <label>Endereço</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Endereço" id="rua" name="rua">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group fill">
                                <label>Número</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número" id="numero" name="numero">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group fill">
                                <label>Complemento</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Complemento" id="complemento" name="complemento">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group fill">
                                <label>Bairro</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Bairro" id="bairro" name="bairro">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>Cidade</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Cidade" id="cidade" name="cidade">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>UF</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="UF" id="uf" name="uf">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>Tipo de Cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <select class="form-control text-warning" id="tipoCadastro" name="tipo">
                                        <option value="0">Selecione o tipo</option>
                                        <?php
                                           $C = new Clientes();
                                           $c = $C->getAllTipos();
                                           foreach ($c['data'] as $key => $value) {
                                              echo "<option value=\"".$value['Tipo']."\">".$value['Tipo']."</option>";
                                           }
                                        ?>
                                     </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>Observação</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Observação" id="obs" name="obs">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-block btnSave">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="colClientes">
        <div class="card">
            <div class="card-header">
                <h5>Clientes</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Filtros"
                        href="javascript:showHideFiltros(1)"><i class="feather icon-filter"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="divFiltros">
                    <fieldset class="fieldSet text-success border-success">
                        <legend class="text-success"><i class="feather feather icon-filter"></i> Bairros:</legend>
                        <div class="form-group fill">
                            <div class="input-group">
                                <select class="js-example-basic-multiple col-sm-12" multiple="multiple" id="multi">
                                    <?php
                                        $C = new Clientes();
                                        $clientes = $C->getAllBairros();
                                        $clientes = $clientes['data'];
                                        for($i=0;$i<count($clientes);$i++){
                                            echo '<option value="'.$clientes[$i]['Bairro'].'">'.$clientes[$i]['Bairro'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="fieldSet text-success border-warning">
                                <legend class="text-warning"><i class="feather feather icon-filter"></i> Tipos:
                                </legend>
                                <div class="form-group fill">
                                    <div class="input-group">
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                            id="tipo">
                                            <?php
                                                $T = new Clientes();
                                                $tipos = $T->getAllTipos();
                                                $tipos = $tipos['data'];
                                                for($i=0;$i<count($tipos);$i++){
                                                    echo '<option value="'.$tipos[$i]['Tipo'].'">'.$tipos[$i]['Tipo'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="fieldSet text-purple-a border-purple">
                                <legend class="text-purple-a"><i class="feather feather icon-filter"></i> CEP:
                                </legend>
                                <div class="form-group fill">
                                    <div class="input-group">
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple"
                                            id="cep">
                                            <?php
                                                $C = new Clientes();
                                                $cep = $C->getAllCep();
                                                $cep = $cep['data'];
                                                for($i=0;$i<count($cep);$i++){
                                                    echo '<option value="'.$cep[$i]['CEP'].'">'.$cep[$i]['CEP'].'</option>';
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
                        <!--header table-->
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length">
                                    <label>
                                        Registros:
                                        <select name="dom-table_length" aria-controls="dom-table"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            id="registros">
                                            <option value="10">10</option>
                                            <option value="25" selected>25</option>
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
                        <!--content table-->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="Nome">Nome</th>
                                            <th class="sorting" aria-label="Endereço">Endereço</th>
                                            <th class="sorting" aria-label="Tipo">Tipo</th>
                                            <th aria-label="acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--pagination-->
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
    <div class="col-md-3" id="colInfos">
        <div class="divMemo"></div>
        <div class="divPhone"></div>
    </div>
</div>