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


    document.getElementById('Province').addEventListener('change', function(){
        if(document.getElementById('Province').value === 'Québec'){
            document.getElementById('VilleContainer').style.display = 'block';
            document.getElementById('VilleContainerText').style.display = 'none';
        } else {
            document.getElementById('VilleContainer').style.display = 'none';
            document.getElementById('VilleContainerText').style.display = 'block';
        }
    });


    function renderVilles(){
        fetch('/json/villes.json') // Adjust the path as needed
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Process the filtered data and display it
            const container = document.getElementById('Ville');
            container.innerHTML = '';

            //console.log(filteredData);

            data.forEach(item => {
                // Create the checkbox input
                const selectInput = document.createElement('option');
                selectInput.id = item.ville; // Use regadm as the ID
                selectInput.name = item.ville; // Use regadm as the name
                selectInput.value = item.ville; // Use regadm as the value
                selectInput.innerHTML = item.ville;

                container.appendChild(selectInput);
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    renderVilles();
});
