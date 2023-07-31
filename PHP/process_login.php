<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données soumises
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données
    require('config.php');

    // Requête pour récupérer l'utilisateur correspondant au nom d'utilisateur
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Vérifier si la préparation de la requête a réussi
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Binder les paramètres à la requête
    $stmt->bind_param("s", $username);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Vérifier si le mot de passe correspond au mot de passe hashé enregistré dans la base de données
        if (password_verify($password, $user['password'])) {
            // Le mot de passe est correct, l'utilisateur est connecté
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            ?>
            <script>
                // Afficher la fenêtre pop-up de bienvenue après un délai de 1 seconde (1000 millisecondes)
                setTimeout(function() {
                    var username = '<?php echo $_SESSION['username']; ?>';
                    alert('Welcome, ' + username + '! You are now connected.');
                    // Rediriger l'utilisateur vers la page d'accueil après l'affichage de l'alerte
                    window.location.href = "/index.php";
                }, 1000);
            </script>
            <?php
            // Pas besoin de la redirection ici, car elle est gérée par le JavaScript
            exit; // Assurez-vous de terminer le script après l'affichage de l'alerte
        } else {
            // Le mot de passe est incorrect
            echo '<script>alert("Le mot de passe est incorrect.");window.location.href = `/connexion.html`</script>';
        }
    } else {
        // L'utilisateur n'a pas été trouvé dans la base de données
        echo '<script>alert("Le nom d\'utilisateur est incorrect.");window.location.href = `/connexion.html` </script>';
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>
