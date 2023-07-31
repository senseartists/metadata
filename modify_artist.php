<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Artist</title>
    <style>
        body {
            background-image: url("images/grad.jpg");
            background-size: cover;
            background-position: center;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 30px;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }
        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #fff;
        }
        .submit-button {
            background-color: #E5ABCE;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #ff6b9b;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            background: none;
            border: none;
            color: #E5ABCE;
            cursor: pointer;
            text-decoration: underline;
            font-size: 14px;
            transition: color 0.3s;
        }
        .button:hover {
            color: #ff6b9b;
        }

        .title-wrapper {
            background-color: #E5ABCE;
            padding: 100px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 30px;
        }
        h1 {
            margin: 0;
        }
        form {
            text-align: center;
        }

             /* centrer texte */
             .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-weight: bold;
        }

        .back-btn {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E5ABCE;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #ec83c2;
        }

    </style>
</head>
<body>
    
<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to modify the information of the artists recorded in your database.';
        echo '</div>';       
        exit;
    }
    ?>
    <div class="container">
        <div class="title-wrapper">
            <h1>Modify Artist</h1>
            <form action="PHP/modify_element.php" method="POST">
                <label for="artist_id">Select an artist:</label>
                <select name="artist_id" id="artist_id">
                    <?php
                    require('PHP/config.php');

                    // Fetch artists belonging to the currently logged-in user
                    $connected_user_id = $_SESSION['user_id'];
                    $sql = "SELECT id, artist_name FROM artist WHERE id_users = ?";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("i", $connected_user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["id"] . '">' . $row["artist_name"] . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No artists found for this user</option>';
                        }

                        $stmt->close();
                    } else {
                        echo '<option value="" disabled>Error fetching artists</option>';
                    }

                    $conn->close();
                    ?>
                </select>
                <br>
                <br>
                <label for="table_choice">Choisissez l'élément à modifier :</label>
    <select name="table_choice" id="table_choice" onchange="redirectToModifyElement()">
        <option value="artist">Informations de l'artiste</option>
        <option value="label">Informations du label</option>
        <option value="track">Informations de la piste</option>
        <option value="release">Informations de la sortie</option>
        <option value="custom_identifiers">Informations des identifiants personnalisés</option>
        <option value="copyright">Informations sur les droits d'auteur</option>
    </select>

                <br>
                <br>
                <input type="submit" value="Modify" class="submit-button">
                <br>
                <a class="button" href="index.php">Back</a>
            </form>
        </div>
    </div>
</body>

<script>
    function redirectToModifyElement() {
        var artistId = document.getElementById("artist_id").value;
        var tableChoice = document.getElementById("table_choice").value;
        var url = "modify_element.php?artist_id=" + encodeURIComponent(artistId) + "&table_choice=" + encodeURIComponent(tableChoice);
        window.location.href = url;
    }
</script>

</html>