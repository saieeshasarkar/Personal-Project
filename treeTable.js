$(document).ready(function () {
    // Sample hierarchical data
    const data = [
        {
            name: "Vientiane Province",
            type: "Province",
            population: 820000,
            districts: [
                {
                    name: "Chanthabuly District",
                    type: "District",
                    population: 200000,
                    villages: [
                        { name: "Village A", type: "Village", population: 12000 },
                        { name: "Village B", type: "Village", population: 8000 }
                    ]
                },
                {
                    name: "Sikhottabong District",
                    type: "District",
                    population: 180000,
                    villages: [
                        { name: "Village C", type: "Village", population: 15000 },
                        { name: "Village D", type: "Village", population: 9000 }
                    ]
                }
            ]
        },
        {
            name: "Luang Prabang Province",
            type: "Province",
            population: 460000,
            districts: [
                {
                    name: "Luang Prabang District",
                    type: "District",
                    population: 220000,
                    villages: [
                        { name: "Village E", type: "Village", population: 7000 },
                        { name: "Village F", type: "Village", population: 5000 }
                    ]
                }
            ]
        }
    ];

    // Initialize DataTable
    const table = $('#treeTable').DataTable({
        data: data.map((province, index) => [
            '<span class="tree-indicator">+</span>',
            province.name,
            province.type,
            province.population
        ]),
        columns: [
            { title: "", className: "details-control", orderable: false, data: null, defaultContent: "" },
            { title: "Name" },
            { title: "Type" },
            { title: "Population" }
        ],
        order: [[1, "asc"]]
    });

    // Add click event for expanding rows
    $('#treeTable tbody').on('click', 'td.details-control', function () {
        const tr = $(this).closest('tr');
        const row = table.row(tr);

        if (row.child.isShown()) {
            // Row is already open, close it
            row.child.hide();
            tr.removeClass('details');
        } else {
            // Row is closed, open it
            const province = data[row.index()];
            const districtsHtml = generateChildTable(province.districts, row.index());
            row.child(districtsHtml).show();
            tr.addClass('details');
        }
    });

    // Generate child rows HTML
    function generateChildTable(items, parentIndex) {
        if (!items || items.length === 0) return "No data available";

        let html = '<table class="child-table">';
        html += "<thead><tr><th>Name</th><th>Type</th><th>Population</th></tr></thead><tbody>";
        items.forEach((item, index) => {
            html += `<tr class="district-row" data-parent-index="${parentIndex}" data-index="${index}">
                        <td><span class="tree-indicator">+</span> ${item.name}</td>
                        <td>${item.type}</td>
                        <td>${item.population}</td>
                     </tr>`;
        });
        html += "</tbody></table>";
        return html;
    }

    // Handle district row expansion
    $('#treeTable').on('click', '.district-row', function () {
        const districtRow = $(this);
        const provinceIndex = districtRow.data('parent-index');
        const districtIndex = districtRow.data('index');

        const province = data[provinceIndex];
        const district = province.districts[districtIndex];

        if (districtRow.hasClass('expanded')) {
            // Already expanded, collapse it
            districtRow.removeClass('expanded');
            districtRow.find('span.tree-indicator').text('+');
            districtRow.next('tr').hide();
        } else {
            // Expand the district row to show villages
            districtRow.addClass('expanded');
            districtRow.find('span.tree-indicator').text('-');

            const villagesHtml = generateChildTable(district.villages);
            const villageRow = $('<tr>').addClass('village-row').html(`<td colspan="3">${villagesHtml}</td>`);
            districtRow.after(villageRow);
        }
    });
});