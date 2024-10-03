document.addEventListener('DOMContentLoaded', function() {
    const motDePasseInput = document.getElementById('MotDePasse');
    const popup = document.getElementById('exigences-motdepasse');

    function positionPopup() {
        const rect = motDePasseInput.getBoundingClientRect();
        const offsetX = window.innerWidth * 0.005; // Ajuste le pourcentage pour le décalage

        // Positionne le pop-up juste à droite de l'input avec un décalage responsive
        popup.style.left = `${rect.right + window.scrollX + offsetX}px`; // Décalage vers la droite
        popup.style.top = `${rect.bottom + window.scrollY}px`; // Aligne avec le haut de l'input

        popup.style.display = 'block';
    }

    motDePasseInput.addEventListener('focus', positionPopup);

    document.addEventListener('click', function(event) {
        const isClickInside = motDePasseInput.contains(event.target) || popup.contains(event.target);
        if (!isClickInside) {
            popup.style.display = 'none';
        }
    });

    motDePasseInput.addEventListener('blur', function() {
        setTimeout(() => {
            if (!popup.contains(document.activeElement)) {
                popup.style.display = 'none';
            }
        }, 100);
    });

    // Repositionner le pop-up lors du redimensionnement de la fenêtre
    window.addEventListener('resize', positionPopup);
});
