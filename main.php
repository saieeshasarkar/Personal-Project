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
    <meta charset="UTF-8">
<!--     <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
	 
    <title>Multi-page App - Materialize</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
            padding: 20px;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        .bottom-nav .tab {
            text-align: center;
        }
        .bottom-nav i {
            display: block;
            margin-bottom: 5px;
        }
        .bottom-nav a {
            color: #9e9e9e; /* Grey color for inactive tabs */
        }
        .bottom-nav a.active {
            color: #000; /* Black color for active tab */
        }
        .page {
            display: none;
        }
        .page.active {
            display: block;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .login-form {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
        }
    </style>
</head>
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
<body>
    <main>
        <div id="home" class="page active">
            <form class="login-form">
                <h4 class="center-align">Login</h4>
                <div class="input-field">
                    <input id="username" type="text" class="validate" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input id="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>
                <button class="btn waves-effect waves-light w100" type="submit" name="action">Login
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>

        <div id="map-page" class="page">
            <h4>Map</h4>

            <div id="map">
             </div>
	<script type="text/javascript" src="script.js"></script>
	
        </div>

        <div id="user" class="page">
            <h4>User Profile</h4>
            <div class="card">
                <div class="card-content">
                    <span class="card-title">John Doe</span>
                    <p>Email: john.doe@example.com</p>
                    <p>Location: New York, USA</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bottom-nav">
        <div class="row">
            <div class="col s4 tab">
                <a href="#" class="active" data-page="home">
                    <i class="material-icons">home</i>
                    Home
                </a>
            </div>
            <div class="col s4 tab">
                <a href="#" data-page="map-page">
                    <i class="material-icons">map</i>
                    Map
                </a>
            </div>
            <div class="col s4 tab">
                <a href="#" data-page="user">
                    <i class="material-icons">person</i>
                    User
                </a>
            </div>
        </div>
    </footer>

    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <!-- Google Maps JavaScript -->
<!--     <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> -->
    
    <script>
        // Navigation functionality
        document.querySelectorAll('.bottom-nav a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const pageId = link.getAttribute('data-page');
                document.querySelectorAll('.page').forEach(page => {
                    page.classList.remove('active');
                });
                document.getElementById(pageId).classList.add('active');
                
                // Update active state of nav links
                document.querySelectorAll('.bottom-nav a').forEach(navLink => {
                    navLink.classList.remove('active');
                });
                link.classList.add('active');
            });
        });

        // Google Maps initialization
        function initMap() {
            // const map = new google.maps.Map(document.getElementById('map'), {
            //     center: {lat: -34.397, lng: 150.644},
            //     zoom: 8
            // });
        }

        // Prevent form submission (for demo purposes)
        document.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            M.toast({html: 'Login functionality would be implemented here.'});
        });
    </script>
</body>
</html>
