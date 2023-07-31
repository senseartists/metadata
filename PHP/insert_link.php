<?php
 // Connexion à la base de données
 require('config.php');

 // Vérifier si l'utilisateur est connecté et récupérer son ID
 session_start();
 if (isset($_SESSION['user_id'])) {
     $user_id = $_SESSION['user_id'];
 }

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $artist_id = $_POST["artist_id"];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $spotify = $_POST['spotify'];
    $tiktok = $_POST['tiktok'];
    $other = $_POST['other'];


    // Prepare the SQL query to insert data into the 'link' table
    $sql = "INSERT INTO `link` (`instagram`, `facebook`, `twitter`, `spotify`, `tiktok`,`other`, `id_users`, `id_artist`)
            VALUES ('$instagram', '$facebook', '$twitter', '$spotify', '$tiktok', '$other', $user_id, $artist_id)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully, show a pop-up message
        echo "<script>alert('Link added to the database.'); window.location.href = '/link.php';</script>";
    } else {
        // Error in data insertion, show a pop-up message
        echo "<script>alert('Error: Could not add link to the database.'); window.location.href = '/link.php';</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted directly to this page, redirect to the form page
    header("Location: /link.php");
    exit;
}
