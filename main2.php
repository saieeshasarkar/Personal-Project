<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Multi-page App - Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
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
            background-color: #f8f9fa;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        .bottom-nav .nav-link {
            text-align: center;
            padding: 0.5rem 0;
            color: #6c757d; /* Grey color for inactive tabs */
        }
        .bottom-nav .nav-link.active {
            color: #000; /* Black color for active tab */
        }
        .bottom-nav i {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
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
<body>
    <main>
        <div id="home" class="page active">
            <form class="login-form">
                <h2 class="text-center mb-4">Login</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>

        <div id="map-page" class="page">
            <h2>Map</h2>\   
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
            <div id="map">
            </div>
            <script type="text/javascript" src="script.js"></script>
        </div>

        <div id="user" class="page">
            <h2>User Profile</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <p class="card-text">Email: john.doe@example.com</p>
                    <p class="card-text">Location: New York, USA</p>
                </div>
            </div>
        </div>
    </main>

    <nav class="bottom-nav">
        <div class="row">
            <div class="col-4">
                <a href="#" class="nav-link active" data-page="home">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>
            </div>
            <div class="col-4">
                <a href="#" class="nav-link" data-page="map-page">
                    <i class="bi bi-map"></i>
                    Map
                </a>
            </div>
            <div class="col-4">
                <a href="#" class="nav-link" data-page="user">
                    <i class="bi bi-person"></i>
                    User
                </a>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Google Maps JavaScript -->
<!--     <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> -->
    
    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const pageId = link.getAttribute('data-page');
                document.querySelectorAll('.page').forEach(page => {
                    page.classList.remove('active');
                });
                document.getElementById(pageId).classList.add('active');
                
                // Update active state of nav links
                document.querySelectorAll('.nav-link').forEach(navLink => {
                    navLink.classList.remove('active');
                });
                link.classList.add('active');
            });
        });

        // Google Maps initialization
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }

        // Prevent form submission (for demo purposes)
        document.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Login functionality would be implemented here.');
        });
    </script>
</body>
</html>
