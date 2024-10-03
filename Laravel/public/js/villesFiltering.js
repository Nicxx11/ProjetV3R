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