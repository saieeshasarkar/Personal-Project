<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoComplete GeoJSON Search</title>
</head>
<body>

<div class="ui-widget">
    <label for="search">Search: </label>
    <input id="search" list="searchOptions">
    <datalist id="searchOptions">
        <?php foreach ($data['features'] as $feature): ?>
            <option value="<?= htmlspecialchars($feature['properties']['urcne'] . ' ' . $feature['properties']['uscne'] . ' ' . $feature['properties']['uucne']) ?>">
        <?php endforeach; ?>
    </datalist>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#search').on('input', function() {
            var selectedValue = $(this).val();
            // When an option is selected from autocomplete, perform search
            $.ajax({
                url: 'search.php',
                type: 'POST',
                dataType: 'html',
                data: { uucne: selectedValue },
                success: function(response) {
                    $('#searchResults').html(response);
                }
            });
        });
    });
</script>

<div id="searchResults"></div>

</body>
</html>
