<?php
require('config.php');

session_start();
$connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Query to select labels belonging to the connected user from the 'label' table
$sql = "SELECT id, name FROM label WHERE id_users = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $connected_user_id);
$stmt->execute();

$result = $stmt->get_result();
$labels = array();
while ($row = $result->fetch_assoc()) {
    $labels[] = $row;
}

$stmt->close();
$conn->close();

// Output the label data as JSON
header('Content-Type: application/json');
echo json_encode($labels);
?>
