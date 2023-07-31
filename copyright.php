<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Copyright Information - Sense</title>
    <link href="/CSS/style.css" rel="stylesheet">
</head>
<body>

<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to add a copyright to your database.';
        echo '</div>';       
        exit;
    }
    ?>
    <div class="container">
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add Copyright Information</h1>
        <form action="PHP/insert_copyright.php" id="copyrightForm" method="post" >
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="rights_holder">Rights Holder:</label>
                <input type="text" id="rights_holder" name="rights_holder" required>
            </div>
            <div class="form-group">
                <label for="id_artist">Select Artist:</label>
                <select id="id_artist" name="id_artist" required>
                </select>
            </div>
            <div class="form-group">
                <label for="artist_tracks">Artist's Tracks:</label>
                <select id="artist_tracks" name="artist_tracks" disabled>
                </select>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Add" onclick="addCopyright()">
            </div>
        </form>
    </div>
    <div class="message-container" id="messageContainer">
        <div class="message-box" id="messageBox">
            <p id="messageContent"></p>
            <button onclick="closeMessageBox()">OK</button>
        </div>
    </div>
    <script src="JS/copyright.js"></script>
</body>
</html>
