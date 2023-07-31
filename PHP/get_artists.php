<?php
require('config.php');

session_start();
$connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Query to select artists belonging to the connected user from the 'artist' table
$sql = "SELECT id, artist_name AS name FROM artist WHERE id_users = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $connected_user_id);
$stmt->execute();

$result = $stmt->get_result();
$artists = array();
while ($row = $result->fetch_assoc()) {
    $artists[] = $row;
}

$stmt->close();
$conn->close();

// Output the artist data as JSON
header('Content-Type: application/json');
echo json_encode($artists);
?>
