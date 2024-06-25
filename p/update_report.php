<?php
require_once('../_config1.php');

$connection = connect1();

$month = isset($_POST['month']) ? intval($_POST['month']) : null;

$query = "SELECT * FROM vales";
if ($month !== null) {
    $query .= " WHERE month = {$month}";
}
$result = $connection->query($query);

$html = '';
while ($row = $result->fetch_assoc()) {
    $html .= "<tr>";
    $html .= "<td>{$row['id']}</td>";
    $html .= "<td>{$row['name']}</td>";
    $html .= "<td>{$row['value']}</td>";
    $html .= "</tr>";
}

echo $html;
