// List of countries
const countries = [
    "Afghanistan", "Australia", "Brazil", "Canada", "China", "Egypt",
    "France", "Germany", "India", "Italy", "Japan", "Mexico",
    "Russia", "South Korea", "Spain", "Switzerland", "Thailand",
    "United Arab Emirates", "United Kingdom", "USA"
];

// Function to populate a country select element
function populateCountrySelect(selectId) {
    const countrySelect = document.getElementById(selectId);

    for (const country of countries) {
        const option = document.createElement("option");
        option.value = country;
        option.textContent = country;
        countrySelect.appendChild(option);
    }
}
