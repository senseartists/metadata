// Function to populate the list of artists in the dropdown
function populateArtistsList() {
    const artistSelect = document.getElementById("id_artist");
  
    // Make an AJAX request to fetch the list of artists from the server
    fetch("/PHP/get_artists.php")
      .then((response) => response.json())
      .then((data) => {
        // Clear any existing options
        artistSelect.innerHTML = "";
  
        // Populate the dropdown list with artists
        data.forEach((artist) => {
          const option = document.createElement("option");
          option.value = artist.id;
          option.textContent = artist.pseudonyme;
          artistSelect.appendChild(option);
        });
      })
      .catch((error) => console.error("Error fetching artists:", error));
  }
  
  // Function to populate an artist's tracks based on the selected artist
  function populateArtistTracks() {
    const artistSelect = document.getElementById("id_artist");
    const artistTracksSelect = document.getElementById("artist_tracks");
  
    // Get the selected artist's ID from the dropdown
    const selectedArtistID = artistSelect.value;
  
    // Make an AJAX request to fetch the list of tracks for the selected artist from the server
    fetch(`/PHP/get_tracks.php?id=${selectedArtistID}`)
      .then((response) => response.json())
      .then((data) => {
        // Clear any existing options
        artistTracksSelect.innerHTML = "";
  
        // Populate the dropdown list with the selected artist's tracks
        data.forEach((track) => {
          const option = document.createElement("option");
          option.value = track.id;
          option.textContent = track.title;
          artistTracksSelect.appendChild(option);
        });
  
        // Enable the dropdown to make it selectable
        artistTracksSelect.disabled = false;
      })
      .catch((error) => console.error("Error fetching artist tracks:", error));
  }
  
  // Function to handle the form submission and add copyright information
  function addCopyright() {
    event.preventDefault();
  
    // Get the form data
    const formData = new FormData(document.getElementById('copyrightForm'));
  
    // Make an AJAX request to send the form data to the server
    fetch("PHP/insert_copyright.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => {
      // Display a success or error message based on the server response
      showMessage(data.message);
    })
    .catch((error) => console.error("Error adding copyright information:", error));
  }
  
  // Function to display a message in a message box
  function showMessage(message) {
    const messageBox = document.getElementById("messageBox");
    const messageContent = document.getElementById("messageContent");
    messageContent.textContent = message;
    messageBox.style.display = "block";
  }
  
  // Function to close the message box
  function closeMessageBox() {
    const messageBox = document.getElementById("messageBox");
    messageBox.style.display = "none";
  }
  
  // Call the function to populate the list of artists on page load
  populateArtistsList();
  
  // Listen for artist selection changes to populate the selected artist's tracks
  const artistSelect = document.getElementById("id_artist");
  artistSelect.addEventListener("change", populateArtistTracks);
  
  // Listen for form submission to add copyright information
  const submitBtn = document.querySelector(".submit-btn input[type='submit']");
  submitBtn.addEventListener("click", addCopyright);
  
  // Listen for the "OK" button click on the message box to close it
  const okButton = document.querySelector("#messageBox button");
  okButton.addEventListener("click", closeMessageBox);
  