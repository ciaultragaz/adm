<?php
$pageSis = 'funcionarios-holerites';
$month = isset($_SESSION[$pageSis]['month']) ? $_SESSION[$pageSis]['month'] : date('m');
$year = isset($_SESSION[$pageSis]['year']) ? $_SESSION[$pageSis]['year'] : date('Y');
$a_date = "$year-$month-01";
$lastDay = date("Y-m-t", strtotime($a_date));
?>


<div class="row">
   <div class="col-md-8" id="colHolerite">
         <div class="card">
            <div class="card-header">
                <h5></h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Holerite"
                        href="javascript:hideHolerite()"><i class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body" id="bodyCard"></div>
        </div>
   </div>
   <div class="col-md-4" id="colInfo">
         <div class="card">
            <div class="card-header">
                <h5>Detalhes</h5>
                <div class="card-header-right">
                    <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Cargos"
                        href="javascript:hideHolerite()"><i class="feather icon-eye-off"></i></a>
                </div>
            </div>
            <div class="card-body" id="bodyCardDetalhes">
               <div class="perfil">                  
               <div class="imageProfile"></div>
                  <div class="nome"></div>
                  <div class="cargo"></div>
               </div>
               <div class="detalhes">
                  <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                  <li class="nav-item">
								<a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Adiantamento</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Comissão</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Eventos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="holerite-tab" data-toggle="tab" href="#holerite-actions" role="tab" aria-controls="holerite-actions" aria-selected="false">Holerite</a>
							</li>
						</ul>
                  <div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="tableExtrato" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th>Data</th>                                            
                                            <th>Obs</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<p class="mb-0" id="comissao"></p>
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								<table id="eventos" class="table table-striped table-bordered nowrap dataTable"
                                    role="grid" aria-describedby="dom-table_info">
                                    <thead><td>Data</td><td>Dia da Semana</td><td>Obs</td><td>Tipo</td></thead>
                           <tbody></tbody>
                        </table>
							</div>
							<div class="tab-pane fade" id="holerite-actions" role="tabpanel" aria-labelledby="holerite-tab">
                        <?php
                           $a_date = "$year-$month-01";
                           $lastDay = date("Y-m-t", strtotime($a_date));
                        ?>
                        <input type="hidden" id="idFuncionarioHolerite" value="0">
                        <input type="hidden" id="inputHiddenBonus" value="0">
                        <input type="hidden" id="inputHiddenComissao" value="0">
                        <input type="hidden" id="idHolerite" value="0">
                        <input type="hidden" id="range" value="<?php echo date("d/m/Y",strtotime($a_date))." - ".date("d/m/Y",strtotime($lastDay))?>">
                        <button id="btnView" class="btn btn-warning btn-sm btn-block">Ver Holerite</button>
                        <button id="btnGerar" class="btn btn-secondary btn-sm btn-block">Gerar Holerite</button>
                        <button id="btnHolerite" class="btn btn-success btn-sm btn-block">Holerite Gerado</button>
                        <button id="btnPrintHolerite" data-month="<?php echo $month;?>" data-year="<?php echo $year;?>" class="btn btn-info btn-sm btn-block">Imprimir Holerite</button>
                        <button id="btnPrintVales"type="button" class="btn btn-primary btn-sm btn-block">Imprimir Vales</button>
							</div>
						</div>                  
               </div>
            </div>
        </div>
   </div>
   <div class="col-md-12" id="colFuncionarios">
      <div class="card">
         <div class="card-header">
            <h5>Funcionários</h5>
            <div class="card-header-right">
            <button type="button" class="btn btn-primary btn-sm" id="btnPrintHolerites"><i class="feather mr-2 icon-printer"></i>Imprimir Holerites</button>
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Cargos"
                  href="javascript:showHidecargos(1)"><i class="fas fa-user-cog"></i></a>
            </div>
         </div>
         <div class="card-body">
            <div class="dt-responsive table-responsive">
               <div class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-6 col-md-4">
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
                     <div class="col-sm-6 col-md-1">
                        <div class="dataTables_length">
                           <label>
                              Mês:
                              <select class="custom-select custom-select-sm form-control form-control-sm" id="mes">
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
                     <div class="col-sm-6 col-md-1">
                        <div class="dataTables_length">
                           <label>
                              Ano:
                              <select class="custom-select custom-select-sm form-control form-control-sm" id="ano">
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
                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" id="btnFilter"><i class="feather icon-filter"></i></button>
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
                                       <button type="submit" class="btn btn-primary"><span
                                             class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </form>
                                 </div>
                              </div>
                              <button type="button" class="btn btn-primary btnSearch"><i class="feather icon-search" aria-hidden="true"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table id="table" class="table table-striped table-bordered nowrap dataTable" role="grid"
                           aria-describedby="dom-table_info">
                           <thead>
                              <tr role="row">
                                 <th><input type="checkbox" id="checkUnCheckAll"></th>
                                 <th class="sorting" aria-label="id">ID</th>
                                 <th class="sorting" aria-label="nome">Nome</th>
                                 <th class="sorting" aria-label="horas">Horas</th>
                                 <th class="sorting" aria-label="faltas">Faltas</th>
                                 <th class="sorting" aria-label="bonus">Bonus</th>
                                 <th>Comissão</th>
                                 <th class="sorting" aria-label="adiantamento">Adiantamento</th>
                                 <th class="sorting" aria-label="salario">Salário</th>
                                 <th class="sorting" aria-label="fantasia">Empresa</th>
                                 <th class="sorting" aria-label="cargo">Cargo</th>
                                 <th>Ações</th>
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