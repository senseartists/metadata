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
                        option.textContent = release.name; // Corrected to use "name" instead of "title"
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error('Error fetching releases:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.open('GET', '/PHP/get_releases.php', true); // Change the URL to the server-side script that fetches releases
        xhr.send();
    }

    // Fetch releases once when the page loads
    var releaseSelect = document.querySelector('.releaseSelect');
    fetchReleases(releaseSelect);

});



// Function to close the message box (if needed)
function closeMessageBox() {
    document.getElementById('messageContainer').style.display = 'none';
}
