<div class="row">
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header">
                <fieldset class="fieldSet text-success border-success" id="fieldset-edit">
                    <legend class="text-success"><i class="fas fa-cogs"></i> Data Caixa:</legend>
                    <div class="form-group fill">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control text-info" placeholder="Data" id="dataSelecionada"
                                autocomplete="off" value="<?php echo date('d/m/Y');?>">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Motoristas</h5>
            </div>
            <div class="card-body">
                <table id="motoristas-atv">
                    <thead>
                        <tr>
                            <td>N</td>
                            <td>T</td>
                            <td>P</td>
                            <td>Placa</td>
                            <td>Motorista</td>
                        </tr>
                        <tr> </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-yellow count" id="pedidoQtd"></h4>
                                <h6 class="text-muted m-b-0" id="pedidoQtdData"></h6>
                            </div>
                            <div class="col-4 text-c-yellow text-right"> <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow">
                        <div class="row align-items-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-info count" id="pQtd"></h4>
                                <h6 class="text-muted m-b-0" id="p13QtdData"></h6>
                            </div>
                            <div class="col-4 text-info text-right"> <i class="fas fa-spray-can f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow">
                        <div class="row align-items-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green count" id="direcionadosQtd"></h4>
                                <h6 class="text-muted m-b-0" id="direcionadosQtdData"></h6>
                            </div>
                            <div class="col-4 text-right text-c-green"><i class="feather icon-file-text f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green">
                        <div class="row align-items-center"> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="colResumo">
                <div class="card chat-card">
                    <div class="card-header borderless">
                        <h5>Resumo</h5>
                    </div>
                    <div class="card-block">
                        <div class="row" id="rowBody">
                            <div class="col-sm-12">
                                <table id="simpletable" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="simpletable_info" style="display: table;">
                                    <thead>
                                        <tr>
                                            <th colspan="10" class="headTable">
                                                <div class="labelTable">Resumo do dia</div>
                                                <a href="javascript:void(0)" class="btnMinimizeResume"><i
                                                        class="feather icon-minus"></i></a>
                                            </th>
                                        </tr>
                                        <tr role="row" id="headerTable">
                                            <th class="sorting_disabled">Motorista</th>
                                            <th class="sorting_disabled">Produto</th>
                                            <th class="sorting_disabled">Preço</th>
                                            <th class="sorting_disabled">AUTO</th>
                                            <th class="sorting_disabled">DISK</th>
                                            <th class="sorting_disabled">Total</th>
                                            <th class="sorting_disabled">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                                <table id="enderecos" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="simpletable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_enable" style="width: 35px;">#</th>
                                            <th class="sorting_enable">Endereço</th>
                                            <th class="sorting_enable" style="width: 80px;">Horário</th>
                                            <th class="sorting_enable" style="width: 84px;">Produto</th>
                                            <th class="sorting_enable" style="width: 71px;">Tipo</th>
                                            <th class="sorting_enable" style="width: 52px;">Qtd</th>
                                            <th class="sorting_enable" style="width: 65px;">Preço</th>
                                            <th class="sorting_enable" style="width: 65px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4" id="fecharCaixa">
                <div class="card" id="valorCaixa" style="display: block;">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h4><span class="count"></span></h4>
                                <h6 class="text-muted m-b-0" id="dataCaixa"></h6>
                            </div>
                            <div class="col-6 text-right">
                                <h3 id="nomeMotorista"></h3><i class="feather icon-user f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow" style="padding: 0px; height: 46px; background: #b5ff00;">
                        <div class="row align-items-center">
                            <table class="table" id="valores">
                                <tbody>
                                    <tr style="background: #113a0d;" id="rowCredit">
                                        <td scope="row" style="color:#88f734">CRÉDITO</td>
                                        <td><input type="text" class="inputValues" id="credito" disabled=""
                                                style="color: #6bff0e;"></td>
                                    </tr>
                                    <tr style="background:rgb(255, 59, 0);" id="rowDebit">
                                        <td scope="row">DÉBITO</td>
                                        <td><input type="text" class="inputValues" id="debito" disabled=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>