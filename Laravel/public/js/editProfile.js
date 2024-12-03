document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner le bouton et la div
    const ajoutBtn = document.getElementById('ajoutBtn');
    const ajoutContact = document.getElementById('ajoutContact');
    const noContact = document.getElementById('noContact');

    // Ajouter un événement de clic au bouton
    ajoutBtn.addEventListener('click', function() {
            ajoutContact.style.display = 'block'; // faire apparaitre la creation de contact
            ajoutBtn.style.display = 'None'; // Cacher le bouton
            noContact.style.visibility = 'None'; // Cacher message d'aucun contact
    });



    // Pour le changement d'état avec la raison
    document.getElementById('Etat_Demande_Select').addEventListener('change', function () {
        toggleRaisonRefusInput(this.value);
    });

    function toggleRaisonRefusInput(selectedValue) {
        var container = document.getElementById('Etat_Demande_Container');
        var existingInput = container.querySelector('input[name="raisonRefus"]');
        var inputHtml = '<input type="text" name="raisonRefus" placeholder="Raison du refus">';

        if (selectedValue === 'Refusée') {
            if (!existingInput) {
                var inputElement = document.createElement('div');
                inputElement.innerHTML = inputHtml;
                container.appendChild(inputElement.firstChild);
            }
        } else {
            if (existingInput) {
                existingInput.remove();
            }
        }
    }

    toggleRaisonRefusInput(document.getElementById('Etat_Demande_Select').value);
});
