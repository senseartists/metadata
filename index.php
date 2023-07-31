<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Check if the user has admin privileges (id_role = 1)
$isAdmin = false;
if ($loggedIn) {
    require('PHP/config.php');
    $connected_user_id = $_SESSION['user_id'];
    $sql = "SELECT id_role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $connected_user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $isAdmin = $row['id_role'] == 1;
        }

        $stmt->close();
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil - Gestion d'artistes</title>
    <link href="CSS/index.css" rel="stylesheet">
</head>
<body>
<?php if ($loggedIn) { ?>
    <a href="PHP/logout.php" class="connexion-button">Sign out</a>
<?php } else { ?>
    <a href="connexion.html" class="connexion-button">Sign in</a>
<?php } ?>
<div class="container">
    <div class="logo">
        <img src="images/logo.png" alt="Logo">
    </div>
    <div class="buttons">
        <a href="artist.php" class="button">Add an artist</a>
        <a href="label.php" class="button">Add a label</a>
        <a href="track.php" class="button">Add a track</a>
        <a href="release.php" class="button">Add a release</a>
        <a href="copyright.php" class="button">Add copyright</a>
        <a href="custom_identifiers.php" class="button">Add a custom identifiers</a>
        <a href="link.php" class="button">Add a link</a>
        <a href="file.php" class="button">Add a file/image</a>
        <?php if ($loggedIn && $isAdmin) { ?>
            <a href="marketing.php" class="button2">Marketing</a>
        <?php } ?>
        <a href="view_artists.php" class="button2">View all artists</a>
    </div>
</div>
</body>
</html>
