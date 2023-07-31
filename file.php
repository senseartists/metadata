<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Add a File - SENSE </title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to add a label to your database.';
        echo '</div>';       
        exit;
    }
    ?>

  <form id="fileForm" method="post" enctype="multipart/form-data" action="PHP/insert_files.php">
  <div class="container">
  <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add a File</h1>
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
    <div id="fileInputs">
      <label for="file1">File 1:</label>
      <input type="file" name="file1" id="file1" required>
    </div>
    <div class="submit-file-btn">
      <input type="button" id="addFileButton" value="Add more files">
    </div>
    <div class="submit-btn">
                <input type="submit" value="Add">
            </div>
</div>
  </form>
  <script src="JS/file.js"></script>
</body>
</html>
