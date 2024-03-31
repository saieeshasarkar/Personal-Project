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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.min.css">
</head>
<body>

<div class="ui-widget">
    <label for="search">Search: </label>
    <input id="search" class="awesomplete" data-list="<?php echo htmlspecialchars(json_encode(array_merge($uucneValues, $urcneValues, $uscneValues))); ?>">
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.min.js" defer></script>
<script>
    var input = document.getElementById("search");
    new Awesomplete(input, {
        minChars: 2
    });

    input.addEventListener("awesomplete-selectcomplete", function(e) {
        var selectedValue = e.target.value;
        // When an option is selected from autocomplete, perform search
        $.ajax({
            url: 'search.php',
            type: 'POST',
            dataType: 'html',
            data: { uucne: selectedValue },
            success: function(response) {
                document.getElementById('searchResults').innerHTML = response;
            }
        });
    });
</script>

<div id="searchResults"></div>

</body>
</html>
