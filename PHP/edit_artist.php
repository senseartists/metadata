<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - SENSE</title>
    <link href="/CSS/style.css" rel="stylesheet">
    <link href="/CSS/style_edit.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="back-btn">
            <a href="/view_artists.php">Back</a>
        </div>
        <?php
        require('config.php');

        if (isset($_GET["id"])) {
            $artist_id = $_GET["id"];

            // Check if the form has been submitted
            if (isset($_POST['submit'])) {
                // Retrieve the updated artist details from the form
                $artist_name = $_POST['artist_name'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $date_of_birth = $_POST['date_of_birth'];
                $gender = $_POST['gender'];
                $nationality = $_POST['nationality'];
                $address = $_POST['address'];
                $telephone = $_POST['telephone'];
                $email = $_POST['email'];
                $social_security_number = $_POST['social_security_number'];
                $tax_domicile = $_POST['tax_domicile'];
                $musical_genre = $_POST['musical_genre'];
                $IPI = $_POST['IPI'];
                $COAD = $_POST['COAD'];
                // Add other fields as necessary

                // Update the artist details in the database
                $sql_update = "UPDATE artist SET 
                    artist_name = ?,
                    name = ?,
                    surname = ?,
                    date_of_birth = ?,
                    gender = ?,
                    nationality = ?,
                    address = ?,
                    telephone = ?,
                    email = ?,
                    social_security_number = ?,
                    tax_domicile = ?,
                    musical_genre = ?,
                    IPI = ?,
                    COAD = ?
                    WHERE id = ?";

                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param(
                    "sssssssisissisi",
                    $artist_name,
                    $name,
                    $surname,
                    $date_of_birth,
                    $gender,
                    $nationality,
                    $address,
                    $telephone,
                    $email,
                    $social_security_number,
                    $tax_domicile,
                    $musical_genre,
                    $IPI,
                    $COAD,
                    $artist_id
                );

                if ($stmt_update->execute()) {
                    echo "Artist details updated successfully.";
                } else {
                    echo "Error updating artist details.";
                }
            }

            // Retrieve the current artist details from the database
            $sql_artist = "SELECT * FROM artist WHERE id = ?";
            $stmt_artist = $conn->prepare($sql_artist);
            $stmt_artist->bind_param("i", $artist_id);

            if ($stmt_artist->execute()) {
                $result_artist = $stmt_artist->get_result();

                if ($result_artist->num_rows > 0) {
                    $artist = $result_artist->fetch_assoc();

                    // Display the artist details in an editable form
                    ?>
                    <h1>Edit Artist Details</h1>
                    <form method="POST" action="">
                        <label for="artist_name">Artist Name:</label>
                        <input type="text" name="artist_name" value="<?php echo $artist['artist_name']; ?>" ><br><br>

                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $artist['name']; ?>" ><br><br>

                        <label for="surname">Surname:</label>
                        <input type="text" name="surname" value="<?php echo $artist['surname']; ?>" ><br><br>

                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" name="date_of_birth" value="<?php echo $artist['date_of_birth']; ?>" file><br><br>

                        <label for="gender">Gender:</label>
                        <input type="text" name="gender" value="<?php echo $artist['gender']; ?>" file><br><br>

                        <label for="nationality">Nationality:</label>
                        <input type="text" name="nationality" value="<?php echo $artist['nationality']; ?>" file><br><br>

                        <label for="address">Address:</label>
                        <textarea name="address"><?php echo $artist['address']; ?></textarea><br><br>

                        <label for="telephone">Telephone:</label>
                        <input type="text" name="telephone" value="<?php echo $artist['telephone']; ?>"><br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo $artist['email']; ?>"><br><br>

                        <label for="social_security_number">Social Security Number:</label>
                        <input type="text" name="social_security_number" value="<?php echo $artist['social_security_number']; ?>"><br><br>

                        <label for="tax_domicile">Tax Domicile:</label>
                        <input type="text" name="tax_domicile" value="<?php echo $artist['tax_domicile']; ?>"><br><br>

                        <label for="musical_genre">Musical Genre:</label>
                        <input type="text" name="musical_genre" value="<?php echo $artist['musical_genre']; ?>" file><br><br>

                        <label for="IPI">IPI:</label>
                        <input type="text" name="IPI" value="<?php echo $artist['IPI']; ?>"><br><br>

                        <label for="COAD">COAD:</label>
                        <input type="text" name="COAD" value="<?php echo $artist['COAD']; ?>"><br><br>
                        <div class="submit-btn">
                        <input type="submit" name="submit" value="Update">
                </div>
                    </form>
                    <?php
                } else {
                    ?>
                            <form id="labelForm" method="post" action="PHP/insert_link.php">
                            <div class="form-group">
            <label for="instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg> Instagram:
                </label>
                <input type="text" id="instagram" name="instagram">
            </div>

            <div class="form-group">
                <label for="facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg> Facebook:
                </label>
                <input type="text" id="facebook" name="facebook">
            </div>

            <div class="form-group">
                <label for="twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg> Twitter:
                </label>
                <input type="text" id="twitter" name="twitter">
            </div>

            <div class="form-group">
                <label for="spotify">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.669 11.538a.498.498 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686zm.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858zm.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288z"/>
                </svg> Spotify:
                </label>
                <input type="text" id="spotify" name="spotify">
            </div>
            <div class="form-group">
                <label for="tiktok">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
  <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
</svg> TikTok:
                </label>
                <input type="text" id="tiktok" name="tiktok">
            </div>
            <div class="form-group">
                <label for="other">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
  <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
</svg> Other:
                </label>
                <input type="text" id="other" name="other">
            </div>
            <div class="submit-btn">
                <input type="submit" value="Update">
            </div>
        </form>

<?php                }
            } else {
                echo "Error retrieving artist details.";
            }
        } else {
            echo "Artist ID not specified.";
        }
        ?>
    </div>
</body>
</html>
