document.querySelector('.produits_services').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.produits_service_item');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    })
});

document.querySelector('.etat').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.etat_item');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    })
});