document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.contact-container').forEach(container => {
        const contacts = JSON.parse(container.dataset.contacts); // Parse contacts from data-attribute
        let currentIndex = 0;

        const leftArrow = container.querySelector('.left-arrow');
        const rightArrow = container.querySelector('.right-arrow');
        const display = container.querySelector('.contact-display');

        // Update the contact display
        function updateContactDisplay(index) {
            const contact = contacts[index];
            display.innerHTML = `
                <strong>${contact.Prenom} ${contact.Nom}</strong>, ${contact.Fonction}<br>
                <span class="contact-email">${contact.Courriel}</span><br>
                <strong>Téléphone:</strong> ${contact.TypeTelephone} ${contact.Numero}
                ${contact.Poste ? `(Poste ${contact.Poste})` : ''}
            `;

            // Enable/disable arrows based on index
            leftArrow.disabled = index === 0;
            rightArrow.disabled = index === contacts.length - 1;
        }

        // Event listeners for arrows
        leftArrow.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateContactDisplay(currentIndex);
            }
        });

        rightArrow.addEventListener('click', () => {
            if (currentIndex < contacts.length - 1) {
                currentIndex++;
                updateContactDisplay(currentIndex);
            }
        });
    });
});
