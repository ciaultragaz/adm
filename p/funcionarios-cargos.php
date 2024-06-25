<div class="row">
    <div class="col-sm-12" id="divForm">
        <form id="form_">
            <input type="hidden" id="idCargo">
            <div class="card">
                <div class="card-header">
                    <h5>Cargos</h5>
                    <div class="card-header-right">
                        <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder"
                            href="javascript:hideForm()"><i class="feather icon-eye-off"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr role="row">
                                <th>Cargo</th>
                                <th>Salário</th>
                                <th>Periculosidade</th>
                                <th>Transporte</th>
                                <th>Refeição</th>
                                <th>Cesta</th>
                                <th>Inss</th>
                                <th>Desc. VT</th>
                                <th>Desc. VR</th>
                                <th>Desc. Cesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" id="cargo" name="cargo"></td>
                                <td><input type="text" class="valor" id="salario" name="salario"></td>
                                <td><input type="text" class="valor" id="periculosidade" name="periculosidade"></td>
                                <td><input type="text" class="valor" id="transporte" name="transporte"></td>
                                <td><input type="text" class="valor" id="refeicao" name="refeicao"></td>
                                <td><input type="text" class="valor" id="cesta" name="cesta"></td>
                                <td><input type="text" class="valor" id="inss" name="inss"></td>
                                <td><input type="text" class="valor" id="desc_vt" name="desc_vt"></td>
                                <td><input type="text" class="valor" id="desc_vr" name="desc_vr"></td>
                                <td><input type="text" class="valor" id="desc_cesta" name="desc_cesta"></td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <button type="button" class="btn btn-info btn-block btnSave">Salvar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-12" id="colCargos">
        <div class="card" id="cardForm">
            <div class="card-header">
                <h5>Cargos</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Cargo"
                        href="javascript:showAddCargo()"><i class="feather icon-plus-circle"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div id="dom-table_filter" class="dataTables_filter">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table_cargos" class="table table-striped table-bordered nowrap " role="grid"
                                    aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>Cargo</th>
                                            <th>Salário</th>
                                            <th>Periculosidade</th>
                                            <th>Transporte</th>
                                            <th>Refeição</th>
                                            <th>Cesta</th>
                                            <th>Inss</th>
                                            <th>Desc. VT</th>
                                            <th>Desc. VR</th>
                                            <th>Desc. Cesta</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12" id="colForm">
        <div class="card">
            <div class="card-header">
                <h5>Cargos</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Cargos"
                        href="javascript:showHideForm(0)"><i class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div id="debugArea"></div>
            <div class="card-body">
                <table id="table_form">
                    <thead>
                        <tr>
                            <th>Habilitar</th>
                            <th>Desc</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>