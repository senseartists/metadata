<?php
require('config.php');

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $artist_name = isset($_POST["artist_name"]) ? $_POST["artist_name"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $surname = isset($_POST["surname"]) ? $_POST["surname"] : "";
    $date_of_birth = isset($_POST["date_of_birth"]) ? $_POST["date_of_birth"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $nationality = isset($_POST["nationality"]) ? $_POST["nationality"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $social_security_number = isset($_POST["social_security_number"]) ? $_POST["social_security_number"] : "";
    $tax_domicile = isset($_POST["tax_domicile"]) ? $_POST["tax_domicile"] : "";
    $musical_genre = isset($_POST["musical_genre"]) ? $_POST["musical_genre"] : "";
    $ipi = isset($_POST["ipi"]) ? $_POST["ipi"] : "";
    $coad = isset($_POST["coad"]) ? $_POST["coad"] : "";

    session_start();
    $connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Préparer la requête d'insertion
    $sql = "INSERT INTO `artist` (`artist_name`, `name`, `surname`, `date_of_birth`, `gender`, `nationality`, `address`, `telephone`, `email`, `social_security_number`, `tax_domicile`, `musical_genre`, `ipi`, `coad`, `id_users`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("sssssssssiisii", $artist_name, $name,$surname, $date_of_birth, $gender, $nationality, $address, $telephone, $email, $social_security_number, $tax_domicile, $musical_genre, $ipi, $coad, $connected_user_id);

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Artiste ajouté avec succès.");
    } else {
        $response = array("success" => false, "message" => "Erreur lors de l'ajout de l'artiste : " . $conn->error);
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
