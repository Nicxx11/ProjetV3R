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
//Catégories RBQs toggler
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
//Régions Administratives toggler
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
//Villes toggler
document.querySelector('.villes_toggler').addEventListener('click', function() {
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



// FILTRES DE SERVICES & PRODUITS
document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('service_recherche');
    const itemsContainer = document.querySelector('.scrollable');
    let checkedStates = {};
    //let regionsFilter = ["Capitale-Nationale", "Laval", "Outaouais", "Côte-Nord", "Gaspésie-Îles-de-la-Madeleine", "Montréal", "Lanaudière", "Nord-du-Québec", "Mauricie", "Abitibi-Témiscamingue", "Montérégie", "Saguenay-Lac-Saint-Jean", "Chaudière-Appalaches", "Centre-du-Québec", "Bas-Saint-Laurent", "Laurentides", "Estrie"];
    let regionsFilter = [];

    async function fetchData() {
        try {
            const response = await fetch('/json/UNSPSC.json');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const jsonData = await response.json();
            renderItems(jsonData);
            setupSearch(jsonData);
            renderFournisseurs();
            renderServicesFournisseurs();
        } catch (error) {
            console.error('Failed to fetch data:', error);
        }
    }

    function renderItems(items){
        itemsContainer.innerHTML = '';

        const checkedItems = items.filter(item => checkedStates[item['Code UNSPSC']]);
        const uncheckedItems = items.filter(item => !checkedStates[item['Code UNSPSC']]);

        // Render checked items first
        checkedItems.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex align-items-center mx-4 produits_service_item';
            itemDiv.innerHTML = `
                <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="${item['Code UNSPSC']}" name="${item['Code UNSPSC']}" value="${item['Code UNSPSC']}" checked>
                <label class="form-check-label" for="${item['Code UNSPSC']}">${item['Code UNSPSC']} - ${item['Description du code UNSPSC']}</label>
            `;
            itemsContainer.appendChild(itemDiv);
        });

        // Render unchecked items
        uncheckedItems.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'd-flex align-items-center mx-4 produits_service_item';
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
            //console.log('Search query: ', query);

            const filteredItems = jsonData.filter(item => {
                const code = item['Code UNSPSC'].toString();
                const description = item['Description du code UNSPSC'];

                return  (description.toLowerCase().includes(query) || code.toLowerCase().includes(query));
            });

            renderItems(filteredItems);
            renderServicesFournisseurs();
        });
    }

    function renderFournisseurs(){
        const fournisseurs = window.Laravel.fournisseurs;
        const coordonnees = window.Laravel.coordonnees;
        const services = window.Laravel.services;

        const tableBody = document.querySelector('#fournisseurs-table tbody');
        tableBody.innerHTML = ``;

        // get all the checkboxes
        const produitsCheckboxes = document.querySelectorAll('.produits_service_item input');
        const checkedProduits = Array.from(produitsCheckboxes).filter(checkbox => checkbox.checked);
        const totalCheckedUNSPSC = checkedProduits.length;

        const villesCheckboxes = document.querySelectorAll('.villes_item input');
        const checkedVilles = Array.from(villesCheckboxes).filter(checkbox => checkbox.checked);
        const totalCheckedVilles = checkedVilles.length;


        fournisseurs.forEach(obj => {
            //for every unspsc
            const matchUNSPSC = coordonnees.find(coord => coord.No_Fournisseur === obj.id);
            const filteredServices = services.filter(service => service.No_Fournisseur === obj.id);
            const serviceUNSPSCs = new Set(filteredServices.map(service => service.UNSPSC));

            //how many of the services the fournisseur has
            const matchedCountUNSPSC = checkedProduits.filter(checkbox => {
                const checkboxUNSPSC = checkbox.value; // Assuming the checkbox value holds the UNSPSC
                return serviceUNSPSCs.has(checkboxUNSPSC);
            }).length;

            //for every ville
            const matchedCountVilles = checkedVilles.includes(obj.Ville) ? 1 : 0;

            if ((matchedCountUNSPSC > 0 || totalCheckedUNSPSC == 0) && (matchedCountVilles > 0 || totalCheckedVilles == 0)){
                const row = `
                    <tr>
                        <td class="pt-2">${obj.Etat_Demande}</td>
                        <td class="pt-2">${obj.Entreprise}</td>
                        <td class="pt-2">${matchUNSPSC ? matchUNSPSC.Ville : 'Introuvable'}</td>
                        <td class="pt-2">${matchedCountUNSPSC}/${totalCheckedUNSPSC}</td>
                    </tr>
                `
                tableBody.innerHTML += row;
            }
        });

    }

    function renderServicesFournisseurs(){
        const checkboxes = document.querySelectorAll('.produits_service_item input');
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(event) {
                checkedStates[event.target.value] = event.target.checked;
                
                renderFournisseurs();
                renderServicesFournisseurs();
            });
        });
    }

    function renderRegions(){
        const checkboxes = document.querySelectorAll('.region_administratives_item input');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(event) {
                if (event.target.checked){
                    if (!regionsFilter.includes(event.target.value)) {
                        regionsFilter.push(event.target.value);
                    }
                } else {
                    regionsFilter = regionsFilter.filter(item => item !== event.target.value)
                }
                renderVilles();
            });
        });

        //console.log('Selected regions:', regionsFilter);
        renderVilles();
    }

    function renderVilles(){
        // affichage des villes
        fetch('/json/villes.json') // Adjust the path as needed
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Filter the data based on the selected regions
            let filteredData;
            if (regionsFilter.length == 0) {
                filteredData = data;
            } else {
                //console.log('Selected regions:', regionsFilter);
                
                filteredData = data.filter(item => {
                    return regionsFilter.includes(item.region);
                });
            }

            // Process the filtered data and display it
            const container = document.getElementById('villes_container');
            container.innerHTML = '';

            //console.log(filteredData);

            filteredData.forEach(item => {

                // Create the container for each item
                const itemDiv = document.createElement('div');
                if (container.classList.contains('active'))
                    itemDiv.className = 'd-flex align-items-center mx-4 villes_item checkbox-input active';
                else
                    itemDiv.className = 'd-flex align-items-center mx-4 villes_item checkbox-input';

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

                //add the event to the checkbox TODO FOSJEFOJEFIEJFIORJGIRDJGIORDJGIORDJGRIODGJRIODGJRIODJGRIOJGRIODJGDGIJRDGRDIOGJRIODGJRIODGJRIDOJGRIODJGIORDJGRIODGJRIODJGRIODJGRIODGJRIODGJRIDOJGRIODJGIO
                //checkboxInput.addEventListener('change', renderFournisseurs());
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
    });

    }

    fetchData();
    renderRegions();
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