<?php
require('config.php');

session_start();
// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Check if the user is logged in, else redirect to index.php
if (!$loggedIn) {
    header('Location: index.php');
    exit;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the form submission
    $trackNumber = $_POST['track_number'];
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $subgenre = $_POST['subgenre'];
    $mood = $_POST['mood'];
    $language = $_POST['language'];
    $codeIsrc = $_POST['code_isrc'];
    $codeIswc = $_POST['code_iswc'];
    $idUser = $_SESSION['user_id']; // Get the user ID from the session

    // Check if the "release" field is set
    if (isset($_POST['release'])) {
        $idRelease = $_POST['release']; // Assuming the release ID is sent from the form
    } else {
        $idRelease = null; // Set the release ID to NULL when the field is not set
    }

    // Add release_date to the column list and add the corresponding value
    $releaseDate = date('Y-m-d'); // Assuming the release date is today's date
    $sqlTrack = "INSERT INTO track (track_number, title, duration, release_date, genre, subgenre, mood, language, code_isrc, code_iswc, id_users, id_release) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtTrack = $conn->prepare($sqlTrack);
    $stmtTrack->bind_param("isssssssssii", $trackNumber, $title, $duration, $releaseDate, $genre, $subgenre, $mood, $language, $codeIsrc, $codeIswc, $idUser, $idRelease);

    if ($stmtTrack->execute()) {
        $trackId = $stmtTrack->insert_id;

        // Insert artist-role associations into the 'artist_track' table
        if (isset($_POST['id_artist']) && isset($_POST['role_artist'])) {
            $artistIds = $_POST['id_artist'];
            $roles = $_POST['role_artist'];

            $sqlArtistTrack = "INSERT INTO artist_track (id_track, id_artist, role_artist) VALUES (?, ?, ?)";
            $stmtArtistTrack = $conn->prepare($sqlArtistTrack);

            // Loop through each artist-role pair and insert into the table
            for ($i = 0; $i < count($artistIds); $i++) {
                $stmtArtistTrack->bind_param("iis", $trackId, $artistIds[$i], $roles[$i]);
                $stmtArtistTrack->execute();
            }

            $stmtArtistTrack->close(); // Close the statement after the loop
        }

         // JavaScript code to display a success alert and redirect to release.php
         echo '<script>';
         echo 'alert("Track added successfully!");';
         echo 'window.location.href = "/track.php";';
         echo '</script>';
         exit;
    } else {
        // Handle the case when track insertion fails
        // ...
        echo "Error inserting track data: " . $stmtTrack->error;
    }

    $stmtTrack->close();
}

// Close the database connection
$conn->close();
?>
