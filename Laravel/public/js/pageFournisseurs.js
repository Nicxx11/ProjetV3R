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
    //toutes les régions: ["Capitale-Nationale", "Laval", "Outaouais", "Côte-Nord", "Gaspésie-Îles-de-la-Madeleine", "Montréal", "Lanaudière", "Nord-du-Québec", "Mauricie", "Abitibi-Témiscamingue", "Montérégie", "Saguenay-Lac-Saint-Jean", "Chaudière-Appalaches", "Centre-du-Québec", "Bas-Saint-Laurent", "Laurentides", "Estrie"];
    let regionsFilter = [];
    let selectedFournisseurs = [];

    //setup details opener button
    document.getElementById('openDetailsFournisseurs').addEventListener('click', openFournisseursDetails);


    async function generateSHA1Hash(id) {
        const encoder = new TextEncoder();
        const data = encoder.encode(id);
        const hashBuffer = await crypto.subtle.digest('SHA-1', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        return hashHex;
    }

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
        });
    }

    function fournisseurDetailsSetup(){
        console.log('fournisseurDetailsSetup');
        details = document.querySelectorAll('.fournisseurOpenCheckbox');
        console.log(details);
        details.forEach(detail => {
            detail.addEventListener('change', function(){
                const row = detail.closest('tr');
                const id = row.querySelector('.fournisseur_id_td').textContent.trim();

                if (detail.checked) {
                    if (!selectedFournisseurs.includes(id)) {
                        selectedFournisseurs.push(id); // Add the ID if it's not already in the array
                    }
                } else {
                    // If the checkbox is unchecked, remove the ID from the array
                    const index = selectedFournisseurs.indexOf(id);
                    if (index > -1) {
                        selectedFournisseurs.splice(index, 1); // Remove the ID from the array
                    }
                }
                console.log(selectedFournisseurs);
            });
        })
    }

    //search bar
    document.querySelector('.recherche_fournisseur').addEventListener('input', function(){
        renderFournisseurs(''+this.value);
    });


    function renderFournisseurs(searchedText=''){
        

        const fournisseurs = window.Laravel.fournisseurs;
        const coordonnees = window.Laravel.coordonnees;
        const services = window.Laravel.services;
        const licences_rbq = window.Laravel.licences_rbq;

        const tableBody = document.querySelector('#fournisseurs-table tbody');
        tableBody.innerHTML = ``;
        

        // services filtering
        const produitsCheckboxes = document.querySelectorAll('.produits_service_item input');
        const checkedProduits = Array.from(produitsCheckboxes).filter(checkbox => checkbox.checked);
        const totalCheckedUNSPSC = checkedProduits.length;

        // Villes filtering
        const villesCheckboxes = document.querySelectorAll('.villes_item input');
        const checkedVilles = Array.from(villesCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.name);
        const totalCheckedVilles = checkedVilles.length;

        // Etat Filtering
        const etatCheckboxes = document.querySelectorAll('.etat_item input');
        const checkedEtats = Array.from(etatCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);
        const totalCheckedEtats = checkedEtats.length;

        // rbq filtering
        const rbqCheckboxes = document.querySelectorAll('.categories_rbqs_item input');
        const checkedRBQs = Array.from(rbqCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value)
            .map(checkbox => checkbox.match(/^\s*[\d.]+/)[0]);
        const totalCheckedRBQs = checkedRBQs.length;

        const renderPromises = fournisseurs.map(obj => {
            const matchUNSPSC = coordonnees.find(coord => coord.No_Fournisseur === obj.id);
            const filteredServices = services.filter(service => service.No_Fournisseur === obj.id);
            const serviceUNSPSCs = new Set(filteredServices.map(service => service.UNSPSC));
    
            const rbqs_fournisseur = new Set(licences_rbq.filter(licence => licence.No_Fournisseur === obj.id).map(licence => licence.Code_Sous_Categorie));
            const matchedCountRBQs = checkedRBQs.filter(checkbox => rbqs_fournisseur.has(checkbox)).length;
            const matchedCountUNSPSC = checkedProduits.filter(checkbox => serviceUNSPSCs.has(checkbox.value)).length;
            const matchedCountVilles = checkedVilles.includes(matchUNSPSC?.Ville) ? 1 : 0;
            const matchedCountEtat = checkedEtats.includes(obj.Etat_Demande) ? 1 : 0;
    
            if ((matchedCountUNSPSC > 0 || totalCheckedUNSPSC === 0) &&
                (matchedCountVilles > 0 || totalCheckedVilles === 0) &&
                (matchedCountEtat > 0 || totalCheckedEtats === 0) &&
                (matchedCountRBQs > 0 || totalCheckedRBQs === 0) &&
                (obj.Entreprise.toLowerCase().includes(searchedText.toLowerCase()) || searchedText === '')) {
                return generateSHA1Hash(obj.id).then(hashValue => {
                    const row = `
                        <tr>
                            <td class="pt-2 fournisseur_id_td" style="display:none;">${obj.id}</td>
                            <td class="pt-2">${obj.Etat_Demande}</td>
                            <td class="pt-2">${obj.Entreprise}</td>
                            <td class="pt-2">${matchUNSPSC ? matchUNSPSC.Ville : 'Introuvable'}</td>
                            <td class="pt-2" style="text-align: center; vertical-align: middle;">${matchedCountUNSPSC}/${totalCheckedUNSPSC}</td>
                            <td class="pt-2" style="text-align: center; vertical-align: middle;">${matchedCountRBQs}/${totalCheckedRBQs}</td>
                            <td class="pt-2" style="text-align: center; vertical-align: middle;"><input type="checkbox" class="fournisseurOpenCheckbox" style="transform: scale(2); -webkit-transform: scale(2);"></td>
                            <td class="pt-2" style="text-align: center; vertical-align: middle;"><a href="/Utilisateur/Fournisseurs/${hashValue}"><button type="button">Ouvrir</button></a></td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            }
            return Promise.resolve(); // If the fournisseur doesn't match, resolve immediately
        });
        
        Promise.all(renderPromises).then(() => {
            fournisseurDetailsSetup();
        }).catch(error => {
            console.error("Error rendering fournisseurs:", error);
        });

    }

    function renderServicesFournisseurs(){
        const checkboxes = document.querySelectorAll('.produits_service_item input');
    
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(event) {
                checkedStates[event.target.value] = event.target.checked;
                
                renderFournisseurs();
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

                //add event to render the new list
                checkboxInput.addEventListener('change', function(){
                    renderFournisseurs();
                });
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
    });

    }

    function etat_filtering(){
        etats = document.querySelectorAll('.etat_item input');
        etats.forEach(etat => {
            etat.addEventListener('change', function(){
                renderFournisseurs();
            });
        });
    }

    function rbq_filtering(){
        rbqs = document.querySelectorAll('.categories_rbqs_item input');
        rbqs.forEach(rbq => {
            rbq.addEventListener('change', function(){
                renderFournisseurs();
            });
        })
    }

    

    function openFournisseursDetails(){
        console.log('Clicked!');
        const selectedIds = selectedFournisseurs.join(',');

        const newUrl = `/Fournisseurs/Details/${selectedIds}`;

        window.location.href = newUrl;
    }

    fetchData();
    renderRegions();
    etat_filtering();
    rbq_filtering();
});

//effacer les filtres
document.querySelector('.effacer-filtres').addEventListener('click', function() {
    // Uncheck all checkboxes
    const checkboxes = document.querySelectorAll('.checkbox-input');
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
    checkedCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // Clear all text inputs
    const textInputs = document.querySelectorAll('.text-input');
    textInputs.forEach(input => {
        input.value = '';
    });

    renderFournisseurs();
});
