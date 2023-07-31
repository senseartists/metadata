<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('config.php');

    // Get the form data
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rights_holder = $_POST['rights_holder'];
    $id_artist = $_POST['id_artist'];
    $id_track = $_POST['artist_tracks'];

    session_start();
    $connected_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Prepare and execute the SQL query to insert copyright information
    $sql = "INSERT INTO copyright (start_date, end_date, rights_holder,id_users)
            VALUES ('$start_date', '$end_date', '$rights_holder', '$connected_user_id')";

    if ($conn->query($sql) === TRUE) {
        // Get the ID of the inserted copyright record
        $copyright_id = $conn->insert_id;

        // Insert the copyright information into the custom_identifiers table
        $sql_custom_identifiers = "INSERT INTO custom_identifiers (platform_name, identifiant, id_track)
                                  VALUES ('Copyright', '$copyright_id', '$id_track')";
        $conn->query($sql_custom_identifiers);

        // Output success message
        $response = array('message' => 'Copyright information added successfully.');
        echo json_encode($response);
    } else {
        // Output error message
        $response = array('message' => 'Error adding copyright information: ' . $conn->error);
        echo json_encode($response);
    }

    $conn->close();
} else {
    // Output error message if the form is not submitted
    $response = array('message' => 'Form submission error: The form was not submitted.');
    echo json_encode($response);
}
?>
