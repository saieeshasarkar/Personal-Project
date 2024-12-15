// Sample hierarchical data
const data = [
    {
        province: "Vientiane",
        districts: [
            {
                district: "Chanthabuly",
                villages: [
                    { name: "Village A", number: 120 },
                    { name: "Village B", number: 80 }
                ]
            },
            {
                district: "Sikhottabong",
                villages: [
                    { name: "Village C", number: 60 },
                    { name: "Village D", number: 50 }
                ]
            }
        ]
    },
    {
        province: "Luang Prabang",
        districts: [
            {
                district: "Luang Prabang",
                villages: [
                    { name: "Village E", number: 100 },
                    { name: "Village F", number: 70 }
                ]
            }
        ]
    }
];

// Function to populate table dynamically
function populateTable(tableId, data) {
    const tableBody = document.querySelector(`${tableId} tbody`);

    data.forEach((province) => {
        // Add province row
        const provinceRow = document.createElement("tr");
        provinceRow.innerHTML = `
            <td><strong>${province.province}</strong></td>
            <td>Province</td>
            <td></td>
