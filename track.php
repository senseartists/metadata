<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Track - SENSE</title>
    <link href="/CSS/style.css" rel="stylesheet">
</head>
<body>
    <!-- PHP code to check if the user is logged in -->
    <?php
        // Start the session
        session_start();
        // Check if the user is logged in
        $loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    ?>

    <!-- If the user is not logged in, display a message -->
    <?php if (!$loggedIn) { ?>
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <div class="centered-container">
            You need to be logged in to be able to add a track to your database.
        </div>
        <?php exit; ?>
    <?php } ?>

    <div class="container">
        <div class="back-btn">
            <a href="index.php">Back</a>
        </div>
        <h1>Add a Track</h1>
        <form action="PHP/insert_track.php" method="post">
            <div class="form-group">
                <label for="track_number">Track Number:</label>
                <input type="number" id="track_number" name="track_number" required>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <br>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration:</label>
                <input type="time" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <br>
                <input type="text" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="subgenre">Subgenre:</label>
                <br>
                <input type="text" id="subgenre" name="subgenre">
            </div>
            <div class="form-group">
                <label for="mood">Mood:</label>
                <br>
                <input type="text" id="mood" name="mood">
            </div>
            <div class="form-group">
                <label for="language">Language:</label>
                <input type="text" id="language" name="language" required>
            </div>
            <div class="form-group">
                <label for="code_isrc">ISRC Code:</label>
                <input type="text" id="code_isrc" name="code_isrc">
            </div>
            <div class="form-group">
                <label for="code_iswc">ISWC Code:</label>
                <input type="text" id="code_iswc" name="code_iswc">
            </div>

            <div class="form-group">
    <label for="release">Release:</label>
    <br>
    <!-- Select element for choosing the release from the database -->
    <select class="releaseSelect" name="release" >
        <option value="" disabled selected>Select a release</option>
    </select>
</div>

            <div id="artistsContainer">
                <div class="form-group">
                    <label for="id_artist">Artist:</label>
                    <br>
                    <!-- Select element for choosing the artist(s) associated with the track -->
                    <select class="artistSelect" name="id_artist[]" required>
                        <option value="" disabled selected>Select an artist</option>
                        <!-- Dynamically populate the artists from the database using JavaScript -->
                    </select>
                    <br>
                    <br>
                    <label for="role_artist">Role:</label>
                    <br>
                    <input type="text" class="role_artist" name="role_artist[]" required>
                </div>
            </div>

            <button type="button" id="addArtistButton">Add Another Artist</button>

            <div class="submit-btn">
                <input type="submit" value="Add">
            </div>
        </form>

        <!-- Pop-up message box -->
        <div class="message-container" id="messageContainer">
            <div class="message-box" id="messageBox">
                <p id="messageContent"></p>
                <button onclick="closeMessageBox()">OK</button>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to fetch artists from the server using AJAX
    function fetchArtists(selectElement) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var artistsData = JSON.parse(xhr.responseText);
                    // Clear the previous options to prevent duplicates
                    selectElement.innerHTML = '';

                    // Add a default option
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    defaultOption.textContent = 'Select an artist';
                    selectElement.appendChild(defaultOption);

                    // Populate the artists from the server response
                    artistsData.forEach(function (artist) {
                        var option = document.createElement('option');
                        option.value = artist.id;
                        option.textContent = artist.name;
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error('Error fetching artists:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.open('GET', '/PHP/get_artists.php', true);
        xhr.send();
    }

    // Fetch artists once when the page loads for each artistSelect element
    var artistSelects = document.querySelectorAll('.artistSelect');
    artistSelects.forEach(function (selectElement) {
        fetchArtists(selectElement);
    });

    // Add event listener to the "Add Another Artist" button
    document.getElementById('addArtistButton').addEventListener('click', function () {
        var artistsContainer = document.getElementById('artistsContainer');
        var newFormGroup = document.createElement('div');
        newFormGroup.classList.add('form-group');

        // Clone the first artistSelect dropdown to create a new one
        var artistSelect = artistSelects[0].cloneNode(true);
        var roleInput = document.createElement('input');
        roleInput.type = 'text';
        roleInput.classList.add('role_artist');
        roleInput.name = 'role_artist[]';
        roleInput.required = true;

        newFormGroup.appendChild(document.createTextNode('Artist:'));
        newFormGroup.appendChild(document.createElement('br'));
        newFormGroup.appendChild(artistSelect);
        newFormGroup.appendChild(document.createTextNode('Role:'));
        newFormGroup.appendChild(roleInput);

        artistsContainer.appendChild(newFormGroup);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Function to fetch releases from the server using AJAX
    function fetchReleases(selectElement) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var releasesData = JSON.parse(xhr.responseText);
                    // Clear the previous options to prevent duplicates
                    selectElement.innerHTML = '';

                    // Add a default option
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    defaultOption.textContent = 'Select a release';
                    selectElement.appendChild(defaultOption);

                    // Populate the releases from the server response
                    releasesData.forEach(function (release) {
                        var option = document.createElement('option');
                        option.value = release.id;
                        option.textContent = release.name;
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error('Error fetching releases:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.open('GET', '/PHP/get_releases.php', true);
        xhr.send();
    }

    // Fetch releases once when the page loads
    var releaseSelect = document.querySelector('.releaseSelect'); // Corrected the class name to 'releaseSelect'
    fetchReleases(releaseSelect);

});


// Function to close the message box (if needed)
function closeMessageBox() {
    document.getElementById('messageContainer').style.display = 'none';
}


    </script>
</body>
</html>
