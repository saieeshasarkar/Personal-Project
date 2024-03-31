<?php

// Read GeoJSON file
$jsonString = file_get_contents('data/village.geojson');

// Decode JSON string into PHP array
$data = json_decode($jsonString, true);

// Function to search for a feature by property
function searchByProperty($data, $propertyName, $propertyValue) {
    $result = array();
    foreach ($data['features'] as $feature) {
        if (strpos($feature['properties']['urcne'] . ' ' . $feature['properties']['uscne'] . ' ' . $feature['properties']['uucne'], $propertyValue) !== false) {
            // Include all properties of the feature
            $result[] = $feature['properties'];
        }
    }
    return $result;
}

// Get the selected value from AJAX request
$searchValue = $_POST['uucne'];

// Perform search
$searchResults = searchByProperty($data, 'uucne', $searchValue);

// Output search results
if (!empty($searchResults)) {
    echo "<ul>";
    foreach ($searchResults as $result) {
        echo "<li>{$result['urcne']} - {$result['uscne']} - {$result['uucne']}</li>";
    }
    echo "</ul>";
} else {
    echo "No results found for '$searchValue'.";
}

?>
