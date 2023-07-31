<?php
require('config.php');

session_start();
$connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Query to select releases belonging to the connected user from the 'release' table
$sql = "SELECT id, name_release AS name FROM release WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $connected_user_id);
$stmt->execute();

$result = $stmt->get_result();
$releases = array();
while ($row = $result->fetch_assoc()) {
    $releases[] = $row;
}

$stmt->close();
$conn->close();

// Output the release data as JSON
header('Content-Type: application/json');
echo json_encode($releases);
?>
