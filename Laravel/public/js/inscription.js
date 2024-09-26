document.addEventListener('DOMContentLoaded', function() {
    const motDePasseInput = document.getElementById('MotDePasse');
    const popup = document.getElementById('exigences-motdepasse');

    motDePasseInput.addEventListener('focus', function() {
        popup.style.display = 'block';
    });

    document.addEventListener('click', function(event) {
        const isClickInside = motDePasseInput.contains(event.target) || popup.contains(event.target);
        if (!isClickInside) {
            popup.style.display = 'none';
        }
    });

    motDePasseInput.addEventListener('blur', function() {
        setTimeout(() => {
            popup.style.display = 'none';
        }, 100);
    });
});
