<?php
   $pageSis = 'funcionarios-horas';
   $month = (isset($_SESSION[$pageSis]['month'])) ? $_SESSION[$pageSis]['month'] : date('m');
   $year  = (isset($_SESSION[$pageSis]['year'])) ? $_SESSION[$pageSis]['year'] : date('Y');
?>
<div class="row">
    <div class="col-md-12" id="cardUpload">
        <div class="card">
            <div class="card-header">
                <h5>Envie o arquivo</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                        href="javascript:showHideUpLoad(0)"><i class="feather icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="/s/uploadTxt.php" class="dropzone" id="myDrop">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="colFuncionarios">
        <div class="card">
            <div class="card-header">
                <h5>Funcionários</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                        title="Enviar Arquivo de Horas" href="javascript:showHideUpLoad(1)"><i
                            class="feather icon-upload-cloud"></i></a>
                </div>
            </div>
            <div class="card-body">            
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-2 col-md-2">
                                <div class="dataTables_length">
                                    <label>
                                        Registros:
                                        <select class="custom-select custom-select-sm form-control form-control-sm" id="registros">                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100" selected="selected">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <div class="dataTables_length">
                                    <label>
                                        Mês:
                                        <select class="custom-select custom-select-sm form-control form-control-sm"
                                            id="month">
                                            <?php
                                                for($i=1;$i<=12;$i++){
                                                    $selected = ($i == $month) ?'selected':'';
                                                    echo  "<option value='".$i."' $selected>".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>";
                                                }
                                                ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <div class="dataTables_length">
                                    <label>
                                        Ano:
                                        <select class="custom-select custom-select-sm form-control form-control-sm"
                                            id="year">
                                            <?php
                                            $before = date('Y', strtotime('-5 years'));
                                            for($i=$before;$i<=date("Y");$i++){
                                                $selected = ($i == $year) ?'selected':'';
                                                echo "<option value='".$i."' $selected>".$i."</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group" id="adv-search">
                                    <input type="text" class="form-control" placeholder="Procurar" id="searchFuncionario" />
                                    <div class="btn-group" role="group">
                                        <div class="dropdown dropdown-lg">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false" id="btnFilter"><i
                                                    class="feather icon-filter"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                <form class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label for="filter">Filtrar por </label>
                                                        <select class="form-control" id="filterCargo">
                                                            <option value="0">Selecione o cargo</option>
                                                            <?php
                                                            $C = new Cargos();
                                                            $cargos = $C->getAll();
                                                            foreach ($cargos['data'] as $key => $value) {
                                                                echo "<option value=\"".$value['id']."\">".$value['cargo']."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contain">Mostrar Demitidos</label>
                                                        <select class="form-control" id="filterDemitidos">
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contain">Contains the words</label>
                                                        <input class="form-control" type="text" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                </form>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="btnSearch"><i class="feather icon-search" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" aria-label="idPonto">ID</th>
                                            <th class="sorting" aria-label="nomeFormat">Nome Funcionário</th>
                                            <th class="sorting" aria-label="turno">turno</th>
                                            <th>Nome Ponto</th>
                                            <th colspan="2">Ações</th>
                                            <td><i class="feather icon-alert-triangle text-danger"></i></td>
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalLarge">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalManualLabel" aria-hidden="true" id="modalManual">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="modalManualLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar horário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="date">
                    <input type="hidden" id="idPonto">
                    <input type="hidden" id="nomePonto">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Hora:</label>
                        <input type="text" class="form-control time" id="recipient-name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">fechar</button>
                <button type="button" class="btn  btn-primary" id="btnAddHour">Adicionar</button>
            </div>
        </div>
    </div>
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