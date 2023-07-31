    function addArtist() {
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('PHP/insert_artist.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const message = data.success ? "Artiste ajouté avec succès." : "Erreur lors de l'ajout de l'artiste.";
            const messageContent = document.getElementById('messageContent');
            messageContent.textContent = message;
            openMessageBox();
            // Vous pouvez également personnaliser le style du message si besoin.
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX :', error);
        });
    }

    function openMessageBox() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.style.display = 'flex';
    }

    function closeMessageBox() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.style.display = 'none';
    }

    document.querySelector('.submit-btn input[type="submit"]').addEventListener('click', function(event) {
        event.preventDefault();
        addArtist();
    });



    // Function to fetch and populate the artist dropdown
    function populateArtistDropdown() {
        fetch('PHP/get_artists.php')
            .then(response => response.json())
            .then(data => {
                const artistDropdown = document.getElementById('id_artist');

                // Remove existing options
                artistDropdown.innerHTML = '';

                // Add options for each artist
                data.forEach(artist => {
                    const option = document.createElement('option');
                    option.value = artist.id;
                    option.textContent = artist.name;
                    artistDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching artists:', error));
    }

    // Function to fetch and populate the label dropdown
    function populateLabelDropdown() {
        fetch('PHP/get_labels.php')
            .then(response => response.json())
            .then(data => {
                const labelDropdown = document.getElementById('id_label');

                // Remove existing options
                labelDropdown.innerHTML = '<option value=""></option>';

                // Add options for each label
                data.forEach(label => {
                    const option = document.createElement('option');
                    option.value = label.id;
                    option.textContent = label.name;
                    labelDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching labels:', error));
    }

    // Call both functions to populate the dropdowns when the page loads
    document.addEventListener('DOMContentLoaded', () => {
        populateArtistDropdown();
        populateLabelDropdown();
    });

    function addTrack() {
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('PHP/insert_track.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const message = data.success ? "Track ajoutée avec succès." : "Erreur lors de l'ajout de la Track.";
            const messageContent = document.getElementById('messageContent');
            messageContent.textContent = message;
            openMessageBox();
            // Vous pouvez également personnaliser le style du message si besoin.
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX :', error);
        });
    }

    function openMessageBox() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.style.display = 'flex';
    }

    function closeMessageBox() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.style.display = 'none';
    }

    document.querySelector('.submit-btn input[type="submit"]').addEventListener('click', function(event) {
        event.preventDefault();
        addTrack();
    });


    document.addEventListener("DOMContentLoaded", function () {
        fetchArtists();
    });

    function fetchArtists() {
        const artistsSelect = document.getElementById("id_artist");
        fetch("get_artist.php")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((artist) => {
                    const option = document.createElement("option");
                    option.value = artist.id;
                    option.textContent = artist.pseudonyme;
                    artistsSelect.appendChild(option);
                });
            })
            .catch((error) => console.error("Error fetching artists:", error));
    }

    function fetchTracksByArtist(artistId) {
        const artistTracksSelect = document.getElementById("artist_tracks");
        fetch(`get_track.php?artistId=${artistId}`)
            .then((response) => response.json())
            .then((data) => {
                // Clear previous options
                artistTracksSelect.innerHTML = "";
                data.forEach((track) => {
                    const option = document.createElement("option");
                    option.value = track.id;
                    option.textContent = track.title;
                    artistTracksSelect.appendChild(option);
                });
                artistTracksSelect.disabled = false; // Enable the select element
            })
            .catch((error) => console.error("Error fetching tracks:", error));
    }

    // Event listener for when the artist is selected
    document.getElementById("id_artist").addEventListener("change", function () {
        const selectedArtistId = this.value;
        fetchTracksByArtist(selectedArtistId);
    });


    function addCopyright() {
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('PHP/insert_copyright.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const message = data.success ? "Copyright ajouté avec succès." : "Erreur lors de l'ajout du copyright.";
            const messageContent = document.getElementById('messageContent');
            messageContent.textContent = message;
            openMessageBox();
            // You can also customize the style of the message if needed.
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX:', error);
        });
    }



