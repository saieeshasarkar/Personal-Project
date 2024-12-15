import DataTable from 'https://cdn.datatables.net/1.13.6/js/dataTables.dataTables.min.js';

// Sample Data
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

// Initialize the DataTable
const table = new DataTable('#treeTable', {
    data: flattenData(data),
    columns: [
        { data: 'name', title: 'Name' },
        { data: 'type', title: 'Type' },
        { data: 'number', title: 'Number' }
    ]
});

// Flatten hierarchical data into rows
function flattenData(data) {
    const rows = [];
    data.forEach((province, provinceIndex) => {
        rows.push({
            name: province.province,
            type: "Province",
            number: null,
            childData: province.districts.map((district, districtIndex) => ({
                name: district.district,
                type: "District",
                number: null,
                childData: district.villages.map((village) => ({
                    name: village.name,
                    type: "Village",
                    number: village.number
                }))
            }))
        });
    });
    return rows;
}

// Add event listeners for expandable rows
document.querySelector('#treeTable tbody').addEventListener('click', (event) => {
    const tr = event.target.closest('tr');
    const row = table.row(tr);

    if (row.data() && row.data().childData) {
        if (row.child.isShown()) {
            // Collapse the row
            row.child.hide();
            tr.classList.remove('expanded');
            tr.classList.add('collapsed');
        } else {
            // Expand the row
            const childTable = generateChildTable(row.data().childData);
            row.child(childTable).show();
            tr.classList.remove('collapsed');
            tr.classList.add('expanded');
        }
    }
});

// Generate child table rows dynamically
function generateChildTable(childData) {
    let childHTML = '<table class="display">';
    childData.forEach((child) => {
        childHTML += `<tr>
            <td class="${child.childData ? 'collapsed' : ''}">${child.name}</td>
            <td>${child.type}</td>
            <td>${child.number || ''}</td>
        </tr>`;
        if (child.childData) {
            childHTML += generateChildTable(child.childData);
        }
    });
    childHTML += '</table>';
    return childHTML;
}
