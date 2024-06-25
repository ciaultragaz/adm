<?php
switch ($action) {
    case 'getAllByCliente':
        $P = new Pedidos();
        $P->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 20;
        $P->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $P->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $P->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $P->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $P->bairros = (isset($_REQUEST['bairros'])) ? $_REQUEST['bairros'] : '';
        $P->tipos = (isset($_REQUEST['tipos'])) ? $_REQUEST['tipos'] : '';
        $P->ceps = (isset($_REQUEST['ceps'])) ? $_REQUEST['ceps'] : '';
        $P->localizados = (isset($_REQUEST['localizados'])) ? $_REQUEST['localizados'] : '';
        $P->codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : '';
        $d = $P->getAllByClient();
        ?>
        <div class="dt-responsive table-responsive">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tablePedidos" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="dom-table_info">
                            <thead>
                                <tr role="row">
                                    <th>Data</th>
                                    <th>Qtd</th>
                                    <th>Preco</th>
                                    <th>Prod</th>
                                    <th>Motorista</th>
                                    <th>Origem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($d['data'] as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['dataHora'];?></td>
                                            <td><?php echo $value['Qt'];?></td>
                                            <td><?php echo "R$ ".Util::formataMoeda($value['Precounit']);?></td>
                                            <td><?php echo $value['Produto'];?></td>
                                            <td><?php echo $value['Entregador'];?></td>
                                            <td><?php echo $value['AD'];?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="simpletable_info_"></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate_">
                            <ul id="pagination" class="pagination_"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    break;
    case 'getAllPedidos':
        $codigo = (isset($_REQUEST['codigo'])) ? $_REQUEST['codigo'] : '';
        $P = new Pedidos();
        $P->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 20;
        $P->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $P->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $P->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $P->search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : null;
        $P->bairros = (isset($_REQUEST['bairros'])) ? $_REQUEST['bairros'] : '';
        $P->tipos = (isset($_REQUEST['tipos'])) ? $_REQUEST['tipos'] : '';
        $P->ceps = (isset($_REQUEST['ceps'])) ? $_REQUEST['ceps'] : '';
        $P->localizados = (isset($_REQUEST['localizados'])) ? $_REQUEST['localizados'] : '';
        $P->codigo = $codigo;
        $d = $P->getAllByClient();

        $T = new Telefones();
        $T->codigo = $codigo;
        $t = $T->getAll();
        ?>
        <table>
            <tbody>
                <tr>
                    <td valign="top">
                        <table id="tablePedidos">
                            <thead>
                                <tr role="row">
                                    <th>Data</th>
                                    <th>Qtd</th>
                                    <th>Preco</th>
                                    <th>Prod</th>
                                    <th>Motorista</th>
                                    <th>Origem</th>
                                    <th>Obs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                    
                                    foreach ($d['data'] as $key => $value) {
                                        $precos[] = $value['Precounit'];
                                        ?>
                                        <tr>
                                            <td><?php echo $value['dataHora'];?></td>
                                            <td><?php echo $value['Qt'];?></td>
                                            <td><?php echo "R$ ".Util::formataMoeda($value['Precounit']);?></td>
                                            <td><?php echo $value['Produto'];?></td>
                                            <td><?php echo $value['Entregador'];?></td>
                                            <td><?php echo $value['AD'];?></td>
                                            <td><div class="memo"><?php echo $value['Obs'];?></div></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                        <thead>
                                    <th>DDD</th>
                                    <th>Prefixo</th>
                                    <th>Milhar</th>
                                    <th>Úlima Ligação</th>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($t['data'] as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['DDD']?></td>
                                        <td><?php echo $value['Prefixo']?></td>
                                        <td><?php echo $value['Milhar']?></td>
                                        <td><?php echo $value['dataHora']?></td>
                                    </tr>
                                    <?php
                                }
                            ?> 
                            </tbody>                           
                        </table>
                        <div id="seo-chart1"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <script>
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 100,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#4680ff"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#4680ff",
                strokeColor: "#4680ff",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [<?php echo implode(",",array_reverse($precos));?>]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Preços :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-chart1"), options);
        chart.render();
    });        
        </script>
    <?php
    break;
    case 'pages':
        $P = new Pedidos();
        $P->dataSelecionada = (isset($_REQUEST['dataSelecionada'])) ? Util::dateToDb($_REQUEST['dataSelecionada']) : null;
        $P->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 10;
        $P->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 0;
        $P->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $P->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $P->tipos = (isset($_REQUEST['tipos'])) ? $_REQUEST['tipos'] : null;
        $P->motoristas = (isset($_REQUEST['motoristas'])) ? $_REQUEST['motoristas'] : null;
        echo json_encode($P->getPages());
        break;
    case 'searchEnd':
        $C = new Clientes();
        $C->show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : 30;
        $C->page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $C->fieldSort = (isset($_REQUEST['fieldSort'])) ? $_REQUEST['fieldSort'] : null;
        $C->sort = (isset($_REQUEST['sort'])) ? $_REQUEST['sort'] : null;
        $C->end = (isset($_REQUEST['end'])) ? $_REQUEST['end'] : null;
        echo json_encode($C->getByEndereco());
        break;
}
?>