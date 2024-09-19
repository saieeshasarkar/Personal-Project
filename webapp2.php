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
<!--     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
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
	
	<!-- <link rel="stylesheet" href="StyleMap.css" /> -->
    <link rel="stylesheet" href="mapstyle.css" />
	 
    <title>Dengue Occurrence in Laos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> -->
    <style>
        body { display: flex; min-height: 100vh; flex-direction: column; }
        main { flex: 1 0 auto; padding-bottom: 56px; }
        #map { height: calc(100vh - 216px); width:100%; }
        /* #map { width: 98%; height: 95vh; margin: 0 auto; } */
        /* .search-wrapper { padding: 10px; } */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
            z-index: 1000; 
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
        .user-actions {
            margin-top: 20px;
        }
        .user-actions a {
            margin-right: 10px;
        }
        .modal-footer a {
            margin-right: 10px;
            color: #26a69a;
        }
	     .autocomplete-content {
            position: absolute;
            width: 100%;
            z-index: 1000;
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
        <div class="container">
            <div id="homePage" class="page active">
                <h4>Welcome to Dengue Occurrence in Laos</h4>
                <p>Please use the navigation to explore the map or view user details.</p>
            </div>
            <div id="mapPage" class="page">
                <div class="row">
                    <div class="col s12">
<!--                         <div class="search-wrapper">
                            <input id="autocomplete-input" type="text" placeholder="Search for a district or province">
<label for="autocomplete-input">Search for a district or province</label>
                            <i class="material-icons" id="searchButton">search</i>
                        </div> -->
                        <div class="input-field col s12 ctitle" style="z-index: 9999;margin-bottom: -100px;"
                            <input type="text" id="autocomplete-input" class="autocomplete">
                            <label style="position: relative;" for="autocomplete-input">Search for a district or province</label>
                        </div>
                    </div>
                </div>
                <div id="map"></div>
                <script type="text/javascript" src="scriptc.js"></script>
            </div>
            <div id="userPage" class="page">
                <h4>User Details</h4>
                <p>Username: <span id="userDetailUsername"></span></p>
                <p>Email: <span id="userDetailEmail"></span></p>
                <p>Role: <span id="userDetailRole"></span></p>
                <div class="user-actions">
                    <a href="#" id="logoutButton" class="waves-effect waves-light btn">Logout</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bottom-nav">
        <div class="row">
            <div class="col s4 tab">
                <a href="#" class="active" data-page="homePage">
                    <i class="material-icons">home</i>
                    Home
                </a>
            </div>
            <div class="col s4 tab">
                <a href="#" data-page="mapPage">
                    <i class="material-icons">map</i>
                    Map
                </a>
            </div>
            <div class="col s4 tab">
                <a href="#" class="modal-trigger" data-target="loginModal" id="loginLink">
                    <i class="material-icons">person</i>
                    Login
                </a>
                <a href="#" data-page="userPage" style="display: none;" id="userLink">
                    <i class="material-icons">person</i>
                    User
                </a>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <h4>Login</h4>
            <form id="loginForm">
                <div class="input-field">
                    <input id="username" type="text" class="validate" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input id="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>
                <button class="btn waves-effect waves-light" type="submit">Login
                    <i class="material-icons right">send</i>
                </button>
            </form>
            <div class="modal-footer">
                <a href="#" id="registerLink">Register</a>
                <a href="#" id="forgotPasswordLink">Forgot Password?</a>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <h4>User Registration</h4>
            <form id="registerForm">
                <div class="input-field">
                    <input id="firstName" type="text" class="validate" required>
                    <label for="firstName">First Name</label>
                </div>
                <div class="input-field">
                    <input id="lastName" type="text" class="validate" required>
                    <label for="lastName">Last Name</label>
                </div>
                <div class="input-field">
                    <input id="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input id="address" type="text" class="autocomplete validate" required>
                    <label for="address">Address</label>
<!-- 		<input type="text" id="village-autocomplete-input" class="autocomplete">
                <label for="village-autocomplete-input">Search for village</label> -->
                </div>
                <div class="input-field">
                    <input id="regPassword" type="password" class="validate" required>
                    <label for="regPassword">Password</label>
                </div>
                <div class="input-field">
                    <input id="confirmPassword" type="password" class="validate" required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                <button class="btn waves-effect waves-light" type="submit">Register
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pako/2.0.4/pako.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lzma@2.3.2/src/lzma.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lzma@2.3.2/src/lzma_worker.js"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/zlib.js@0.3.1/bin/gunzip.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize Materialize components
        // document.addEventListener('DOMContentLoaded', function() {
        //     var modalElems = document.querySelectorAll('.modal');
        //     var modalInstances = M.Modal.init(modalElems, {
        //         onCloseEnd: function() {
        //             // Clear form fields when any modal is closed
        //             document.querySelectorAll('.modal form').forEach(function(form) {
        //                 form.reset();
        //             });
        //         }
        //     });
let autocompleteData = {};
let autocompleteDatax = {};
		 document.addEventListener('DOMContentLoaded', function() {
            const dataUrl = 'https://data.opendevelopmentmekong.net/geoserver/ODMekong/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ODMekong%3Adata&outputFormat=application%2Fjson';
	const geoJson = {
            resource_id: '94ac01e5-f4ca-414c-b5f7-1a34634ab5f3', 
		limit: 8500, // get 5 results// the resource id
        };

        // Construct the URL with query parameters
        const url = new URL('https://data.opendevelopmentcambodia.net/api/3/action/datastore_search');
        url.search = new URLSearchParams(geoJson).toString();

        // Make the JSONP request using fetch
        fetch(url, { mode: 'cors' }) // Use mode 'cors' for cross-origin requests
            .then(response => response.json()) // Convert the response to JSON
            .then(geoJson => {
                // alert('Total results found: ' + data.result.total);
		     // let autocompleteData = {};
                    let villageAutocompleteData = {};

                    // geoJson.features.forEach(feature => {
                    //     const properties = feature.properties;
		    geoJson.result.records.forEach(records => {
                        const properties = records;
                        ['urcne', 'uscne', 'uucne'].forEach(prop => {
                            if (properties[prop] && properties[prop].trim() !== '') {
                                //autocompleteData[properties[prop]] = null;
                                //properties[prop] === 'uucne' && (villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = null);
                                
				 
                 prop === 'uucne' ? villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = `${properties.urid}-${properties.usid}-${properties.uuid}` : autocompleteDatax[properties[prop]] = null;
              
                // prop === 'uucne' ? villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = `${properties.urid}-${properties.usid}-${properties.uuid}` : autocompleteDatax[properties[prop]] = null;
                           }
                        });
                    });

                    // Initialize main autocomplete
                    var elems = document.querySelectorAll('#autocomplete-input');
                    var instances = M.Autocomplete.init(elems, {
                        data: autocompleteData,
                        limit: 10,
                        minLength: 1,
                        onAutocomplete: function(text) {
                            console.log("Selected location:", text);
				var layer = autocompleteData[text];
				if (layer) {
					m.fitBounds(layer.getBounds());
					// highlightFeature({ target: layer });
                    province_lay.setStyle(styleP);
			        district_lay.setStyle(styleD);

					layer.setStyle({
				    weight: 3,
				    color: '#636363',
				    fillOpacity: 0.4
			        });
			        info.update(layer.feature.properties);
				}
                        }
                    });

                    // Initialize village autocomplete
                    var villageElems = document.querySelectorAll('#address');
                    var villageInstances = M.Autocomplete.init(villageElems, {
                        data: villageAutocompleteData,
                        limit: 10,
                        minLength: 1,
                        onAutocomplete: function(text) {
                             console.log("Selected village:", text);
                            selectedVillageIds = villageAutocompleteData[text];
                            console.log("Selected village IDs:", selectedVillageIds);
                        }
                    });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
			 
			 
            // fetch(dataUrl)
            //     .then(response => {
            //         if (!response.ok) {
            //             throw new Error('Network response was not ok');
            //         }
            //         return response.json();
            //     })
            //     .then(geoJson => {
            //         let autocompleteData = {};
            //         let villageAutocompleteData = {};

            //         geoJson.features.forEach(feature => {
            //             const properties = feature.properties;
            //             ['urcne', 'uscne', 'uucne'].forEach(prop => {
            //                 if (properties[prop] && properties[prop].trim() !== '') {
            //                     //autocompleteData[properties[prop]] = null;
            //                     //properties[prop] === 'uucne' && (villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = null);
            //     prop === 'uucne' ? villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = `${properties.urid}-${properties.usid}-${properties.uuid}` : autocompleteData[properties[prop]] = null;
            //                }
            //             });
            //         });

            //         // Initialize main autocomplete
            //         var elems = document.querySelectorAll('#autocomplete-input');
            //         var instances = M.Autocomplete.init(elems, {
            //             data: autocompleteData,
            //             limit: 10,
            //             minLength: 1,
            //             onAutocomplete: function(text) {
            //                 console.log("Selected location:", text);
            //             }
            //         });

            //         // Initialize village autocomplete
            //         var villageElems = document.querySelectorAll('#address');
            //         var villageInstances = M.Autocomplete.init(villageElems, {
            //             data: villageAutocompleteData,
            //             limit: 10,
            //             minLength: 1,
            //             onAutocomplete: function(text) {
            //                  console.log("Selected village:", text);
            //                 selectedVillageIds = villageAutocompleteData[text];
            //                 console.log("Selected village IDs:", selectedVillageIds);
            //             }
            //         });
            //     })
            //     .catch(error => {
            //         console.error('Error fetching the JSON data:', error);
            //         // You might want to display an error message to the user here
            //     });
		
		// document.getElementById('submit-btn').addEventListener('click', function() {
  //               if (selectedVillageIds) {
  //                   console.log("Submitting village IDs:", selectedVillageIds);
  //                   // Here you can add code to send this data to your server or process it further
  //               } else {
  //                   console.log("No village selected");
  //               }
  //           });
		var modalElems = document.querySelectorAll('.modal');
            var modalInstances = M.Modal.init(modalElems, {
                onCloseEnd: function() {
                    // Clear form fields when any modal is closed
                    document.querySelectorAll('.modal form').forEach(function(form) {
                        form.reset();
                    });
                }
            });
        });

        // Initialize map
        // var map = L.map('map').setView([18.5203, 103.7542], 6);
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // // Sample data for dengue occurrences (replace with real data)
        // var dengueData = [
        //     { lat: 17.9667, lon: 102.6000, cases: 10 }, // Vientiane Capital
        //     { lat: 19.8845, lon: 102.1416, cases: 5 },  // Luang Prabang
        //     { lat: 15.1202, lon: 105.8019, cases: 3 }   // Champasak
        // ];

        // // Add markers for dengue occurrences
        // dengueData.forEach(function(point) {
        //     L.circleMarker([point.lat, point.lon], {
        //         radius: 5,
        //         fillColor: "#ff0000",
        //         color: "#000",
        //         weight: 1,
        //         opacity: 1,
        //         fillOpacity: 0.8
        //     }).addTo(map).bindPopup(`Cases: ${point.cases}`);
        // });

        // // Search functionality (simplified)
        // document.getElementById('searchButton').addEventListener('click', function() {
        //     var searchTerm = document.getElementById('searchInput').value.toLowerCase();
        //     if (searchTerm === 'vientiane capital') {
        //         map.setView([17.9667, 102.6000], 10);
        //     }
        //     // Add more provinces as needed
        // });

        // Login form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            // Simulated login (replace with actual login logic)
            if (username === "user" && password === "password") {
                loginSuccess({
                    username: username,
                    email: "user@example.com",
                    role: "Standard User"
                });
            } else {
                M.toast({html: 'Invalid credentials'});
            }
        });

        function loginSuccess(user) {
            document.getElementById('loginLink').style.display = 'none';
            document.getElementById('userLink').style.display = 'block';
            document.getElementById('userDetailUsername').textContent = user.username;
            document.getElementById('userDetailEmail').textContent = user.email;
            document.getElementById('userDetailRole').textContent = user.role;
            M.Modal.getInstance(document.getElementById('loginModal')).close();
            M.toast({html: 'Login successful'});
            showPage('userPage');
        }

        // Logout functionality
        document.getElementById('logoutButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loginLink').style.display = 'block';
            document.getElementById('userLink').style.display = 'none';
            showPage('homePage');
            M.toast({html: 'Logged out successfully'});
        });

        // Register link
        document.getElementById('registerLink').addEventListener('click', function(e) {
            e.preventDefault();
            M.Modal.getInstance(document.getElementById('loginModal')).close();
            M.Modal.getInstance(document.getElementById('registerModal')).open();
        });

        // Forgot Password link (placeholder functionality)
        document.getElementById('forgotPasswordLink').addEventListener('click', function(e) {
            e.preventDefault();
            M.toast({html: 'Forgot password functionality not implemented yet'});
        });

        // Registration form submission (placeholder functionality)
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            M.toast({html: 'Registration functionality not implemented yet'});
            M.Modal.getInstance(document.getElementById('registerModal')).close();
        });

        // Navigation
        document.querySelectorAll('.bottom-nav a[data-page]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var pageId = this.getAttribute('data-page');
                showPage(pageId);
            });
        });

        function showPage(pageId) {
            document.querySelectorAll('.page').forEach(function(page) {
                page.classList.remove('active');
            });
            document.getElementById(pageId).classList.add('active');

            document.querySelectorAll('.bottom-nav a').forEach(function(link) {
                link.classList.remove('active');
            });
            document.querySelector(`.bottom-nav a[data-page="${pageId}"]`).classList.add('active');

            if (pageId === 'mapPage') {
                m.invalidateSize();
            }
        }
    </script>
</body>
</html>
