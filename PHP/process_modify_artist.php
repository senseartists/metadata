<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

if (!$loggedIn) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require('config.php');

    // Récupérer les données soumises du formulaire
    $artist_id = $_POST["artist_id"];
    $table_choice = $_POST["table_choice"];

    // Vérifier si l'artiste sélectionné appartient bien à l'utilisateur connecté
    $connected_user_id = $_SESSION['user_id'];
    $sql_check_artist = "SELECT id FROM artist WHERE id = ? AND id_users = ?";
    $stmt_check_artist = $conn->prepare($sql_check_artist);

    if (!$stmt_check_artist) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt_check_artist->bind_param("ii", $artist_id, $connected_user_id);
    $stmt_check_artist->execute();
    $result_check_artist = $stmt_check_artist->get_result();

    if ($result_check_artist->num_rows === 0) {
        // L'artiste sélectionné n'appartient pas à l'utilisateur connecté, rediriger vers une page d'erreur ou la page d'accueil
        header("Location: error.php");
        exit;
    }

    // Selon l'élément choisi, vous pouvez effectuer différentes actions de modification dans la base de données
    switch ($table_choice) {
        case "artist":
            // Code pour modifier les informations de l'artiste
            $new_artist_name = $_POST["new_artist_name"];
            $new_genre = $_POST["new_genre"];
            $sql_update_artist = "UPDATE artist SET artist_name = ?, genre = ? WHERE id = ?";
            $stmt_update_artist = $conn->prepare($sql_update_artist);
            $stmt_update_artist->bind_param("ssi", $new_artist_name, $new_genre, $artist_id);
            $stmt_update_artist->execute();
            break;

        case "label":
            // Code pour modifier les informations du label
            $new_label_name = $_POST["new_label_name"];
            $new_country = $_POST["new_country"];
            $sql_update_label = "UPDATE label SET name = ?, country = ? WHERE id = ?";
            $stmt_update_label = $conn->prepare($sql_update_label);
            $stmt_update_label->bind_param("ssi", $new_label_name, $new_country, $artist_id);
            $stmt_update_label->execute();
            break;

        case "track":
            // Code pour modifier les informations de la track
            $new_track_title = $_POST["new_track_title"];
            $new_duration = $_POST["new_duration"];
            $sql_update_track = "UPDATE track SET title = ?, duration = ? WHERE id = ?";
            $stmt_update_track = $conn->prepare($sql_update_track);
            $stmt_update_track->bind_param("ssi", $new_track_title, $new_duration, $artist_id);
            $stmt_update_track->execute();
            break;

        // Ajoutez d'autres cas pour chaque élément que vous souhaitez modifier

        default:
            // Cas par défaut en cas de choix invalide
            header("Location: error.php");
            exit;
    }

    // Fermer la connexion à la base de données
    $conn->close();

    // Rediriger l'utilisateur vers une page de confirmation ou la page d'accueil après la modification
    header("Location: confirmation.php");
    exit;
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page appropriée
    header("Location: modify_artist.php");
    exit;
}
