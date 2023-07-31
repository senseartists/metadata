<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données soumises
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $id_role = 2;

    // Vérifier si le mot de passe correspond à la confirmation du mot de passe
    if ($password !== $confirm_password) {
        $errorMessage = "Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
    } else {
        // Hasher le mot de passe (pour des raisons de sécurité, il est préférable de stocker le mot de passe hashé)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Connexion à la base de données
        require('config.php');

        // Vérifier si le nom d'utilisateur existe déjà dans la base de données
        $sql_check_username = "SELECT username FROM users WHERE username = ?";
        $stmt_check_username = $conn->prepare($sql_check_username);
        $stmt_check_username->bind_param("s", $username);
        $stmt_check_username->execute();
        $result_username = $stmt_check_username->get_result();

        if ($result_username->num_rows > 0) {
            // Le nom d'utilisateur existe déjà dans la base de données
            $errorMessage = "Le nom d'utilisateur existe déjà. Veuillez en choisir un autre.";
        } else {
            // Préparer la requête d'insertion pour enregistrer l'utilisateur dans la base de données
            $sql = "INSERT INTO users (username, email, password, gender, date_of_birth,id_role) VALUES (?, ?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);

            // Vérifier si la préparation de la requête a réussi
            if (!$stmt) {
                $errorMessage = "Erreur de préparation de la requête : " . $conn->error;
            } else {
                // Binder les paramètres à la requête
                $stmt->bind_param("sssss", $username, $email, $hashed_password, $gender, $date_of_birth,$id_role);

                // Exécuter la requête
                if ($stmt->execute()) {
                    // L'utilisateur a été enregistré avec succès
                    header("Location: /connexion.html");
                    exit; // Assurez-vous de terminer le script après la redirection
                } else {
                    // Une erreur s'est produite lors de l'inscription de l'utilisateur
                    $errorMessage = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .form-group input[type="submit"] {
            background-color: #E5ABCE;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

         input[type="submit"]:hover {
            background-color: #ff6b9b;
        }

        .button {
            background: none;
            border: none;
            color: #E5ABCE;
            cursor: pointer;
            text-decoration: underline;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="registration.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <br>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
                <a class="button" href="connexion.html">Back</a>
            </div>
        </form>
    </div>

    <script src="/JS/registration.js"></script>

    <?php
    // Afficher l'erreur s'il y a lieu
    if (isset($errorMessage)) {
        echo '<script>showErrorPopup("' . addslashes($errorMessage) . '");</script>';
    }
    ?>
</body>
</html>
              