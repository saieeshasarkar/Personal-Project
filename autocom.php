<?php

// Read GeoJSON file
$jsonString = file_get_contents('data/village.geojson');

// Decode JSON string into PHP array
$data = json_decode($jsonString, true);

// Function to search for a feature by property
function searchByProperty($data, $propertyName, $propertyValue) {
    $result = array();
    foreach ($data['features'] as $feature) {
        if (isset($feature['properties'][$propertyName]) && stripos($feature['properties'][$propertyName], $propertyValue) !== false) {
            // Include all properties of the feature
            $result[] = $feature['properties'];
        }
    }
    return $result;
}

// Get all unique values for 'uucne' property
$uucneValues = array_unique(array_column($data['features'], 'properties')['uucne']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoComplete GeoJSON Search</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

<div class="ui-widget">
    <label for="search">Search: </label>
    <input id="search">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        var availableTags = <?php echo json_encode($uucneValues); ?>;
        $("#search").autocomplete({
            source: availableTags,
            minLength: 2,
            select: function(event, ui) {
                // When an option is selected from autocomplete, perform search
                $.ajax({
                    url: 'search.php',
                    type: 'POST',
                    dataType: 'html',
                    data: { uucne: ui.item.value },
                    success: function(response) {
                        $('#searchResults').html(response);
                    }
                });
            }
        });
    });
</script>

<div id="searchResults"></div>

</body>
</html>
