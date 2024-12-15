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
        data: data.map(province => [
            `<span class="tree-indicator">+</span> ${province.name}`,
            province.type,
            province.population
        ]),
        columns: [
            { title: "Name" },
            { title: "Type" },
            { title: "Population" }
        ],
        order: [[1, "asc"]],
        createdRow: function (row, data, dataIndex) {
            $(row).attr("data-type", "province").attr("data-index", dataIndex);
        }
    });

    // Expand/collapse provinces
    $('#treeTable tbody').on('click', 'tr[data-type="province"] .tree-indicator', function () {
        const tr = $(this).closest('tr');
        const row = table.row(tr);
        const provinceIndex = tr.data('index');

        if (tr.hasClass('expanded')) {
            // Collapse the province
            row.child.hide();
            tr.removeClass('expanded');
            $(this).text('+');
        } else {
            // Expand the province
            const province = data[provinceIndex];
            const districtsHtml = generateChildTable(province.districts, provinceIndex, "district");
            row.child(districtsHtml).show();
            tr.addClass('expanded');
            $(this).text('-');
        }
    });

    // Expand/collapse districts
    $('#treeTable').on('click', 'tr[data-type="district"] .tree-indicator', function () {
        const tr = $(this).closest('tr');
        const provinceIndex = tr.data('parent-index');
        const districtIndex = tr.data('index');

        if (tr.hasClass('expanded')) {
            // Collapse the district
            tr.next('.child-row').remove();
            tr.removeClass('expanded');
            $(this).text('+');
        } else {
            // Expand the district
            const province = data[provinceIndex];
            const district = province.districts[districtIndex];

            const villagesHtml = generateVillageRows(district.villages);
            const villageRow = `<tr class="child-row"><td colspan="3">${villagesHtml}</td></tr>`;
            tr.after(villageRow);
            tr.addClass('expanded');
            $(this).text('-');
        }
    });

    // Generate child rows for districts
    function generateChildTable(items, parentIndex, type) {
        let html = '<table class="child-table">';
        html += "<thead><tr><th>Name</th><th>Type</th><th>Population</th></tr></thead><tbody>";
        items.forEach((item, index) => {
            html += `<tr data-type="${type}" data-parent-index="${parentIndex}" data-index="${index}">
                        <td><span class="tree-indicator">+</span> ${item.name}</td>
                        <td>${item.type}</td>
                        <td>${item.population}</td>
                     </tr>`;
        });
        html += "</tbody></table>";
        return html;
    }

    // Generate rows for villages (no tree-indicator here)
    function generateVillageRows(villages) {
        let html = '<table class="child-table">';
        html += "<thead><tr><th>Name</th><th>Type</th><th>Population</th></tr></thead><tbody>";
        villages.forEach(village => {
            html += `<tr>
                        <td>${village.name}</td>
                        <td>${village.type}</td>
                        <td>${village.population}</td>
                     </tr>`;
        });
        html += "</tbody></table>";
        return html;
    }
});