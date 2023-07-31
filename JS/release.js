// Function to fetch labels from the server and populate the "Label" select element
function populateLabels() {
  // Send an AJAX request to the server to get the labels data
  fetch('PHP/get_labels.php') // Assuming the server endpoint to get labels is "get_labels.php"
    .then(response => response.json())
    .then(data => {
      // Once data is fetched, populate the "Label" select element
      const selectElement = document.getElementById('id_label');
      selectElement.innerHTML = ''; // Clear existing options

      // Add options for each label
      data.forEach(label => {
        const option = document.createElement('option');
        option.value = label.id; // Assuming the label ID is stored in the "id" property
        option.textContent = label.name; // Assuming the label name is stored in the "name" property
        selectElement.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching labels:', error);
    });
}

// Call the populateLabels function when the page is fully loaded
document.addEventListener('DOMContentLoaded', function () {
  populateLabels();
});