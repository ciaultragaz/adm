
<?php
require_once('../_config1.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Avançada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <style>
        .filter-section {
            margin: 20px 0;
            padding: 15px;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .filter-title {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 15px;
            color: #333;
        }
        .btn-filter {
            margin-top: 25px;
        }
        .table-container {
            margin-top: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="filter-section">
            <div class="filter-title">Filtros Avançados</div>
            <form id="searchForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Buscar por Nome</label>
                            <input type="text" class="form-control" id="searchName" placeholder="Digite o nome">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cargo</label>
                            <select class="form-control" id="filterCargo">
                                <option value="">Todos</option>
                                <?php
                                    $C = new Cargos();
                                    $cargos = $C->getAll();
                                    foreach($cargos['data'] as $cargo) {
                                        echo "<option value='".$cargo['id']."'>".$cargo['nome']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Departamento</label>
                            <select class="form-control" id="filterDepartamento">
                                <option value="">Todos</option>
                                <option value="RH">RH</option>
                                <option value="Financeiro">Financeiro</option>
                                <option value="TI">TI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block btn-filter" id="applyFilters">
                            <i class="feather icon-search"></i> Aplicar Filtros
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary btn-block btn-filter" id="resetFilters">
                            <i class="feather icon-refresh-ccw"></i> Limpar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table id="resultsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadResults(filters = {}) {
                $.ajax({
                    url: 'getData.php',
                    type: 'GET',
                    data: filters,
                    success: function(response) {
                        const data = JSON.parse(response);
                        const tableBody = $("#resultsTable tbody");
                        tableBody.empty();

                        if (data.length > 0) {
                            data.forEach(item => {
                                tableBody.append(`
                                    <tr>
                                        <td>${item.id}</td>
                                        <td>${item.nome}</td>
                                        <td>${item.cargo}</td>
                                        <td>${item.departamento}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewDetails(${item.id})">
                                                <i class="feather icon-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" onclick="editItem(${item.id})">
                                                <i class="feather icon-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            tableBody.append('<tr><td colspan="5" class="text-center">Nenhum resultado encontrado</td></tr>');
                        }
                    },
                    error: function() {
                        alert('Erro ao carregar os dados');
                    }
                });
            }

            $("#applyFilters").on("click", function() {
                const filters = {
                    nome: $("#searchName").val(),
                    cargo: $("#filterCargo").val(),
                    departamento: $("#filterDepartamento").val()
                };
                loadResults(filters);
            });

            $("#resetFilters").on("click", function() {
                $("#searchForm")[0].reset();
                loadResults();
            });

            // Load initial data
            loadResults();
        });

        function viewDetails(id) {
            // Implement view details logic
            window.location.href = `view-details.php?id=${id}`;
        }

        function editItem(id) {
            // Implement edit logic
            window.location.href = `edit-item.php?id=${id}`;
        }
    </script>
</body>
</html>
