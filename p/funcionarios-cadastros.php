<div class="row">
   <div class="col-sm-12" id="divCadastro">
      <div class="card">
         <div class="card-header" id="headCardCadastro">
            <h5>Cadastro de Funcionário</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                  title="Esconder Formulário de Cadastro" href="javascript:showHideCadastro(0)"><i
                     class="feather icon-eye-off"></i></a>
            </div>
         </div>
         <div class="card-body">
            <form id="formFuncionario">
               <input type="hidden" id="idFuncionarioCadastro" value="0">
               <fieldset class="fieldSet text-success border-success" id="fieldset-edit">
                  <legend class="text-success"><i class="fas fa-cogs"></i> Dados do sistema:</legend>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Mostrar todos os campos</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><a href="javascript:hideAllFieldSet(1);"><i
                                          class="fas fa-caret-down"></i></a></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Mostrar" id="mostrar"
                                 disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Esconder todos os campos</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><a href="javascript:hideAllFieldSet(0);"><i
                                          class="fas fa-caret-up"></i></a></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Esconder" id="esconder"
                                 disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Apelido</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="feather icon-users"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Apelido" id="apelido">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Demissão</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Demissão"
                                 id="dataDemissao">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-info border-info" id="fieldset-admissionais">
                  <legend class="text-info"><i class="fas fa-user-edit"></i> Dados Admissionais:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'admissionais')"><i
                           class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Cargo</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-user-cog"></i></span>
                              </div>
                              <select class="form-control text-info" id="idCargo">
                                 <option value="0">Selecione</option>
                                 <?php
                                    $C = new Cargos();
                                    $cargos = $C->getAll();
                                    foreach ($cargos['data'] as $key => $value) {
                                       echo "<option value=\"".$value['id']."\">".$value['cargo']."</option>";
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Exame Médico</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fas fa-medkit"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Exame" id="dataExame">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Admissão</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Admissão"
                                 id="dataAdmissao">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data do Registro</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data do Registro"
                                 id="dataContrata">
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="border-info">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Pagamento</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-dollar-sign"></i></span>
                              </div>
                              <select class="form-control text-info" id="tipoPagto">
                                 <option value="0">Pagamento</option>
                                 <option value="Horista">Horista</option>
                                 <option value="Mensalista">Mensalista</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Horas Semanais</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-clock"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Horas Semanais"
                                 id="horasSemanais">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Horas Mensais</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-clock"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Horas Mensais"
                                 id="horasMensais">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-warning border-warning" id="fieldset-pessoais">
                  <legend class="text-warning"><i class="fas fa-user-circle"></i> Pessoais:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                        title="Esconder Dados Pessoais" href="javascript:showHidefieldSet(0,'pessoais')"><i
                           class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Nome Completo</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Nome Completo"
                                 id="nome">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Celular</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-mobile-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Celular" id="celular">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Empresa</label>
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-building"></i></span>
                              </div>
                              <select class="form-control text-warning" id="idEmpresa">
                                 <option value="0">Selecione a Empresa</option>
                                 <?php
                                    $E = new Empresas();
                                    $empresas = $E->getAllSelect();
                                    foreach ($empresas['data'] as $key => $value) {
                                       echo "<option value=\"".$value['id']."\">".$value['razao']."</option>";
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="border-warning">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Nascimento</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Data Nascimento"
                                 id="dataNascimento">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Sexo</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-venus-mars"></i></span>
                              </div>
                              <select class="form-control text-warning" id="genero">
                                 <option value="0">Sexo</option>
                                 <option value="M">Masculino</option>
                                 <option value="F">Feminino</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Natural</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-flag"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Natural" id="natural">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Nacionalidade</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-flag"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Nacionalidade"
                                 id="nacionalidade">
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="border-warning">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group fill">
                           <label>Escolaridade</label>
                           <div class="input-group mb-6">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-school"></i></span>
                              </div>
                              <select class="form-control text-warning" id="idEscolaridade">
                                 <option value="0">Escolaridade</option>
                                 <?php
                                 $ES = new Escolaridade();
                                 $escolaridade = $ES->getAll();
                                 foreach ($escolaridade['data'] as $key => $value) {
                                    echo "<option value=\"".$value['id']."\">".$value['escolaridade']."</option>";
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group fill">
                           <label>Estado Civil</label>
                           <div class="input-group mb-6">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-user-friends"></i></span>
                              </div>
                              <select class="form-control text-warning" id="idEstadoCivil">
                                 <option value="0">Estado Civil</option>
                                 <?php
                                 $EC = new EstadoCivil();
                                 $estadoCivil = $EC->getAll();
                                 foreach ($estadoCivil['data'] as $key => $value) {
                                    echo "<option value=\"".$value['id']."\">".$value['estado']."</option>";
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-success border-success" id="fieldset-endereco">
                  <legend class="text-success"><i class="fas fa-map-marker-alt"></i> Endereço:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'endereco')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-2">
                        <div class="form-group fill" id="group-cep">
                           <label>CEP</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i
                                       class="fas fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="CEP" id="cep">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group fill">
                           <label>Endereço</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-building"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Endereço" id="rua">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Número</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Número" id="numero">
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="border-success">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Complemento</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i
                                       class="fas fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Complemento"
                                 id="complemento">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Bairro</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i
                                       class="fas fa-map-marker-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Bairro" id="bairro">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Cidade</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-building"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Cidade" id="cidade">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>UF</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="UF" id="uf">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet border-info text-info" id="fieldset-rg">
                  <legend class="text-info"><i class="fas fa-id-card"></i> RG:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'rg')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group fill">
                           <label>Mãe</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-female"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Nome da Mãe" id="mae">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group fill">
                           <label>Pai</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-male"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Nome do Pai" id="pai">
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="border-info">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>RG</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-fingerprint"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="RG" id="rg">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Cadastro</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Cadastro RG"
                                 id="dataCadastroRG">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Orgão Expeditor</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-building"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Orgão Expeditor RG"
                                 id="orgaoExpeditor">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>UF</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-map-signs"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="UF RG" id="ufRG">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-habilitacao">
                  <legend class="text-purple-a"><i class="fas fa-car-side"></i> Habilitação:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'habilitacao')"><i
                           class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Habilitação</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-purple-a" placeholder="Habilitação"
                                 id="habilitacao">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Categoria</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-id-card"></i></span>
                              </div>
                              <select class="form-control text-purple-a" id="idCategoriaCnh">
                                 <option value="0">Categoria</option>
                                 <?php
                                 $CN = new CategoriasCnh();
                                 $categoriasCnh = $CN->getAll();
                                 foreach ($categoriasCnh['data'] as $key => $value) {
                                    echo "<option value=\"".$value['id']."\">".$value['categoria']."</option>";
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Data Vencimento</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-purple-a" placeholder="Data Vencimento"
                                 id="dataVencimentoHabilitacao">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-militar border-militar" id="fieldset-militar">
                  <legend class="text-militar"><i class="fas fa-id-card-alt"></i> Dispensa Militar:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'militar')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Documento Militar</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-militar"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-militar" placeholder="Doc. Militar"
                                 id="docMilitar">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Nº Doc. Militar</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-militar"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-militar" placeholder="Nº Doc. Militar"
                                 id="docNumMilitar">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Cat. Doc. Militar</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-militar"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-militar" placeholder="Cat. Doc. Militar"
                                 id="catDocMilitar">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-info border-info" id="fieldset-ctps">
                  <legend class="text-info"><i class="fas fa-id-card-alt"></i> CTPS:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'ctps')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>CTPS</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-militar" placeholder="CTPS" id="ctps">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Expedição</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Expedição"
                                 id="dataExpedicaoCtps">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>PIS</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="PIS" id="pis">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Cadastro</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-info"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-info" placeholder="Data Cadastro"
                                 id="dataCadastroPis">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-success border-success" id="fieldset-eleitor">
                  <legend class="text-success"><i class="fas fa-id-card-alt"></i> Titulor de Eleitor e CPF:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'eleitor')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Título Eleitor</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="titulo" id="titulo">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Zona</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Zona" id="zona">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Seção</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="Seção" id="secao">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>CPF:</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-success"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-success" placeholder="CPF" id="cpf">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-warning border-warning" id="fieldset-fgts">
                  <legend class="text-warning"><i class="fas fa-id-card-alt"></i> FGTS:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'fgts')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>É optante</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-id-card"></i></span>
                              </div>
                              <select class="form-control text-warning" id="optante">
                                 <option value="0">É optante</option>
                                 <option value="Sim">Sim</option>
                                 <option value="Não">Não</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Opção</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Data Opção"
                                 id="dataOpcao">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Data Retratação</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Data Retratação"
                                 id="dataRetratacao">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group fill">
                           <label>Banco Depositário:</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-warning"><i class="fas fa-piggy-bank"></i></span>
                              </div>
                              <input type="text" class="form-control text-warning" placeholder="Banco depositário"
                                 id="bcoDepositario">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-rne">
                  <legend class="text-purple-a"><i class="fas fa-plane"></i> Dados Estrangeiros:</legend>
                  <div class="fieldSet-right">
                     <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Dados"
                        href="javascript:showHidefieldSet(0,'rne')"><i class="feather icon-chevron-down"></i></a>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>RNE</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-purple-a" placeholder="RNE" id="rne">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Tipo de Visto</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-id-card"></i></span>
                              </div>
                              <input type="text" class="form-control text-purple-a" placeholder="Tipo de Visto"
                                 id="visto">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group fill">
                           <label>Data Vencimento</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-purple-a"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control text-purple-a" placeholder="Data Vencimento"
                                 id="dataVencimentoVisto">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
               <div class="row">
                  <div class="col-sm-12">
                     <button type="button" class="btn btn-info btn-block btnAdd">Salvar</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-sm-12" id="divChilds">
      <div class="card">
         <div class="card-header" id="headCardChilds">
            <h5>Beneficiários</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                  title="Esconder Cadastro de Filhos" href="javascript:showHideChilds(0)"><i
                     class="feather icon-eye-off"></i></a>
            </div>
         </div>
         <div class="card-body">
            <fieldset class="fieldSet text-info border-info" id="fieldset-edit-beneficiarios-cadastrados">
               <legend class="text-info"><i class="fas fa-child"></i> Beneficiários Cadastrados:</legend>
               <div class="fieldSet-right">
                  <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Mostrar Dados"
                     href="javascript:showHidefieldSet(0,'edit-beneficiarios-cadastrados')"><i
                        class="feather icon-chevron-down"></i></a>
               </div>
               <form id="edit-childs">
                  <input type="hidden" id="idEditFuncionarioChilds">
                  <div id="beneficiarios-edit"></div>
               </form>
            </fieldset>
            <fieldset class="fieldSet text-success border-success" id="fieldset-form-beneficiarios">
               <legend class="text-success"><i class="fas fa-child"></i> Cadastrar Beneficiários:</legend>
               <div class="fieldSet-right">
                  <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Mostrar Dados"
                     href="javascript:showHidefieldSet(0,'form-beneficiarios')"><i
                        class="feather icon-chevron-down"></i></a>
               </div>
               <form id="formChilds">
                  <input type="hidden" id="idFuncionarioChilds">
                  <div id="beneficiarios">
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>Nome</label>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i class="fas fa-child"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-success" placeholder="Nome do Beneficiário"
                                    name="nomeBen">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>CPF</label>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i class="fas fa-id-card"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-success cpfBen" placeholder="CPF"
                                    name="cpfBen">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>RG</label>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i
                                          class="fas fa-fingerprint"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-success" placeholder="RG" name="rgBen">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>Grau de Parentesco</label>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i class="fas fa-child"></i></span>
                                 </div>
                                 <select class="form-control text-success" name="grau">
                                    <option value="0">Grau de Parentesco</option>
                                    <option value="Filho(a) válido" selected>Filho(a) válido</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>Data de nascimento</label>
                              <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i
                                          class="fas fa-birthday-cake"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-success nascBen" placeholder="Nascimento"
                                    name="dtNasc">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2">
                           <div class="form-group fill">
                              <label>Adicionar</label>
                              <div class="input-group mb-2 btnAddFormChild">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text text-success"><i class="fas fa-user-plus"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-success" placeholder="Adicionar" disabled>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <button type="button" class="btn btn-info btn-block btnAddChild">Salvar</button>
                     </div>
                  </div>
               </form>
            </fieldset>
         </div>
      </div>
   </div>
   <div class="col-sm-12" id="divUploadFiles">
      <div class="card">
         <div class="card-header" id="headCardUpload">
            <h5>Envio de Documentos Pendentes</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                  title="Esconder Gestão de Arquivos" href="javascript:showHideUploadFiles(0)"><i
                     class="feather icon-eye-off"></i></a>
            </div>
         </div>
         <div class="card-body">
            <div class="accordion" id="accordionExample">
               <div class="card mb-0" id="cardHaveCPF">
                  <div class="card-header" id="heading-0">
                     <h5 class="mb-0"><a href="#!" id="linkCPF" target="_blank" class="text-success"><i
                              class="fas fa-check-circle"></i> <i class="feather icon-file"></i> Cópia do CPF</a></h5>
                     <div class="card-header-right">
                        <a class="iconRightCard" href="#" data-toggle="collapse" data-target="#collapse-0"
                           aria-expanded="false" aria-controls="collapse-0"><i class="fas fa-sync"></i></a>
                     </div>
                  </div>
                  <div id="collapse-0" class="collapse" aria-labelledby="heading-0" data-parent="#accordionExample">
                     <div class="card-body">
                        <div class="row">
                           <div class="col colImage" id="showCPF">
                              <canvas id="canvas-cpf"></canvas>
                              <img height="227" style="display: none;">
                           </div>
                           <div class="col">
                              <form method="post">
                                 <div id="haveCPF">
                                    <p>Your browser doesn\'t have Flash, Silverlight or HTML5 support.</p>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardCPF">
                  <div class="card-header" id="heading-1">
                     <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapse-1"
                           aria-expanded="false" aria-controls="collapse-1"><i class="feather icon-file"></i> Cópia do
                           CPF</a></h5>
                  </div>
                  <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordionExample">
                     <div class="card-body">
                        <form method="post">
                           <div id="CPF">
                              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardHaveRG">
                  <div class="card-header" id="heading-2">
                     <h5 class="mb-0"><a href="#!" id="linkRG" target="_blank" class="text-success"><i
                              class="fas fa-check-circle"></i> <i class="fas fa-address-card"></i> Cópia do RG</a></h5>
                     <div class="card-header-right">
                        <a class="iconRightCard" href="#" data-toggle="collapse" data-target="#collapse-2"
                           aria-expanded="false" aria-controls="collapse-2"><i class="fas fa-sync"></i></a>
                     </div>
                  </div>
                  <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordionExample">
                     <div class="card-body">
                        <div class="row">
                           <div class="col colImage" id="showRG">
                              <canvas id="canvas-rg"></canvas>
                              <img height="227" style="display: none;">
                           </div>
                           <div class="col">
                              <form method="post">
                                 <div id="haveRG">
                                    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardRG">
                  <div class="card-header" id="heading-3">
                     <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapse-3"
                           aria-expanded="false" aria-controls="collapse-3"><i class="fas fa-address-card"></i> Cópia do
                           RG</a></h5>
                  </div>
                  <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordionExample">
                     <div class="card-body">
                        <form method="post">
                           <div id="RG">
                              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardHaveFoto">
                  <div class="card-header" id="heading-4">
                     <h5 class="mb-0"><a href="#!" id="linkFoto" target="_blank" class="text-success"><i
                              class="fas fa-check-circle"></i> <i class="fas fa-address-card"></i> Foto Foto</a></h5>
                     <div class="card-header-right">
                        <a class="iconRightCard" href="#" data-toggle="collapse" data-target="#collapse-4"
                           aria-expanded="false" aria-controls="collapse-4"><i class="fas fa-sync"></i></a>
                     </div>
                  </div>
                  <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordionExample">
                     <div class="card-body">
                        <div class="row">
                           <div class="col colImage" id="showFoto">
                              <canvas id="canvas-foto"></canvas>
                              <img height="227" style="display: none;">
                           </div>
                           <div class="col">
                              <form method="post">
                                 <div id="haveFoto">
                                    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardFoto">
                  <div class="card-header" id="heading-5">
                     <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapse-5"
                           aria-expanded="false" aria-controls="collapse-5"><i class="fas fa-address-card"></i> Foto
                           3x4</a></h5>
                  </div>
                  <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordionExample">
                     <div class="card-body">
                        <form method="post">
                           <div id="foto">
                              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardHavetitulo">
                  <div class="card-header" id="heading-6">
                     <h5 class="mb-0"><a href="#!" id="linkTitulo" target="_blank" class="text-success"><i
                              class="fas fa-check-circle"></i> <i class="fas fa-address-card"></i> Cópia Titulo
                           Eleitor</a></h5>
                     <div class="card-header-right">
                        <a class="iconRightCard" href="#" data-toggle="collapse" data-target="#collapse-6"
                           aria-expanded="false" aria-controls="collapse-6"><i class="fas fa-sync"></i></a>
                     </div>
                  </div>
                  <div id="collapse-6" class="collapse" aria-labelledby="heading-6" data-parent="#accordionExample">
                     <div class="card-body">
                        <div class="row">
                           <div class="col colImage" id="showTitulo">
                              <canvas id="canvas-titulo"></canvas>
                              <img height="227" style="display: none;">
                           </div>
                           <div class="col">
                              <form method="post">
                                 <div id="haveTitulo">
                                    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card mb-0" id="cardtitulo">
                  <div class="card-header" id="heading-7">
                     <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapse-7"
                           aria-expanded="false" aria-controls="collapse-7"><i class="fas fa-address-card"></i> Cópia
                           Titulo Eleitor</a></h5>
                  </div>
                  <div id="collapse-7" class="collapse" aria-labelledby="heading-7" data-parent="#accordionExample">
                     <div class="card-body">
                        <form method="post">
                           <div id="upTitulo">
                              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!--
                  <div class="card mb-0" id="card-four">
                     <div class="card-header" id="headingFour">
                        <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fas fa-address-card"></i> Foto Foto</a></h5>
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
                  </div> -->
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
   <div class="col-sm-12" id="divUploadPictureProfile">
      <div class="card">
         <div class="card-header" id="headCardUpload">
            <h5>Imagem de Perfil Avatar do funcionário</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                  title="Esconder Gestão de Arquivos" href="javascript:openFormPictureProfile(0)"><i
                     class="feather icon-eye-off"></i></a>
            </div>
         </div>
         <div class="card-body">
            <div class="accordion" id="accordionAvatar">
               <div class="card mb-0" id="cardAvatar">
                  <div class="card-header" id="photo-1">
                     <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapsePhoto-1"
                           aria-expanded="false" aria-controls="collapse-1"><i class="feather icon-image"></i>
                           Avatar</a></h5>
                  </div>
                  <div id="collapsePhoto-1" class="collapse show" aria-labelledby="photo-1" data-parent="#accordionAvatar">
                     <div class="card-body">
                        <div class="user-profile user-card mb-4">
                           <div class="card-body py-0">
                              <div class="user-about-block m-0">
                                 <div class="row">
                                    <div class="col-md-4 text-center mt-n5">
                                       <div class="change-profile text-center">
                                          <div class="dropdown w-auto d-inline-block">
                                             <a>
                                                <div class="profile-dp">
                                                   <div class="position-relative d-inline-block">
                                                      <?php
                                                      $F = new Funcionarios();
                                                      $F->id = $idUser;
                                                      $d = $F->getById();
                                                      $color = ($d['data']['color'])?'style="border: '.$d['data']['color'].' solid 3px"':'';
                                                      ?>
                                                      <img class="img-radius img-fluid wid-100 imgProfile"
                                                         id="uploaded_image" src="<?php echo $avatar;?>"
                                                         alt="<?php echo $loginNome;?>" <?php echo $color;?>>
                                                   </div>
                                                   <label for="upload_image">
                                                      <div class="overlay">
                                                         <span>Mudar</span>
                                                      </div>
                                                   </label>
                                                </div>
                                                <input type="file" name="image" class="image" id="upload_image"
                                                   style="display:none" />
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-8">
                                       <ul class="list-inline" id="listImages"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-12" id="divTurno">
      <div class="card">
         <div class="card-header" id="headCardTurno">
            <h5>Turno de Trabalho</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom"
                  title="Esconder Gestão de Arquivos" href="javascript:showHideTurno(0)"><i
                     class="feather icon-eye-off"></i></a>
            </div>
         </div>
         <div class="card-body">
            <form id="formTurno">
               <input type="hidden" id="idFuncionarioTurnos">
               <table class="tableHours">
                  <thead>
                     <th>Dias da Semana</th>
                     <th colspan="3">Horário de Trabalho</th>
                     <th colspan="3">Intervalo para Repouso e Alimentação</th>
                  </thead>
                  <tbody>
                     <?php
                               function selectHour($select,$class=""){
                                  $hours = Util::listHours();
                                  $selectHours = '<select class="'.$class.'" name="'.$class.'">';
                                  foreach ($hours as $key => $value) {
                                     if($value == $select){
                                        $selected = "selected";
                                     } else {
                                        $selected = "";
                                     }
                                     $selectHours .= "<option value=\"".$value."\" $selected>$value</option>";
                                  }
                                  return $selectHours .="</select>";
                               
                               }
                               $i = 0;
                               foreach (Util::diasDaSemana() as $key => $value) {
                                  echo "<tr><td class='dds'>".$value."</td><td class='init'>".selectHour('08:00','d-'.$i.'-0')."</td><td class='as'>as</td><td>".selectHour('17:00','d-'.$i.'-1')."</td><td class='init'>".selectHour('12:00','d-'.$i.'-2')."</td><td class='as'>as</td><td>".selectHour('13:00','d-'.$i.'-3')."</td></tr>";
                                  $i++;
                               }
                            ?>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="20">
                           <button type="button" class="btn btn-info btn-block btnAddTurno">Salvar</button>
                        </td>
                     </tr>
                  </tfoot>
               </table>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-12" id="colCargos">
      <div class="card">
         <div class="card-header">
            <h5>Cargos</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Cargo"
                  href="javascript:showAddCargo()"><i class="feather icon-plus-circle"></i></a>
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Esconder Cargos"
                  href="javascript:showHidecargos(0)"><i class="feather icon-eye-off"></i></a>
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
                        <table id="table_cargos" class="table table-striped table-bordered nowrap dataTable" role="grid"
                           aria-describedby="dom-table_info">
                           <thead>
                              <tr role="row">
                                 <th class="sorting" aria-label="id">ID</th>
                                 <th class="sorting" aria-label="cargo">Cargo</th>
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
   <div class="col-md-12" id="colFuncionarios">
      <div class="card">
         <div class="card-header">
            <h5>Funcionários</h5>
            <div class="card-header-right">
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Adicionar Funcionário"
                  href="javascript:showHideCadastro(1)"><i class="feather icon-user-plus"></i></a>
               <a class="iconRightCard" data-toggle="tooltip" data-placement="bottom" title="Cargos"
                  href="javascript:showHidecargos(1)"><i class="fas fa-user-cog"></i></a>
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
                                 class="custom-select custom-select-sm form-control form-control-sm" id="registros">
                                 <option value="10">10</option>
                                 <option value="25">25</option>
                                 <option value="50">50</option>
                                 <option value="100" selected>100</option>
                              </select>
                           </label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6">
                        <div class="input-group" id="adv-search">
                           <input type="text" class="form-control form-control-sm" placeholder="Procurar" id="search" />
                           <div class="btn-group" role="group">
                              <div class="dropdown dropdown-lg">
                                 <button type="button" class="btn btn-default-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" id="btnFilter"><i class="feather icon-filter"></i></button>
                                 <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <form class="form-horizontal" role="form">
                                       <div class="form-group">
                                          <label for="filter">Filtrar por </label>
                                          <select class="form-control" id="filterCargo">
                                             <option value="0">Mostrar todos</option>
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
                                          <label for="contain">Mostrar Cadastros sem Data de Admissão</label>
                                          <select class="form-control" id="filterDataAdmissao">
                                             <option value="0">Não</option>
                                             <option value="1">Sim</option>
                                          </select>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <button type="button" class="btn btn-primary btn-sm btnSearch"><i class="feather icon-search" aria-hidden="true"></i></button>
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
                                 <th class="sorting" aria-label="id">ID</th>
                                 <th class="sorting" aria-label="nome">Nome</th>
                                 <th class="sorting" aria-label="fantasia">Empresa</th>
                                 <th class="sorting" aria-label="cargo">Cargo</th>
                                 <th class="sorting" aria-label="celular">Celular</th>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Crop Image Before Upload</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="img-container">
               <div class="row">
                  <div class="col-md-8">
                     <img src="" id="sample_image" />
                  </div>
                  <div class="col-md-4">
                     <div class="preview"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" id="crop" class="btn btn-primary">Crop</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>