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
        data: data.map((province) => [
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
            const districtsHtml = generateChildTable(province.districts);
            row.child(districtsHtml).show();
            tr.addClass('details');

            // Handle district clicks
            tr.next('tr').find('.details-control').on('click', function () {
                const districtRow = $(this).closest('tr');
                const districtIndex = districtRow.data('index');
                const district = province.districts[districtIndex];

                if (districtRow.child.isShown()) {
                    districtRow.child.hide();
                } else {
                    const villagesHtml = generateChildTable(district.villages);
                    districtRow.child(villagesHtml).show();
                }
            });
        }
    });

    // Generate child rows HTML
    function generateChildTable(items) {
        if (!items || items.length === 0) return "No data available";

        let html = '<table class="child-table">';
        html += "<thead><tr><th>Name</th><th>Type</th><th>Population</th></tr></thead><tbody>";
        items.forEach((item, index) => {
            html += `<tr data-index="${index}">
                        <td>${item.name}</td>
                        <td>${item.type}</td>
                        <td>${item.population}</td>
                     </tr>`;
        });
        html += "</tbody></table>";
        return html;
    }
});
