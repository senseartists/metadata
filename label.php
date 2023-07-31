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
    <title>Add an Label - SENSE </title>
    <link href="/CSS/style.css" rel="stylesheet">

</head>
<body>

<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to add a label to your database.';
        echo '</div>';       
        exit;
    }
    ?>

    <div class="container">
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add a Label</h1>
        <form id="labelForm" method="post" action="PHP/insert_label.php">
            <div class="form-group">
                <label for="name">Label Name :</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="country">Country :</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Add">
            </div>
        </form>

    <div class="message-container" id="messageContainer">
        <div class="message-box" id="messageBox">
            <p id="messageContent"></p>
            <button onclick="closeMessageBox()">OK</button>
        </div>
    </div>

</div>

<script src="JS/label.js"></script>

</body>
</html>