<div class="row">
    <div class="col-lg-4 col-md-12" id="colInfos">
        <div class="card" id="cardCalendar">
            <div class="card-header">
                <h5>Calendário</h5>
            </div>
            <div class="card-body" id="cal">
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12" id="calendar">
        <div class="card" id="cardFuncionarios">
            <div class="card-header">
                <h5>Funcionários</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" href="javascript:showHideLancamento(1)"><i class="feather icon-plus"></i></a>
                </div>                
            </div>
            <div class="card-body" id="bodyFuncionarios">
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                        <select id="filterFuncionario" class="custom-select custom-select-sm ">
                            <option value="0">Todos Funcionários</option>
                            <?php
                                                $F = new Funcionarios();
                                                $F->demitidos = false;
                                                $funcs = $F->getAllFuncionarios();
                                                $funcs = $funcs['data'];
                                                for($i=0;$i<count($funcs);$i++){
                                                    echo '<option value="'.$funcs[$i]['id'].'">'.$funcs[$i]['id'].' '.$funcs[$i]['nome'].'</option>';
                                                }
                                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <select id="filterCargo" class="custom-select custom-select-sm ">
                            <option value="0">Todos os Cargos</option>
                            <?php
                                                $C = new Cargos();
                                                $cargos = $C->getAll();
                                                $cargos = $cargos['data'];
                                                for($i=0;$i<count($cargos);$i++){
                                                    echo '<option value="'.$cargos[$i]['id'].'">'.$cargos[$i]['cargo'].'</option>';
                                                }
                                            ?>
                        </select>
                    </div>
                    <div class="col-sm-5 col-md-5">
                        <div id="divFilterSelected">
                            <a class="btnRemoveFilter" href="javascript:removeFilterDay();"><i
                                    class="feather icon-x"></i></a>
                            <div id="filterSelected"></div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <div class="divFilterByType">
                            <div class="btn-group" role="group">
                                <div class="dropdown dropdown-lg">
                                    <button type="button" class="btn btn-default dropdown-toggle has-ripple text-white"
                                        data-toggle="dropdown" aria-expanded="true" id="btnFilter"><i
                                            class="feather icon-filter"></i><span
                                            class="ripple ripple-animate"></span></button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end">
                                        <form class="form-horizontal col-sm-12" role="form">
                                            <?php
                                            $P = new Parametros();
                                            $P->tipo = 'eventos';
                                            $parametros = $P->getAll();
                                            $parametros = $parametros['data'];
                                            foreach ($parametros as $key => $value) {
                                                if($value['id']!="13"){
                                                    //echo "<input type=\"checkbox\" value=\"".$value['id']."\">".$value['parametro']."";
                                                    echo '<div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input typeEvento" id="type_'.$value['parametro'].'" value="'.$value['id'].'">
                                                        <label class="custom-control-label" for="type_'.$value['parametro'].'">'.$value['parametro'].'</label>
                                                    </div>';
                                                }
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tableFuncionarios" class="table table-striped table-bordered nowrap dataTable">
                    <thead>
                        <tr>
                            <th>Folgas</th>
                            <th>Funcionário</th>
                            <th>Dias</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <?php /**
        <div class="card">
            <div class="card-header" id="headTableCalendar">
                <h5>
                    <?php
                    //Util::pre($_REQUEST);
                    $mes = date('m');
                    $ano = date('Y');
                    echo Util::mes($mes);?>
        <?php echo $ano;?>
        </h5>
        <div class="card-header-right">
            <a class="btnShowForm" href="javascript:void(0)"><i class="feather icon-plus"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <select id="mes" name="dom-table_length" aria-controls="dom-table"
                    class="custom-select custom-select-sm form-control form-control-sm">
                    <?php
                                            $meses = Util::meses();
                                            foreach ($meses as $key => $value) {
                                                $selected = ($mes == $key)?"selected":"";
                                                echo "<option value=\"".$key."\" $selected>".$value."</option>";
                                            }
                                        ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-4">
                <select id="ano" name="dom-table_length" aria-controls="dom-table"
                    class="custom-select custom-select-sm form-control form-control-sm">
                    <?php
                                            $anos = Util::anos();
                                            foreach ($anos as $key => $value) {
                                                $selected = ($ano == $key)?"selected":"";
                                                echo "<option value=\"".$key."\" $selected>".$value."</option>";
                                            }
                                        ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-4">
                <select id="filterFuncionario" class="custom-select custom-select-sm ">
                    <option value="0">Todos</option>
                    <?php
                                        $F = new Funcionarios();
                                        $F->demitidos = false;
                                        $funcs = $F->getAllFuncionarios();
                                        $funcs = $funcs['data'];
                                        for($i=0;$i<count($funcs);$i++){
                                            echo '<option value="'.$funcs[$i]['id'].'">'.$funcs[$i]['id'].' '.$funcs[$i]['nome'].'</option>';
                                        }
                                    ?>
                </select>
            </div>
        </div>
        <table id="table_folgas">
            <thead>
                <th colspan="100%">
                </th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
**/ ?>
</div>
</div>
<div id="floatVale">
    <form id="formFolga">
        <input type="hidden" id="idFolga" value="0">
        <div class="card">
            <div class="card-header" id="headerForm">
                <h5>Cadastrar Folga</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:showHideLancamento(0)"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div id="selectFuncionario">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-funcionarios">
                        <legend class="text-purple-a"><i class="feather icon-user"></i> Funcionário:</legend>
                        <div class="form-group fill">
                            <div class="input-group">
                                <select class="js-example-placeholder-multiple" id="funcs">
                                    <option value="0">Selecione</option>
                                    <?php
                                        $F = new Funcionarios();
                                        $F->demitidos = false;
                                        $funcs = $F->getAllFuncionarios();
                                        $funcs = $funcs['data'];
                                        for($i=0;$i<count($funcs);$i++){
                                            echo '<option value="'.$funcs[$i]['id'].'">'.$funcs[$i]['id'].' '.$funcs[$i]['nome'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div id="fieldValores">
                    <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-valores">
                        <legend class="text-purple-a"><i class="feather icon-layers"></i> Data e Tipo:</legend>
                        <div class="input-group">
                            <select class="form-control" id="tipo">
                                <option value="0">Selecine o tipo</option>
                                <?php
                                    foreach ($parametros as $key => $value) {
                                        if($value['id']!="13"){
                                            echo "<option value=\"".$value['id']."\">".$value['parametro']."</option>";
                                        }                                        
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Observação" id="obs" value=""
                                autocomplete="off">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Data" id="dtFolga" value=""
                                autocomplete="off">
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-info btn-block btnAdd">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="modalEvento" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modalEventoLabel"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit">
                    <div class="input-group">
                        <select class="form-control" id="tipoEdit" name="tipo">
                            <?php
                                    $P = new Parametros();
                                    $P->tipo = 'eventos';
                                    $parametros = $P->getAll();
                                    $parametros = $parametros['data'];
                                    foreach ($parametros as $key => $value) {
                                        if($value['id']!="13"){
                                            echo "<option value=\"".$value['id']."\">".$value['parametro']."</option>";
                                        }                                        
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Observação" id="editObs" value=""
                            autocomplete="off" name="obs">
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Data" id="editDtFolga" value=""
                            autocomplete="off" name="dataEvento">
                    </div>
                    <input type="hidden" id="idEvento" name="id">
                </form>
            </div>
        </div>
    </div>
</div>