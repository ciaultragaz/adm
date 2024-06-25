<div class="row">
  <div class="col-sm-12" id="colMenu">
    <div class="card">
      <div class="card-header">
        <h5>Menu</h5>
        <div class="card-header-right">
          <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Item"
            href="javascript:showHideAddItens(1)"><i class="feather icon-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <div id="treeview3" class=""></div>
        <div id="myTreeview" class="tree"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12" id="colForm">
    <div class="card" id="cardAdd">
      <div class="card-header">
        <h5>Item</h5>
        <div class="card-header-right">
          <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Formulário"
            href="javascript:showHideAddItens(0)"><i class="feather icon-eye-off"></i></a>
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
                <table id="table_itens" class="table table-striped table-bordered nowrap dataTable" role="grid"
                  aria-describedby="dom-table_info">
                  <tbody>
                    <tr id="formAddItem">
                      <input type="hidden" id="idItem">
                      <td colspan="2">
                        <div class="form-group fill">
                          <select class="form-control" id="typeMenu">
                            <option value="0">Selecione o tipo</option>
                            <option value="1">Caption</option>
                            <option value="2">Head</option>
                            <option value="3">Item</option>
                          </select>
                        </div>
                        <div class="form-group fill">
                          <select class="form-control" id="captions">
                            <option value="0">Selecione a Caption</option>
                          </select>
                        </div>
                        <div class="form-group fill">
                          <select class="form-control" id="heads">
                            <option value="0">Selecione a Head</option>
                          </select>
                        </div>
                        <div class="form-group fill">
                          <input type="text" placeholder="Adicione o novo Item" class="form-control focusGlow inputFull"
                            id="textItem">
                        </div>
                        <fieldset class="fieldSet" id="formItem">
                          <legend></legend>
                          <div class="form-group fill">
                            <input type="text" placeholder="Adicione Referencia"
                              class="form-control focusGlow inputFull" id="textHref">
                          </div>
                          <div class="form-group fill">
                            <input type="text" placeholder="Adicione Icone" class="form-control focusGlow inputFull"
                              id="textIcon">
                          </div>
                          <div class="form-group fill">
                            <button type="button" class="btn btn-info btn-block btnAdd">Adicionar</button>
                          </div>
                        </fieldset>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card" id="cardEdit">
      <div class="card-header">
        <h5>Item</h5>
        <div class="card-header-right">
          <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Formulário"
            href="javascript:showHideAddItens(0)"><i class="feather icon-eye-off"></i></a>
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
                <table id="table_itens" class="table table-striped table-bordered nowrap dataTable" role="grid"
                  aria-describedby="dom-table_info">
                  <tbody>
                    <tr id="formEditItem">
                      <td colspan="2">
                        <fieldset class="fieldSet text-info border-info">
                          <legend class="text-info">Tipo:</legend>
                          <div class="form-group fill">
                            <select class="form-control" id="editTypeMenu">
                              <option value="0">Selecione o tipo</option>
                              <option value="1">Caption</option>
                              <option value="2">Head</option>
                              <option value="3">Item</option>
                            </select>
                          </div>
                        </fieldset>
                        <fieldset class="fieldSet text-warning border-warning" id="fieldset-caption">
                          <legend class="text-warning">Caption:</legend>
                          <div class="form-group fill">
                            <select class="form-control" id="editCaptions">
                              <option value="0">Selecione a Caption</option>
                            </select>
                          </div>
                        </fieldset>
                        <fieldset class="fieldSet text-success border-success" id="fieldset-head">
                          <legend class="text-success">Head:</legend>
                          <div class="form-group fill">
                            <select class="form-control" id="editHeads">
                              <option value="0">Selecione a Head</option>
                            </select>
                          </div>
                        </fieldset>
                        <fieldset class="fieldSet text-purple-a border-purple">
                          <legend class="text-purple-a">Label:</legend>
                          <div class="form-group fill">
                            <input type="text" placeholder="Alterar Item"
                              class="form-control focusGlow inputFull" id="editTextItem">
                          </div>
                        </fieldset>
                        <fieldset class="fieldSet" id="editFormItem">
                          <legend></legend>
                          <div class="form-group fill">
                            <input type="text" placeholder="Alterar Referencia"
                              class="form-control focusGlow inputFull" id="editTextHref">
                          </div>
                          <div class="form-group fill">
                            <input type="text" placeholder="Alterar Icone" class="form-control focusGlow inputFull"
                              id="editTextIcon">
                          </div>
                          <div class="form-group fill">
                            <button type="button" class="btn btn-info btn-block btnEdit">Salvar</button>
                          </div>
                        </fieldset>
                      </td>
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
</div>