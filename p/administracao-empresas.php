<div class="row">
    <div class="col-sm-12" id="divCadastro">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de Empresas</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                        title="Esconder Formulário de Cadastro" href="javascript:showHideCadastro(0)"><i
                            class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="formCadastro">
                <input type="hidden" value="0" id="idEmpresa" >
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group fill" id="group-razao">
                                <label>Razão Social</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Razão Social" id="razao">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group fill" id="group-razao">
                                <label>Nome Fantasia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome Fantasia" id="fantasia">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-cnpj">
                                <label>CNPJ</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="CNPJ" id="cnpj">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-cep">
                                <label>Inscrição Estadual</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Inscrição Estadual" id="ie">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-cep">
                                <label>Tipo do Cadastro</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <select name="dom-table_length" aria-controls="dom-table"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            id="tipoEmpresa">
                                            <option value="0">Selecione o tipo da Empresa</option>
                                            <?php
                                                $P = new Parametros();
                                                $P->tipo = 'empresas';
                                                $p = $P->getAll();
                                                foreach ($p['data'] as $key => $value) {
                                                echo "<option value=\"".$value['id']."\">".$value['parametro']."</option>";
                                                }
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group fill" id="group-cep">
                                <label>CEP</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="CEP" id="cep">
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
                                    <input type="text" class="form-control" placeholder="Endereço" id="rua">
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
                                    <input type="text" class="form-control" placeholder="Número" id="numero">
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
                                    <input type="text" class="form-control" placeholder="Complemento" id="complemento">
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
                                    <input type="text" class="form-control" placeholder="Bairro" id="bairro">
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
                                    <input type="text" class="form-control" placeholder="Cidade" id="cidade">
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
                                    <input type="text" class="form-control" placeholder="UF" id="uf">
                                </div>
                            </div>
                        </div>
                    </div>             
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>Código Municipal</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Código Municipal" id="codMunicipal">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fill">
                                <label>Código Atividade</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Código Atividade" id="codAtividade">
                                </div>
                            </div>
                        </div>
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
                                            <th class="sorting" aria-label="razao">Razão Social</th>
                                            <th class="sorting" aria-label="fantasia">Nome Fantasia</th>
                                            <th class="sorting" aria-label="cnpj">CNPJ</th>
                                            <th class="sorting" aria-label="endereco">Endereço</th>
                                            <th class="sorting" aria-label="cidade">Cidade</th>
                                            <th class="sorting" aria-label="uf">UF</th>
                                            <th class="sorting" aria-label="tipo">tipo</th>
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