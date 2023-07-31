<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Check if the user is logged in before proceeding
if (!$loggedIn) {
    header("Location: index.php");
    exit;
}

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $name_release = $_POST["name_release"];
    $type_release = $_POST["type_release"];
    $code_upc = $_POST["code_upc"];
    $catalog_number = $_POST["catalog_number"];
    $id_label = $_POST["id_label"];

    // Perform data validation (You should do more thorough validation based on your requirements)

    // Include the database connection settings
    require('config.php');

    // Check if the user is logged in before proceeding
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    // Get the ID of the logged-in user
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the SQL query to insert the release data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO `release` (name_release, type_release, code_upc, catalog_number, id_label, id_users) VALUES (?, ?, ?, ?, ?, ?)");

    // Check if the SQL query preparation was successful
    if ($stmt === false) {
        // Handle the case when there is an error in the SQL query
        die("Error in SQL query: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssii", $name_release, $type_release, $code_upc, $catalog_number, $id_label, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        // Data insertion successful
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    
        // JavaScript code to display a success alert and redirect to release.php
        echo '<script>';
        echo 'alert("Release added successfully!");';
        echo 'window.location.href = "/release.php";';
        echo '</script>';
        exit;
    } else {
        // Handle the case when data insertion fails
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo "Error inserting data into the database: " . mysqli_error($conn);
    }
}
?>
