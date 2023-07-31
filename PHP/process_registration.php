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
            $errorMessage = "The username already exists. Please choose another one.";
            echo "<script>alert('" . addslashes($errorMessage) . "'); window.location.href = '/registration.html';</script>";
        } else {
            // Préparer la requête d'insertion pour enregistrer l'utilisateur dans la base de données
            $sql = "INSERT INTO users (username, email, password, gender, date_of_birth,id_role) VALUES (?, ?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);

            // Vérifier si la préparation de la requête a réussi
            if (!$stmt) {
                $errorMessage = "Error preparing the query: " . $conn->error;
            } else {
                // Binder les paramètres à la requête
                $stmt->bind_param("sssssi", $username, $email, $hashed_password, $gender, $date_of_birth,$id_role);

                // Exécuter la requête
                if ($stmt->execute()) {
                    // L'utilisateur a été enregistré avec succès
                    $message = "Registration successful! ";
                    echo "<script>alert('" . addslashes($message) . "'); window.location.href = '/connexion.html';</script>";
                    exit; // Assurez-vous de terminer le script après la redirection
                } else {
                    // Une erreur s'est produite lors de l'inscription de l'utilisateur
                    $errorMessage = "An error occurred during registration. Please try again.";
                    echo "<script>alert('" . addslashes($errorMessage) . "'); window.location.href = '/registration.html';</script>";
                }
            }
        }
    }
}
?>
