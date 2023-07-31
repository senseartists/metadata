 function addLabel() {
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('PHP/insert_label.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const message = data.success ? "Label ajouté avec succès." : "Erreur lors de l'ajout de l'Label.";
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
        addLabel();
    });
