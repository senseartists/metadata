<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

if (!$loggedIn) {
    // Redirect to the login page if the user is not logged in
    header('Location: index.php');
    exit;
}

// Check if the required parameters are provided in the URL
if (isset($_GET['artist_id']) && isset($_GET['table_choice'])) {
    // Retrieve the artist ID and table choice from the URL parameters
    $artistId = $_GET['artist_id'];
    $tableChoice = $_GET['table_choice'];

    // TODO: Fetch the information for the selected element from the database based on $tableChoice and $artistId.
    // You need to implement the database connection and query to fetch the data.

    // For demonstration purposes, let's assume you have fetched the data into the $elementData variable.
    // $elementData should be an associative array containing the information to display in the form.

    // Sample data (replace this with your actual database query)
    $elementData = [
        'element_id' => 1,
        'element_name' => 'Element Name',
        'element_description' => 'Element Description',
        // Add other fields here based on the selected element
    ];
} else {
    // Redirect to the modify_artist.php page if the required parameters are not provided
    header('Location: /modify_artist.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify <?php echo ucfirst($tableChoice); ?></title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <div class="container">
        <div class="title-wrapper">
            <h1>Modify <?php echo ucfirst($tableChoice); ?></h1>
            <form action="process_modify_element.php" method="POST">
                <!-- Display the information in the form for modification -->
                <label for="element_name">Element Name:</label>
                <input type="text" name="element_name" id="element_name" value="<?php echo $elementData['element_name']; ?>">

                <label for="element_description">Element Description:</label>
                <textarea name="element_description" id="element_description"><?php echo $elementData['element_description']; ?></textarea>

                <!-- Add other form fields for the selected element here -->

                <!-- Hidden fields to pass the artist ID and table choice to the processing page -->
                <input type="hidden" name="artist_id" value="<?php echo $artistId; ?>">
                <input type="hidden" name="table_choice" value="<?php echo $tableChoice; ?>">

                <br>
                <br>
                <input type="submit" value="Save Changes" class="submit-button">
                <br>
                <a class="button" href="modify_artist.php">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
