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
    <title>Add Release </title>
    <link href="/CSS/style.css" rel="stylesheet">

</head>
<body>


<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to add an release to your database.';
        echo '</div>';       
        exit;
    }
    ?>
    <div class="container">
    <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add Release</h1>
        <form action="PHP/insert_release.php" method="post">
            <div class="form-group">
                <label for="name_release">Name of Release:</label>
                <input type="text" id="name_release" name="name_release" required>
            </div>
            <div class="form-group">
                <label for="type_release">Type of Release:</label>
                <input type="text" id="type_release" name="type_release" required>
            </div>
            <div class="form-group">
                <label for="code_upc">Code UPC:</label>
                <input type="text" id="code_upc" name="code_upc" >
            </div>
            <div class="form-group">
                <label for="catalog_number">Catalog Number:</label>
                <input type="text" id="catalog_number" name="catalog_number" >
            </div>
            <div class="form-group">
                <label for="id_label">Label</label>
                <br>
                <select id="id_label" name="id_label" required>
                </select>
            </div>

            <div class="submit-btn">
                <input type="submit" value="Add">
            </div>
        </form>
    </div>

    <script src="JS/release.js"></script>

</body>
</html>