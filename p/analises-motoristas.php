<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Filtros</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="fieldSet text-purple-a border-purple" id="fieldset-habilitacao">
                                <legend class="text-purple-a"><i class="feather icon-user"></i> Motorista:</legend>
                                <div class="form-group fill">
                                    <div class="input-group mb-3">
                                        <select class="js-example-placeholder-multiple col-sm-12" id="motoristas">
                                            <option value="0">Selecione</option>
                                            <!-- PHP loop para preencher os motoristas -->
                                            <?php
                                            $M = new Motoristas();
                                            $motoristas = $M->showAll();
                                            foreach ($motoristas as $motorista) {
                                                echo '<option value="' . $motorista . '">' . $motorista . '</option>';
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
            <div class="card" id="cardCalendar">
                <div class="card-header">
                    <h5>Calendário</h5>
                    <div class="card-header-right">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                </div>
                <div class="card-body" id="cal">
                    <!-- Conteúdo do calendário vai aqui -->
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card" id="cardGraph">
                <div class="card-header">
                    <h5 id="nomeGrafico">Desempenho últimos 7 meses</h5>
                    <span>Desempenho últimos 7 meses</span>
                </div>
                <div class="card-block">
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
            <div class="card user-card2" id="cardTable">
                <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_disabled">Motorista</th>
                            <th class="sorting_disabled">Preço</th>
                            <th class="sorting_disabled">AUTO</th>
                            <th class="sorting_disabled">DISK</th>
                            <th class="sorting_disabled">Total</th>
                            <th class="sorting_disabled">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd">
                            <td rowspan="10">Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <!-- Mais linhas da tabela aqui -->
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>