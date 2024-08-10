<?php
require 'dbconfig.php';
$fetchdata = $database->getReference('New')->getValue();
    
 $code = [];
 $groupedData = [];
    foreach($fetchdata as $key => $value)
    {
    
      $code[] = $value['address'];
      
    }

$jsonData = json_encode($code);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
// Use the PHP variable in JavaScript
let data = JSON.parse('<?php echo $jsonData; ?>');
let result = {};
// let counts = {};
let counts = {total:0};
data.forEach(item => {
    let [key1, key2, value] = item.split("-");
    if (!result[key1]) {
        result[key1] = {};
		counts[key1] = { total: 0 };
    }
    if (!result[key1][key2]) {
        result[key1][key2] = [];
		counts[key1][key2] = { total: 0, unique: {} };
    }
    if (!counts[key1][key2].unique[value]) {
        counts[key1][key2].unique[value] = 0;
    }
    result[key1][key2].push(value);
	counts[key1][key2].unique[value]++;
    counts[key1][key2].total++;
    counts[key1].total++;
    counts.total++;
});

console.log("Counts:", counts);

function countMembers(data, key, subKey) {
    if (data.hasOwnProperty(key)) {
        if (subKey && data[key].hasOwnProperty(subKey)) {
            return data[key][subKey].length;
        } else {
            let count = 0;
            for (let subKey in data[key]) {
                count += data[key][subKey].length;
            }
            return count;
        }
    }
    return 0;
}

console.log(result);
console.log(countMembers(data, '1', '101'));  // Outputs: 2
</script>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Mobile tutorial - Leaflet</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
	
	<script type="text/javascript" src="scripts/leaflet.ajax.js"></script>
	
	<script src="scripts/spin.js"></script>
	<script src="scripts/leaflet.spin.js"></script>
	
	
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/intro.min.js"></script>
	
	<link rel="stylesheet" href="style/leaflet.groupedlayercontrol.css" />
	<script type="text/javascript" src="scripts/leaflet.groupedlayercontrol.js"></script>
	
	<script type="text/javascript" src="scripts/leaflet-geojson-selector.js"></script>
		
	<link rel="stylesheet" href="style/leaflet.zoomhome.css"/>
	<script src="scripts/leaflet.zoomhome.min.js"></script>
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css"/>
	<script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
	

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

	<style>body { padding: 0; margin: 0; } #map { height: 100%; width: 100vw; }</style>
</head>
<body>

<div id='map'></div>
<script type="text/javascript" src="mapscript.js"></script>
<script>
	// const map = L.map('map').fitWorld();

	// const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	// 	maxZoom: 19,
	// 	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	// }).addTo(map);

	// function onLocationFound(e) {
	// 	const radius = e.accuracy / 2;

	// 	const locationMarker = L.marker(e.latlng).addTo(map)
	// 		.bindPopup(`You are within ${radius} meters from this point`).openPopup();

	// 	const locationCircle = L.circle(e.latlng, radius).addTo(map);
	// }

	// function onLocationError(e) {
	// 	alert(e.message);
	// }

	// map.on('locationfound', onLocationFound);
	// map.on('locationerror', onLocationError);

	// map.locate({setView: true, maxZoom: 16});
</script>



</body>
</html>
