<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

if (!$loggedIn) {
    // Redirect the user if not logged in
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if an artist is selected
    if (!isset($_POST['artist_id']) || empty($_POST['artist_id'])) {
        echo "Please select an artist.";
        exit;
    }

    // Connect to the database (assuming you have the connection setup in PHP/config.php)
    require("config.php");

    // Get the connected user ID and the selected artist ID from the form
    $connected_user_id = $_SESSION['user_id'];
    $selected_artist_id = $_POST['artist_id'];

    // Process the uploaded file
    if (isset($_FILES['file1']) && $_FILES['file1']['error'] === UPLOAD_ERR_OK) {
        $file1 = $_FILES['file1'];

        // Generate a unique filename for the uploaded file
        $file_name = uniqid('file_', true) . '.' . pathinfo($file1['name'], PATHINFO_EXTENSION);

        // Move the uploaded file to the desired location
        $upload_directory = 'telechargements/';
        $file_path = $upload_directory . $file_name;

        if (!is_dir($upload_directory)) {
            mkdir($upload_directory, 0755, true); // Create the "uploads/" directory if it doesn't exist
        }

        if (move_uploaded_file($file1['tmp_name'], $file_path)) {
            // Insert the file path into the "file1" column of the "file" table
            $sql = "INSERT INTO file (file1, id_artist, id_users) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sii", $file_path, $selected_artist_id, $connected_user_id);
                $stmt->execute();
                $stmt->close();
                echo "File uploaded and information inserted successfully.";
            } else {
                echo "Error executing the SQL statement: " . $conn->error;
            }
        } else {
            echo "Error uploading the file: Could not move the file.";
        }
    } else {
        echo "Error uploading the file: " . $_FILES['file1']['error'];
    }

    // Close the database connection
    $conn->close();
}
?>
