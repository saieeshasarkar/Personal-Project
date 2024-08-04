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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dengue Occurrence in Laos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body { display: flex; min-height: 100vh; flex-direction: column; }
        main { flex: 1 0 auto; padding-bottom: 56px; }
        #map { height: calc(100vh - 216px); width:100%; }
        .search-wrapper { padding: 10px; }
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
    </style>
</head>
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
                        <div class="search-wrapper">
                            <input id="searchInput" type="text" placeholder="Search for a province">
                            <i class="material-icons" id="searchButton">search</i>
                        </div>
                    </div>
                </div>
                <div id="map"></div>
                <script type="text/javascript" src="script.js"></script>
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
                    <input id="address" type="text" class="validate" required>
                    <label for="address">Address</label>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize Materialize components
        document.addEventListener('DOMContentLoaded', function() {
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
                map.invalidateSize();
            }
        }
    </script>
</body>
</html>
