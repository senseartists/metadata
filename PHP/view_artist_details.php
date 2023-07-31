<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Details</title>
    <link href="/CSS/style.css" rel="stylesheet">
    <style>
         .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tab-btn {
            padding: 10px 20px;
            background-color: #E5ABCE;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .tab-btn.active {
            background-color: #e25ead;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }

        .artist-info {
        display: grid;
        grid-template-columns: max-content 1fr;
        gap: 10px;
    }
    .artist-info strong {
        text-align: right;
    }

    .tab-content a {
        color: #ffffff; /* Couleur blanche pour le texte du lien */
        text-decoration: none; /* Supprime le soulignement par défaut du lien */
    }

              
    .edit-btn {
            margin-top: 20px;
            padding: 8px 8px;
            background-color: transparent;
            color: #fff;
            font-size: 14px;
            border: none;
            cursor: pointer;
          }
          
          /* Style the "Add" button */
          .edit-btn input[type="button"] {
            padding: 8px 8px;
            background-color: transparent;
            color: #fff;
            font-size: 14px;
            border: none;
            cursor: pointer;
          }
          
          /* Style the "Add" button on hover */
          .edit-btn:hover {
            background-color: #e25ead;
          }

          p{
            font-size: 18px;
          }
          
    </style>
</head>
<body>
<script>
                        // Fonction pour afficher l'onglet sélectionné
                        function showTab(tabName) {
                            var tabContents = document.getElementsByClassName("tab-content");
                            for (var i = 0; i < tabContents.length; i++) {
                                tabContents[i].style.display = "none";
                            }

                            var tabButtons = document.getElementsByClassName("tab-btn");
                            for (var i = 0; i < tabButtons.length; i++) {
                                tabButtons[i].classList.remove("active");
                            }

                            var selectedTab = document.getElementById(tabName);
                            if (selectedTab) {
                                selectedTab.style.display = "block";
                            }

                            var activeButton = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
                            if (activeButton) {
                                activeButton.classList.add("active");
                            }
                        }
                    </script>
    <div class="container">
        <div class="back-btn">
            <a href="/view_artists.php">Back</a>
        </div>
        <?php
        require('config.php');

          // Vérifier si l'ID de l'artiste a été envoyé en tant que paramètre POST
          if (isset($_POST["artist_id"])) {
            $artist_id = $_POST["artist_id"];

            // Récupérer les détails de l'artiste à partir de la base de données
            $sql_artist = "SELECT * FROM artist WHERE id = ?";
            $stmt_artist = $conn->prepare($sql_artist);
            $stmt_artist->bind_param("i", $artist_id);

            if ($stmt_artist->execute()) {
                $result_artist = $stmt_artist->get_result();

                // Vérifier si l'artiste a été trouvé
                if ($result_artist->num_rows > 0) {
                    $artist = $result_artist->fetch_assoc();
                    $selectedArtistName = $artist['artist_name'];
                    ?>
                    <!-- Affichage du nom de l'artiste dans le titre -->
                    <h1><?php echo $selectedArtistName; ?></h1>
                    <!-- Affichage des onglets -->
                    <div class="tabs">
                        <button class="tab-btn active" onclick="showTab('details-tab')">Details</button>
                        <button class="tab-btn" onclick="showTab('releases-tab')">Releases</button>
                        <button class="tab-btn" onclick="showTab('recordings-tab')">Recordings</button>
                        <button class="tab-btn" onclick="showTab('link-tab')">Links</button>
                        <button class="tab-btn" onclick="showTab('file-tab')">File</button>
                    </div>

                    <!-- Contenu des onglets -->
                    <div class="tab-content active" id="details-tab">
    <!-- Afficher ici les détails de l'artiste -->
    <button class="edit-btn">
        <a href="edit_artist.php?id=<?php echo $artist_id; ?>" >Edit artist information</a>
                </button>
    <center><u><h2>Artist Details</h2></u></center> 
    <div class="artist-info">
        <p><strong>Artist Name:</strong></p>
        <p><?php echo $artist['artist_name']; ?></p>

        <p><strong> Name:</strong></p>
        <p><?php echo $artist['name']; ?></p>

        <p><strong>Surame:</strong></p>
        <p><?php echo $artist['surname']; ?></p>

        <p><strong>Date of Birth:</strong></p>
        <p><?php echo $artist['date_of_birth']; ?></p>

        <p><strong>Gender:</strong></p>
        <p><?php echo $artist['gender']; ?></p>

        <p><strong>Nationality:</strong></p>
        <p><?php echo $artist['nationality']; ?></p>

        <p><strong>Address:</strong></p>
        <p><?php echo $artist['address']; ?></p>

        <p><strong>Telephone:</strong></p>
        <p><?php echo $artist['telephone']; ?></p>

        <p><strong>Email:</strong></p>
        <p><?php echo $artist['email']; ?></p>

        <p><strong>Social Security Number:</strong></p>
        <p><?php echo $artist['social_security_number']; ?></p>

        <p><strong>Tax Domicile:</strong></p>
        <p><?php echo $artist['tax_domicile']; ?></p>

        <p><strong>Musical Genre:</strong></p>
        <p><?php echo $artist['musical_genre']; ?></p>

        <p><strong>IPI:</strong></p>
        <p><?php echo $artist['IPI']; ?></p>

        <p><strong>COAD:</strong></p>
        <p><?php echo $artist['COAD']; ?></p>
    </div>
</div>

<div class="tab-content" id="releases-tab">
    <!-- Afficher ici les releases de l'artiste -->
    <center><u><h2>Releases</h2></u></center>
    <?php
    // Vérifier si l'ID de l'artiste a été envoyé en tant que paramètre POST
    if (isset($_POST["artist_id"])) {
        $artist_id = $_POST["artist_id"];

        // Requête SQL pour récupérer les releases de l'artiste à partir de la table "release",
        // "track" et "artist_track"
        $sql_releases = "SELECT r.* FROM `release` AS r
                       WHERE r.id_artist = ?";

$sql_reltrack = "SELECT r.* FROM `release` AS r
JOIN track ON r.id = track.id_release
AND r.id = track.id_release";
        
        // Préparation de la requête
        $stmt_releases = $conn->prepare($sql_releases);

        // Vérification de la préparation de la requête
        if ($stmt_releases) {
            // Liaison du paramètre à la requête
            $stmt_releases->bind_param("i", $artist_id);

            // Exécution de la requête
            if ($stmt_releases->execute()) {
                // Récupération des résultats
                $result_releases = $stmt_releases->get_result();

                // Vérifier si l'artiste a des releases
                if ($result_releases->num_rows > 0) {
                    while ($release = $result_releases->fetch_assoc()) {
                        ?>
                        <center> <h3> Name : <?php echo $release['name_release']; ?></h3></center>
                        <div class="artist-info">
                            <br>
                            <p><strong>Date:</strong> <?php echo $release['date_release']; ?></p>
                            <br>
                            <p><strong>Type:</strong> <?php echo $release['type_release']; ?></p>
                            <br>
                            <p><strong>Code UPC :</strong> <?php echo $release['code_upc']; ?></p>
                            <br>
                            <p><strong>Catalog Number:</strong> <?php echo $release['catalog_number']; ?></p>
                             <!-- Afficher ici les pistes associées à la release -->
                          <?php
                        // Requête SQL pour récupérer les pistes de cette release à partir de la table "track"
                        $sql_tracks = "SELECT * FROM `track` WHERE id_release = ?";
                        // Préparation de la requête
                        $stmt_tracks = $conn->prepare($sql_tracks);

                        // Liaison du paramètre à la requête
                        $stmt_tracks->bind_param("i", $release['id']);

                        // Exécution de la requête
                        if ($stmt_tracks->execute()) {
                            // Récupération des résultats
                            $result_tracks = $stmt_tracks->get_result();

                            // Vérifier s'il y a des pistes associées à cette release
                            if ($result_tracks->num_rows > 0) {
                                ?>
                                    <h4>Tracks:</h4>
                                    <p>
                        
                                        <?php
                                        while ($track = $result_tracks->fetch_assoc()) {
                                            ?>
                                            - <?php echo $track['title']; ?>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        </p>
                                <?php
                            }
                            $stmt_tracks->close();
                        } else {
                            echo "Error executing the query: " . $stmt_tracks->error;
                        }
                        ?>
                        </div>
                        <hr>
                         <?php
                    }
                } else {
                    echo "No releases found for this artist.";
                }
            } else {
                echo "Error executing the query: " . $stmt_releases->error;
            }

            // Fermeture du statement
            $stmt_releases->close();
        } else {
            echo "Error preparing the query: " . $conn->error;
        }
    } else {
        echo "Artist ID is empty or not provided.";
    }
    ?>
</div>



                    <div class="tab-content" id="recordings-tab">
    <!-- Afficher ici les enregistrements (tracks) de l'artiste -->
    <center><u><h2>Recordings</h2></u></center>

    <?php
    // Requête SQL pour récupérer les enregistrements (tracks) de l'artiste à partir de la table "track" et "artist_track"
    $sql_tracks = "SELECT track.* FROM track
                   JOIN artist_track ON track.id = artist_track.id_track
                   WHERE artist_track.id_artist = ?";
    $stmt_tracks = $conn->prepare($sql_tracks);
    $stmt_tracks->bind_param("i", $artist_id);

    if ($stmt_tracks->execute()) {
        $result_tracks = $stmt_tracks->get_result();

        // Vérifier si l'artiste a des enregistrements
        if ($result_tracks->num_rows > 0) {
            while ($track = $result_tracks->fetch_assoc()) {
                ?>
                <div class="artist-info">
                    <p><strong>Title:</strong><?php echo $track['title']; ?></p>
                    <br>
                    <p><strong>Role:</strong>
                    <?php 
                     $sql = "SELECT role_artist FROM `artist_track` WHERE id_track = " . $track['id'];
                     $result = $conn->query($sql);
                     if ($result && $result->num_rows > 0) {
                         $row = $result->fetch_assoc();
                         echo $row['role_artist'];
                     }else {
             echo "Role not found"; // Message en cas de résultat vide ou d'erreur de requête
         }
                    ?></p>
                    <br>
                    <p><strong>Release:</strong> 
                    <?php 
                    $sql = "SELECT name_release FROM `release` WHERE id = " . $track['id_release'];
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        echo $row['name_release'];
                    }else {
            echo "Release not found"; // Message en cas de résultat vide ou d'erreur de requête
        }
    ?>
</p>

                    <br>
                    <p><strong>Track Number:</strong> <?php echo $track['track_number']; ?></p>
                    <br>
                    <p><strong>Duration:</strong> <?php echo $track['duration']; ?></p>
                    <br>
                    <p><strong>Genre:</strong> <?php echo $track['genre']; ?></p>
                    <br>
                    <p><strong>Language:</strong> <?php echo $track['language']; ?></p>
                    <br>
                    <p><strong>ISRC Code:</strong> <?php echo $track['code_isrc']; ?></p>
                    <br>
                    <p><strong>ISWC Code:</strong> <?php echo $track['code_iswc']; ?></p>
                </div>
                <hr>
                <?php
            }
        } else {
            echo "No recordings found for this artist.";
        }
    } else {
        echo "Error retrieving recordings: " . $stmt_tracks->error;
    }
    ?>
</div>



                    <div class="tab-content" id="link-tab">
                    <button class="edit-btn">
        <a href="edit_link.php?id=<?php echo $artist_id; ?>" >Edit link information</a>
                </button>
                        <!-- Afficher ici les link de l'artiste -->
                        <center><u><h2>Links</h2></u></center>
                        <?php
// Récupérer les enregistrements (link) de l'artiste à partir de la base de données
$sql_links = "SELECT * FROM link WHERE id_artist = ?";
$stmt_links = $conn->prepare($sql_links);
$stmt_links->bind_param("i", $artist_id);

if ($stmt_links->execute()) {
    $result_links = $stmt_links->get_result();

    // Vérifier si l'artiste a des enregistrements
    if ($result_links->num_rows > 0) {
        while ($link = $result_links->fetch_assoc()) {
            ?>
            <div class="artist-info">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg>
                    <strong>Instagram:</strong> <?php echo $link['instagram']; ?></p>
                    <br>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                    <strong>Facebook:</strong> <?php echo $link['facebook']; ?></p>
                    <br>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                    <strong>Twitter:</strong> <?php echo $link['twitter']; ?></p>
                    <br>
                    <p> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-spotify" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.669 11.538a.498.498 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686zm.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858zm.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288z"/>
                </svg>
                <strong>Spotify:</strong> <a href="<?php echo $link['spotify']; ?>"><?php echo $link['spotify']; ?></a></p>
                <br>
                    <p> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
  <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
</svg>
                <strong>TikTok:</strong> <a href="<?php echo $link['tiktok']; ?>"><?php echo $link['tiktok']; ?></a></p>
                <br>
                    <p> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
  <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
</svg> 
                <strong>Other:</strong> <a href="<?php echo $link['other']; ?>"><?php echo $link['other']; ?></a></p>

                    <br>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "No link found for this artist.";
    }
} else {
    echo "Error retrieving recordings.";
}
?>

<div class="tab-content" id="file-tab">
    <!-- Afficher ici les enregistrements (files) de l'artiste -->
    <center><u><h2>Files</h2></u></center>


</div>


                    <?php
                } else {
                    echo "Aucun artiste trouvé avec cet ID.";
                }
            } else {
                echo "Erreur lors de la récupération des détails de l'artiste.";
            }
        } else {
            echo "ID de l'artiste non spécifié.";
        }
        ?>
    </div>
</body>
</html>
