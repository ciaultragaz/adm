<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5>Filtros</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-success border-success" id="fieldset-edit">
                            <legend class="text-success"><i class="feather icon-calendar"></i> Data:</legend>
                            <input type="text" name="daterange" class="form-control"
                                value="05/11/2020 - <?php echo date('d/m/Y');?>">
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-habilitacao">
                            <legend class="text-purple-a"><i class="feather icon-user"></i> Usuário:</legend>
                            <div class="form-group fill">
                                <div class="input-group mb-3">
                                    <select class="js-example-placeholder-multiple col-sm-12" id="users">
                                        <option value="0">Selecione</option>
                                        <?php
                                            $H = new Historico();
                                            $users = $H->getAllUsers();
                                            $users = $users['data'];
                                            for($i=0;$i<count($users);$i++){
                                                echo '<option value="'.$users[$i]['id'].'">'.$users[$i]['nome'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-warning border-warning" id="fieldset-registro">
                            <legend class="text-warning"><i class="fas fa-key"></i> Registro:</legend>
                            <input type="text" name="registro" class="form-control" placeholder="Registro" id="registro">
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldSet text-info border-info" id="fieldset-actions">
                            <legend class="text-info"><i class="feather icon-settings"></i> Ações:</legend>
                            <div class="form-group fill">
                                <div class="input-group mb-3">
                                    <select class="js-example-placeholder-multiple col-sm-12" id="actions">
                                        <option value="0">Selecione</option>
                                        <?php
                                            $A = new Actions();
                                            $actions = $A->getAll();
                                            $actions = $actions['data'];
                                            for($i=0;$i<count($actions);$i++){
                                                echo '<option value="'.$actions[$i]['id'].'">'.ucfirst($actions[$i]['action']).'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-modulo">
                            <legend class="text-purple-a"><i class="feather icon-grid"></i> Módulo:</legend>
                            <div class="form-group fill">
                                <div class="input-group mb-3">
                                    <select class="js-example-placeholder-multiple col-sm-12" id="module">
                                        <option value="0">Selecione</option>
                                        <?php
                                            $M = new Modules();
                                            $modules = $M->getAllForOption();
                                            $modules = $modules['data'];
                                            for($i=0;$i<count($modules);$i++){
                                                echo '<option value="'.$modules[$i]['id'].'">'.$modules[$i]['module'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <div class="card latest-update-card" id="cardHistoryCargos">
            <div class="card-header">
                <h5>Histórico </h5>
            </div>
            <div class="card-body">
                <div class="latest-update-box">
                </div>
                <div class="col-sm-6">
                    <div class="text-center">
                        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
                            <ul id="pagination" class="pagination"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>