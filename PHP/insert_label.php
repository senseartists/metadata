<?php
require('config.php');

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $country = $_POST["country"];

    
    session_start();
    $connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Préparer la requête d'insertion
    $sql = "INSERT INTO `label` (`name`, `country`, `id_users`) VALUES (?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $country, $connected_user_id);

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Label ajouté avec succès.");
    } else {
        $response = array("success" => false, "message" => "Erreur lors de l'ajout du label : " . $conn->error);
    }

    // Fermer la statement
    $stmt->close();

    // Fermer la connexion à la base de données
    $conn->close();

    // Renvoyer la réponse au format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
