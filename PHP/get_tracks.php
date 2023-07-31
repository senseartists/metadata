<?php
// Check if the artist_id parameter is provided in the URL
if (isset($_GET["artist_id"])) {
    // Sanitize the artist_id value to prevent SQL injection
    $artist_id = (int)$_GET["artist_id"];

    // Perform database operations to fetch the tracks associated with the artist
    // Assuming you have a database connection established in the 'config.php' file
    require('config.php');

    // Check if the artist exists in the 'track' table
    $sql_check_artist = "SELECT COUNT(*) as count FROM track WHERE id_artist = ?";
    $stmt_check_artist = $conn->prepare($sql_check_artist);

    if ($stmt_check_artist) {
        // Bind the artist_id parameter to the prepared statement
        $stmt_check_artist->bind_param("i", $artist_id);

        // Execute the prepared statement
        $stmt_check_artist->execute();

        // Get the result set
        $result_check_artist = $stmt_check_artist->get_result();
        $row_check_artist = $result_check_artist->fetch_assoc();

        // If the artist exists, fetch the associated tracks
        if ($row_check_artist['count'] > 0) {
            $sql_fetch_tracks = "SELECT id, title FROM track WHERE id_artist = ?";
            $stmt_fetch_tracks = $conn->prepare($sql_fetch_tracks);

            if ($stmt_fetch_tracks) {
                // Bind the artist_id parameter to the prepared statement
                $stmt_fetch_tracks->bind_param("i", $artist_id);

                // Execute the prepared statement
                $stmt_fetch_tracks->execute();

                // Get the result set
                $result_fetch_tracks = $stmt_fetch_tracks->get_result();

                $tracks = array();
                if ($result_fetch_tracks->num_rows > 0) {
                    while ($row = $result_fetch_tracks->fetch_assoc()) {
                        $tracks[] = $row;
                    }
                }

                // Close the statement
                $stmt_fetch_tracks->close();

                // Output the tracks data as JSON
                header('Content-Type: application/json');
                echo json_encode($tracks);
            } else {
                // If the prepared statement could not be created, return an error message
                header('Content-Type: application/json');
                echo json_encode(array("error" => "An error occurred while fetching tracks."));
            }
        } else {
            // If the artist does not exist, return an empty array
            header('Content-Type: application/json');
            echo json_encode(array());
        }

        // Close the statement
        $stmt_check_artist->close();
    } else {
        // If the prepared statement could not be created, return an error message
        header('Content-Type: application/json');
        echo json_encode(array("error" => "An error occurred while fetching tracks."));
    }

    // Close the database connection
    $conn->close();
} else {
    // If artist_id is not provided in the URL, return an error message
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Invalid request. Artist ID not provided."));
}
?>
