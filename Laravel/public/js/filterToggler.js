// État
document.querySelector('.etat').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.etat_item');
    const icon = document.querySelector('.etat i');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    });

    if(icon.classList.contains('fa-chevron-down')){
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
    }
});

//Produits & Services
document.querySelector('.produits_services').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.produits_service_item');
    const icon = document.querySelector('.produits_services i');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    });

    if(icon.classList.contains('fa-chevron-down')){
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
    }
});


//Catégories RBQs
document.querySelector('.categories_rbqs').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.categories_rbqs_item');
    const icon = document.querySelector('.categories_rbqs i');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    });

    if(icon.classList.contains('fa-chevron-down')){
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
    }
});

//Régions Administratives
document.querySelector('.region_administratives').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.region_administratives_item');
    const icon = document.querySelector('.region_administratives i');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    });

    if(icon.classList.contains('fa-chevron-down')){
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
    }
});

//Régions Administratives
document.querySelector('.villes').addEventListener('click', function() {
    const targetElements = document.querySelectorAll('.villes_item');
    const icon = document.querySelector('.villes i');

    targetElements.forEach(element => {
        element.classList.toggle('active');
    });

    if(icon.classList.contains('fa-chevron-down')){
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    } else {
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
    }
});

//effacer les filtres
document.querySelector('.effacer-filtres').addEventListener('click', function() {
    // Uncheck all checkboxes
    const checkboxes = document.querySelectorAll('.checkbox-input');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // Clear all text inputs
    const textInputs = document.querySelectorAll('.text-input');
    textInputs.forEach(input => {
        input.value = '';
    });
});