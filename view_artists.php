<?php
// Start the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Check if the user has admin privileges (id_role = 1)
$isAdmin = false;
if ($loggedIn) {
    require('PHP/config.php');
    $connected_user_id = $_SESSION['user_id'];
    $sql = "SELECT id_role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $connected_user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $isAdmin = $row['id_role'] == 1;
        }

        $stmt->close();
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose an Artist - Artist Management</title>
    <style>
        body {
            background-image: url("/images/grad.jpg");
            background-size: cover;
            background-position: center;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: left;
        }
        h1 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            width: 150px;
            font-weight: bold;
        }
        .form-group select {
            width: 90%;
            padding: 5px;
        }
        .submit-btn {
            margin-top: 20px;
            text-align: center;
        }

        /* Style the "View Details" button */
        .submit-btn input[type="submit"] {
            padding: 10px 20px;
            background-color: #E5ABCE;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style the "View Details" button on hover */
        .submit-btn input[type="submit"]:hover {
            background-color: #e25ead;
        }

        /* Style the "View Details" button on active (when clicked) */
        .submit-btn input[type="submit"]:active {
            background-color: #dd2f97;
        }

        /* Add rounded corners to the form container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: left;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .back-btn {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E5ABCE;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #ec83c2;
        }

             /* centrer texte */
             .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-weight: bold;
        }

    </style>
</head>
<body>


<?php
    if (!$loggedIn) {
        echo'<div class="back-btn">';
        echo'<a href="index.php">Back</a>';
        echo'</div>';
        echo '<div class="centered-container">';
        echo 'You need to be logged in to be able to view the artists registered in your database.';
        echo '</div>';       
        exit;
    }
    ?>
      <div class="container">
    <div class="back-btn">
        <a href="index.php">Back</a>
    </div>
    <h1>Choose an Artist</h1>
    <form action="PHP/view_artist_details.php" method="post">
        <div class="form-group">
            <label for="artist_id">Select an Artist:</label>

            <select id="artist_id" name="artist_id" required>
                <option value="">-- Select an artist --</option>
                <?php
                require('PHP/config.php');
                // Fetch artists depending on the user's id_role
                $connected_user_id = $_SESSION['user_id'];
                
                if ($isAdmin) {
                    // If the user has id_role = 1 (admin), fetch all artists
                    echo($isAdmin);
                    $sql = "SELECT id, artist_name FROM artist";
                    $stmt = $conn->prepare($sql);
                } else {
                    // If the user doesn't have id_role = 1 (not admin), fetch only their artists
                    $sql = "SELECT id, artist_name FROM artist WHERE id_users = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $connected_user_id);
                }

                if ($stmt) {
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['artist_name'] . '</option>';
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
        </div>
        <div class="submit-btn">
            <input type="submit" value="View Details">
        </div>
    </form>
</div>
</body>
</html>