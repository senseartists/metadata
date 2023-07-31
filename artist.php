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
    <title>Add an Artist - Sense</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to add an artist to your database.';
        echo '</div>';       
        exit;
    }
    ?>
    <div class="container">
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add an Artist</h1>
        <form action="insert_artist.php" method="post">
            <div class="form-group">
                <label for="artist_name">Artist Name:</label>
                <input type="text" id="artist_name" name="artist_name" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="surname">Surame:</label>
                <input type="text" id="surname" name="surname">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <br>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input type="text" id="nationality" name="nationality">
            </div>
            <div class="form-group">
                <label for="Address">Address:</label>
                <textarea id="Address" name="Address"></textarea>
            </div>
            <div class="form-group">
                <label for="Telephone">Telephone:</label>
                <input type="tel" id="Telephone" name="Telephone">
            </div>
            <div class="form-group">
                <label for="E-mail">E-mail:</label>
                <br>
                <input type="email" id="E-mail" name="E-mail">
            </div>
            <div class="form-group">
                <label for="social_security_number">Social Security Number:</label>
                <input type="number" id="social_security_number" name="social_security_number">
            </div>
            <div class="form-group">
                <label for="tax_domicile">Tax Domicile:</label>
                <input type="number" id="tax_domicile" name="tax_domicile">
            </div>
            <div class="form-group">
                <label for="musical_genre">Musical Genre:</label>
                <input type="text" id="musical_genre" name="musical_genre">
            </div>
            <div class="form-group">
                <label for="IPI">IPI Number:</label>
                <input type="number" id="IPI" name="IPI">
            </div>
            <div class="form-group">
                <label for="COAD">COAD Code:</label>
                <input type="text" id="COAD" name="COAD">
            </div>
            <div class="submit-btn">
                <input type="submit" value="Add">
            </div>
        </form>
    </div>
    <div class="message-container" id="messageContainer">
        <div class="message-box" id="messageBox">
            <p id="messageContent"></p>
            <button onclick="closeMessageBox()">OK</button>
        </div>
    </div>

</div>

    <script src="JS/artist.js">

    </script>
</body>
</html>