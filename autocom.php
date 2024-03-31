<?php

// Read GeoJSON file
$jsonString = file_get_contents('data/village.geojson');

// Decode JSON string into PHP array
$data = json_decode($jsonString, true);

// Get all unique values for 'uucne', 'urcne', and 'uscne' properties
$uucneValues = array_unique(array_column($data['features'], 'properties')['uucne']);
$urcneValues = array_unique(array_column($data['features'], 'properties')['urcne']);
$uscneValues = array_unique(array_column($data['features'], 'properties')['uscne']);

?>
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
        <?php foreach (array_merge($uucneValues, $urcneValues, $uscneValues) as $value): ?>
            <option value="<?= htmlspecialchars($value) ?>">
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
