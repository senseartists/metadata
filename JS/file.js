const MAX_FILES = 5;

document.addEventListener('DOMContentLoaded', () => {
  const addFileButton = document.getElementById('addFileButton');
  const fileInputsContainer = document.getElementById('fileInputs');
  let fileCount = 1;

  addFileButton.addEventListener('click', () => {
    if (fileCount < MAX_FILES) {
      fileCount++;
      const newFileInput = document.createElement('div');
      newFileInput.innerHTML = `
        <label for="file${fileCount}">File ${fileCount}:</label>
        <input type="file" name="file${fileCount}" id="file${fileCount}" required>
      `;
      fileInputsContainer.appendChild(newFileInput);
    } else {
      alert('You can upload a maximum of 5 files.');
    }
  });
});
