
<?php
require_once('../_config1.php');

$connection = connect();

// Get filter parameters
$nome = $_GET['nome'] ?? '';
$cargo = $_GET['cargo'] ?? '';
$departamento = $_GET['departamento'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;

// Build query with filters
$query = "SELECT * FROM funcionarios WHERE 1=1";
if (!empty($nome)) {
    $query .= " AND nome LIKE '%".mysqli_real_escape_string($connection, $nome)."%'";
}
if (!empty($cargo)) {
    $query .= " AND cargo_id = '".mysqli_real_escape_string($connection, $cargo)."'";
}
if (!empty($departamento)) {
    $query .= " AND departamento = '".mysqli_real_escape_string($connection, $departamento)."'";
}

// Add pagination
$offset = ($page - 1) * $limit;
$query .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($connection, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
