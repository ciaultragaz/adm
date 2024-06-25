<div class="row">
   <div class="col-sm-12" id="colUploadFiles">
      <div class="card">
         <div class="card-header" id="headingThree">
            <h5>Envio de Documentos Pendentes</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Gestão de Arquivos" href="javascript:showHideUploadFiles(0)"><i class="feather icon-eye-off"></i></a>
            </div>            
         </div>         
         <div class="card-body">
            <div class="accordion" id="accordionExample">
                  <div class="card mb-0">
                     <div class="card-header" id="headingOne">
                        <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="feather icon-file"></i> Cópia do CPF</a></h5>
                     </div>
                     <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                           <form method="post">
                              <div id="uploader">
                                 <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="card mb-0" id="card-two">
                     <div class="card-header" id="headingTwo">
                        <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fas fa-address-card"></i> Cópia do RG</a></h5>
                     </div>
                     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                           <form method="post">
                              <div id="rg">
                                 <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="card mb-0" id="card-four">
                     <div class="card-header" id="headingFour">
                        <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fas fa-address-card"></i> Foto 3x4</a></h5>
                     </div>
                     <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                           <form method="post">
                              <div id="foto">
                                 <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header" id="headingThree">
                        <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="far fa-address-book"></i> Carteira de Trabalho</a></h5>
                     </div>
                     <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                           Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                           eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                           sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                           sustainable VHS.
                        </div>
                     </div>
                  </div>
            </div>            
            <div class="row">
               <div class="col">

               </div>
               <div class="col">

               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12" id="colFuncionarios">
      <div class="card">
         <div class="card-header">
            <h5>Arquivos</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Funcionário" href="#"><i class="feather icon-user-plus"></i></a>
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Cargos" href="javascript:showHidecargos(1)"><i class="fas fa-user-cog"></i></a>
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
                              <select name="dom-table_length" aria-controls="dom-table" class="custom-select custom-select-sm form-control form-control-sm" id="registros">
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
                           <label>Procurar:<input id="search" type="search" class="form-control form-control-sm" placeholder="Procurar" aria-controls="dom-table"></label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table id="table" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="dom-table_info">
                           <thead>
                              <tr role="row">
                                 <th class="sorting" aria-label="id">ID</th>
                                 <th class="sorting" aria-label="nome">Nome</th>
                                 <th class="sorting" aria-label="cargo">Cargo</th>
                                 <th class="sorting" aria-label="celular">Celular</th>
                                 <th class="sorting" aria-label="email">E-mail</th>
                                 <th class="sorting" aria-label="cpf">CPF</th>
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