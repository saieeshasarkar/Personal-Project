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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--     <meta name="viewport" content="width=1024, user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
	
	<link rel="stylesheet" href="StyleMap.css" />
	 
	<title>Dengue in Lao PDR </title>
	
</head>
	
<body>
    <div id="map"></div>
	<script type="text/javascript" src="script.js"></script>
	
         
</body>
<script>
// Use the PHP variable in JavaScript
let data = JSON.parse('<?php echo $jsonData; ?>');
let result = {};
let counts = {};

data.forEach(item => {
    let [key1, key2, value] = item.split("-");
    if (!result[key1]) {
        result[key1] = {};
		// counts[key1] = 0; //version1
		counts[key1] = { total: 0 };
		// console.log("key", [key1].length);
    }
    if (!result[key1][key2]) {
        result[key1][key2] = [];
		counts[key1][key2] = 0;
		// console.log("subkey", [key1][key2].length);
    }
    result[key1][key2].push(value);
	// counts[key1]++; //version1
	counts[key1][key2]++;
    counts[key1].total++;
});

console.log("Counts:", counts);

// for (let key1 in result) {
//     for (let key2 in result[key1]) {
//         console.log('Count of members in key ${key1} and subkey ${key2}:', result[key1][key2].length);
//     }
// }


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
</html>
