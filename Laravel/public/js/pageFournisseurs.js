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
    const searchBar = document.getElementsByClassName('service_recherche');
    searchBar.value = '';

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

// Define the IDs you want to filter by
const regionsFilter = ["Capitale-Nationale", "Laval", "Outaouais", "Côte-Nord", "Gaspésie-Îles-de-la-Madeleine", "Montréal", "Lanaudière", "Nord-du-Québec", "Mauricie", "Abitibi-Témiscamingue", "Montérégie", "Saguenay-Lac-Saint-Jean", "Chaudière-Appalaches", "Centre-du-Québec", "Bas-Saint-Laurent", "Laurentides", "Estrie"];

// Fetch the JSON file
fetch('/json/villes.json') // Adjust the path as needed
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Filter the data based on the specified IDs
        const filteredData = data.filter(item => regionsFilter.includes(item.region));

        // Process the filtered data and display it
        const container = document.getElementById('villes_container');
        filteredData.forEach(item => {

            // Create the container for each item
            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex align-items-center mx-4 villes_item checkbox-input active';

            // Create the checkbox input
            const checkboxInput = document.createElement('input');
            checkboxInput.type = 'checkbox';
            checkboxInput.className = 'form-check-input me-2 filter_input';
            checkboxInput.id = item.ville; // Use regadm as the ID
            checkboxInput.name = item.ville; // Use regadm as the name
            checkboxInput.value = item.ville; // Use regadm as the value

            // Create the label for the checkbox
            const label = document.createElement('label');
            label.className = 'form-check-label';
            label.htmlFor = item.ville; // Link the label to the checkbox
            label.textContent = item.ville; // Set the text to regadm value

            // Append the input and label to the itemDiv
            itemDiv.appendChild(checkboxInput);
            itemDiv.appendChild(label);

            // Append the itemDiv to the container
            container.appendChild(itemDiv);
        });
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
});

document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('service_recherche');
    const itemsContainer = document.querySelector('.scrollable');

    async function fetchData() {
        try {
            const response = await fetch('/json/UNSPSC.json'); // Update with the correct path to your JSON file
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const jsonData = await response.json();
            renderItems(jsonData);
            setupSearch(jsonData);
        } catch (error) {
            console.error('Failed to fetch data:', error);
        }
    }

    function renderItems(items){
        itemsContainer.innerHTML = '';
        items.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex align-items-center mx-4 produits_service_item active';
            itemDiv.innerHTML = `
                <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="${item['Code UNSPSC']}" name="${item['Code UNSPSC']}" value="${item['Code UNSPSC']}">
                <label class="form-check-label" for="${item['Code UNSPSC']}">${item['Code UNSPSC']} - ${item['Description du code UNSPSC']}</label>
            `;
            itemsContainer.appendChild(itemDiv);
        });
    }

    function setupSearch(jsonData){
        searchInput.addEventListener('input', function(){
            const query = searchInput.value.toLowerCase();
            console.log('Search query: ', query);

            if (!query){
                renderItems(jsonData);
                return;
            }

            const filteredItems = jsonData.filter(item => {
                const code = item['Code UNSPSC'].toString();
                const description = item['Description du code UNSPSC'];

                return  (description.toLowerCase().includes(query) || code.toLowerCase().includes(query));
            });

            renderItems(filteredItems)
        });
    }

    fetchData();
});