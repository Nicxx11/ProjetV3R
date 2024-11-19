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
});

