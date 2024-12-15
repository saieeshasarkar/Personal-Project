<?php
require 'dbconfig.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// $fetchdata = $database->getReference('New')->getValue();
    
//  $code = [];
//  $groupedData = [];
//     foreach($fetchdata as $key => $value)
//     {
    
//       $code[] = $value['address'];
      
//     }

// $jsonData = json_encode($code);
// $jsonData = json_encode('');
$firebaseConfig = [
    'apiKey' => "AIzaSyBf3m74nlIkWPD1D9PMycQQIKxze0A-1hg",
    'authDomain' => "dengue-fever-database-6da72.firebaseapp.com",
    'databaseURL' => "https://dengue-fever-database-6da72-default-rtdb.asia-southeast1.firebasedatabase.app",
    'projectId' =>"dengue-fever-database-6da72",
    'storageBucket' => "dengue-fever-database-6da72.appspot.com",
    'messagingSenderId' => "484563913792",
    'appId' => "1:484563913792:web:617b18689b4238c825e3a5",
    'measurementId' => "G-LXXV81FSTD"
];

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

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  
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
    
<!-- data tables -->
<!-- 	  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.dataTables.min.js"></script>
     -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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
        #map { height: calc(100vh - 100px); width:100%; }
        /* #map { height: calc(100vh - 216px); width:100%; } */
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
        .enlarged {
            transform: scale(3);
        }
        #loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000; /* High z-index to cover modals */
}

.preloader-wrapper {
    width: 64px;
    height: 64px;
}
.indicator {
      font-size: 14px;
      font-style: italic;
      color: #555;
      margin-top: -15px;
      display: block;
    }
    .flatpickr-wrapper {
      margin-bottom: 20px;
    }
    .flatpickr-current-month{
        padding-top: 0px;
    }
    .flatpickr-monthDropdown-months
    {
        
    display: inline-block;
    }
    .numInput.cur-year
    {
    height: auto !important;
    border: none !important;
    }
	td.details-control {
            cursor: pointer;
        }
        tr.details-control {
            background-color: #f9f9f9;
        }
        .tree-indicator {
            cursor: pointer;
        }
    </style>
<!-- ////////////////////////////firebase///////////////////////////////////////// -->
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-auth.js"></script>
<sript src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>

<script>
        var firebaseConfig = <?php echo json_encode($firebaseConfig); ?>;
        var checksession = <?= isset($_SESSION["logged_in"]) ? json_encode($_SESSION["logged_in"]) : json_encode(''); ?>;
        var sessiondata = <?= isset($_SESSION["data"]) ? json_encode($_SESSION["data"]) : json_encode(''); ?>;

</script>
<!-- ////////////////////////////firebase///////////////////////////////////////// -->
</head>
<script>
	
    firebase.initializeApp(firebaseConfig);
  // Reference to your Firebase Realtime Database
  var database = firebase.database();

  // Reference to the specific location in your database
  var dbRef = database.ref('Data');

  let result = {};
// let counts = {};
  let counts = {total:0};

  // Listen for changes in the data and update the webpage
//   dataRef.on('value', function(snapshot) {
//     var data = snapshot.val();
   
//     // document.getElementById('real-time-data').innerHTML = JSON.stringify(data);
//   });
// Step 1: Load the full data once
// function RealDB(data) {
//     // const value1 = {};
//     // const value2 = {total:0};
//     // for (let key in data) {
//         if (data.status === 1) { // Check if status is 1
            
//     let [key1, key2, value] = data.address.split("-");
//     if (!result[key1]) {
//         result[key1] = {};
// 		counts[key1] = { total: 0 };
//     }
//     if (!result[key1][key2]) {
//         result[key1][key2] = [];
// 		counts[key1][key2] = { total: 0, unique: {} };
//     }
//     if (!counts[key1][key2].unique[value]) {
//         counts[key1][key2].unique[value] = 0;
//     }
//     result[key1][key2].push(value);
// 	counts[key1][key2].unique[value]++;
//     counts[key1][key2].total++;
//     counts[key1].total++;
//     counts.total++;
//     const element = document.getElementById('P' + key1);
// if (element) {
    
//     document.getElementById('P' + key1).innerHTML = JSON.stringify(counts[key1].total);
//     document.getElementById('D' + key2).innerHTML = JSON.stringify(counts[key1][key2].total);
// } else {
//     console.error("Element with ID 'elementId' not found");
// }

//         }
//     // }
//     // return [value1, value2];  // Returning as an array
// }
const markerElements = [];
const markerById = {};
function resetRealDB(data,startDate,endDate){
result = {};
counts = {total:0};
for (let key in markerById) {
	var geticon = markerById[key].options.icon;
	var docx= document.createElement('div');
	docx.innerHTML=geticon.options.html;
	docx.children[0].firstChild.innerHTML=0;
     
	geticon.options.html=docx.innerHTML;
		
	markerById[key].setIcon(geticon);
           ///////////////effect//////////////////
        //    const pElement = document.getElementById(key);
        // //    const dElement = document.getElementById('D' + key2);
            //var nElement =  pElement ? document.getElementById('P' + key1) : document.getElementById('D' + key2);
        // let current = 0;
        // let target = 1;
        // const increment = target / 5; // Adjust increment for speed

        // const interval = setInterval(() => {
        //     current += increment;
        //     if (current >= target) {
        //         current = target;
        //         clearInterval(interval);
        //     }
        //     // numberElement.innerText = Math.floor(current);
            
        //     // Add the enlarged effect
        //     nElement.classList.add('enlarged');
        //     setTimeout(() => {
        //         nElement.classList.remove('enlarged');
        //     }, 100); // Duration of the enlargement effect
        // }, 20); // Update interval

	}
// Assuming `data` is already loaded from snapshot.val()
// const startDate = "2022-01-01";
// const endDate = "2023-12-31";

//result = {};
//counts = {total:0};
// Assuming `data` is already loaded from snapshot.val()

// Initialize an array to store the filtered items
const filteredItems = [];

// Loop through each item in the data
Object.keys(data).forEach(itemId => {
  const item = data[itemId];
	
  if (!item.dates || Object.keys(item.dates).length === 0) {
    return;  // Skip this item
  }
  // Get the list of dates for the item (the keys under "dates")
  const itemDates = Object.keys(item.dates);

  // Check if any date in the item falls within the specified range
  const hasValidDate = itemDates.some(date => date >= startDate && date <= endDate);

  if (hasValidDate) {
  const currentYear = new Date().getFullYear(); // Get the current year
  const dateYear = new Date(startDate).getFullYear(); // Get the year of the provided date
  
  if (dateYear !== currentYear) item.status = 1;  // Replace the dates with the new date
    // If the item has a date within the range, add it to the filtered list
    filteredItems.push(item);
    RealDB({[0]:item});
  }
});
//RealDB(filteredItems);
// `filteredItems` now contains all the items with dates within the range
console.log(filteredItems);

	
}
function RealDB(data, opt = false){
    // const value2 = {total:0};
    for (let key in data) {
     let [key1, key2, value] = data[key].address.split("-");
        // if(add){}
        if(opt===false){
        if (data[key].status === 1) { // Check if status is 1
            
    [key1, key2, value] = data[key].address.split("-");
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
    }
    
    } else {
        if (data[key].status === 0) { // Check if status is 1
            [key1, key2, value] = data[key].address.split("-");
            counts[key1][key2].unique[value]--;
            counts[key1][key2].total--;
            counts[key1].total--; 
            counts.total--;

            }
    }
    
	var checkder =  'P' + key1 in markerById ? markerById['P' + key1] : false;
	//Object.keys(markerById).length>0
	if (checkder != false){
		// const elementp = document.getElementById('P' + key1);
  //   		const elementd = document.getElementById('D' + key2);
		// if (elementd) {
		// markerById['D' + key2].getElement().children[0].firstChild.innerHTML=counts[key1][key2].total;
		// } else {
		//     console.log("Element with ID 'elementId' not found");
		// }
			
		// if (elementp) {
		// markerById['P' + key1].getElement().children[0].firstChild.innerHTML=counts[key1].total;
		// } else {
		//     console.log("Element with ID 'elementId' not found");
		// }	
		
	// markerById['P' + key1].getElement().children[0].firstChild.innerHTML=counts[key1].total;
	// markerById['D' + key2].getElement().children[0].firstChild.innerHTML=counts[key1][key2].total;
		var geticonp = markerById['P' + key1].options.icon;
		var geticond = markerById['D' + key2].options.icon;
		
		var docp= document.createElement('div');
		docp.innerHTML=geticonp.options.html;
	
		var docd= document.createElement('div');
		docd.innerHTML=geticond.options.html;
		
		docp.children[0].firstChild.innerHTML=counts[key1].total;
		docd.children[0].firstChild.innerHTML=counts[key1][key2].total;
     
		geticonp.options.html=docp.innerHTML;
		geticond.options.html=docd.innerHTML;
		// var docp = geticonp.options.html;
		// var docd = geticond.options.html;
		// docp.children[0].firstChild.innerHTML=counts[key1].total;
		// docd.children[0].firstChild.innerHTML=counts[key1][key2].total;
		// geticonp.options.html=docp;
		// geticond.options.html=docd;
		// geticonp.options.html.children[0].firstChild.innerHTML=counts[key1].total;
		// geticond.options.html.children[0].firstChild.innerHTML=counts[key1][key2].total;
		// geticonp.options.html=geticonp.options.html.innerHTML;
		// geticond.options.html=geticond.options.html.innerHTML;
		
		markerById['P' + key1].setIcon(geticonp);
		markerById['D' + key2].setIcon(geticond);
           ///////////////effect//////////////////
        // var op= pElementx.options.icon;
        // var opx= pElementx.options.html;
        // var opxx= op.options.html;
        
		// const pElement = pElementx.getElement().children[0].firstChild;
        
		// const dElement = dElementx.getElement().children[0].firstChild;
           const pElement = document.getElementById('P' + key1);
        //    const dElement = document.getElementById('D' + key2);
           var nElement =  pElement ? document.getElementById('P' + key1) : document.getElementById('D' + key2);
        let current = 0;
        let target = 1;
        const increment = target / 5; // Adjust increment for speed

        const interval = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            // numberElement.innerText = Math.floor(current);
            
            // Add the enlarged effect
            nElement.classList.add('enlarged');
            setTimeout(() => {
                nElement.classList.remove('enlarged');
            }, 100); // Duration of the enlargement effect
        }, 20); // Update interval
    
        /////////////////////////////////////
        
	// markerById['P' + key1].options.icon.html=markerById['P' + key1].getElement().innerHTML;
	// markerById['D' + key2].options.icon.html=markerById['D' + key2].getElement().innerHTML;
	}
//     const elementp = document.getElementById('P' + key1);
//     const elementd = document.getElementById('D' + key2);
// if (elementp) {
//     elementp.innerHTML = JSON.stringify(counts[key1].total);
// } else {
//     console.log("Element with ID 'elementId' not found");
// }
// if (elementd) {
//     // document.getElementById('P' + key1).innerHTML = JSON.stringify(counts[key1].total);
//     elementd.innerHTML = JSON.stringify(counts[key1][key2].total);
// } else {
//     console.log("Element with ID 'elementId' not found");
// }

        // } old of end status === 1
     }
    // return [value1, value2];  // Returning as an array
}

let allData = {};
dbRef.once('value')
    .then((snapshot) => {
        existingChildrenCount = snapshot.numChildren();
        const data = snapshot.val();
	allData=data;
        // const [result, counts] = RealDB(data);
         RealDB(data);
	 // resetRealDB(data,"2022-01-01","2023-12-01");
    //     if (data) {
    // // const filteredData = {};
    // // filteredData[key] = {
    // //             address: data[key].address
    // //         };
    // }
        console.log('Full data loaded:', data);
        let addedChildrenCount = 0;
        // Step 2: Set up a listener for added children
        dbRef.on('child_added', (childSnapshot) => {
            addedChildrenCount++;
            const addedData = childSnapshot.val();
            // console.log('New child added:', addedData);
              // Check if this is part of the initial load or a new child
            if (addedChildrenCount <= existingChildrenCount) {
                console.log('Initial child loaded:', addedData);
            } else {
                console.log('New child added:', addedData);
                // let nc = {};
                // nc[childSnapshot.key].push(addedData)
                const nc = {
                    [childSnapshot.key]: 
                        addedData
                };
                RealDB(nc);
            }
            
        });

        // Step 3: Set up a listener for removed children
        dbRef.on('child_removed', (childSnapshot) => {
            const removedData = childSnapshot.val();
            const nc = {
                    [childSnapshot.key]: 
                    removedData
                };
                RealDB(nc,true);
            console.log('Child removed:', removedData);
        });

        // Step 4: Set up a listener for changed children
        dbRef.on('child_changed', (childSnapshot) => {
            const updatedData = childSnapshot.val();
            const nc = {
                    [childSnapshot.key]: 
                    updatedData
                };
                const act = (updatedData.status === 0) ? true :  false;
                RealDB(nc,act);
            console.log('Child updated:', updatedData);
        });
    })
    .catch((error) => {
        console.error('Error loading data:', error);
    });

  function addNewRecord() {
    const newRecordRef = dataRef.push(); // Automatically generates a unique key
    newRecordRef.set({
        name: "John Doe",
        email: "john@example.com"
    }).then(() => {
        console.log('New record saved successfully.');
    }).catch((error) => {
        console.error('Error saving new record:', error);
    });
}

function editRecord(userId) {
    const specificRef = dataRef.child(userId);
    specificRef.update({
        user: "newemail@example.com", // Update email field
        status: "Yes"
    }).then(() => {
        console.log('Record updated successfully.');
    }).catch((error) => {
        console.error('Error updating record:', error);
    });
}


	// Get a reference to your database
	///////////////
// const dbRef = firebase.database().ref('Data');

// // Set the start and end dates for your query
// const startDate = "2022-01-01";
// const endDate = "2023-12-31";

// // Query items where the dates are between the start and end dates
// dbRef.orderByChild('dates')
//   .startAt(startDate)
//   .endAt(endDate)
//   .once('value')
//   .then(snapshot => {
//     const items = snapshot.val();
//     if (items) {
//       // Loop through the items and display those with dates in the specified range
//       Object.keys(items).forEach(itemId => {
//         const item = items[itemId];
//         const itemDates = Object.keys(item.dates); // Get the list of dates for the item
//         itemDates.forEach(date => {
//           if (date >= startDate && date <= endDate) {
//             console.log(`Item ${itemId} has a date ${date}`);
//           }
//         });
//       });
//     } else {
//       console.log('No items found in the specified date range.');
//     }
//   })
//   .catch(error => {
//     console.error('Error fetching data:', error);
//   });
//////////////////////////	
// Use the PHP variable in JavaScript
// let datax = JSON.parse('?php echo $jsonData; ?>');

// let resultx = {};
// // let counts = {};
// let countsx = {total:0};
// datax.forEach(item => {
//     let [key1, key2, value] = item.split("-");
//     if (!resultx[key1]) {
//         resultx[key1] = {};
// 		countsx[key1] = { total: 0 };
//     }
//     if (!resultx[key1][key2]) {
//         resultx[key1][key2] = [];
// 		countsx[key1][key2] = { total: 0, unique: {} };
//     }
//     if (!countsx[key1][key2].unique[value]) {
//         countsx[key1][key2].unique[value] = 0;
//     }
//     resultx[key1][key2].push(value);
// 	countsx[key1][key2].unique[value]++;
//     countsx[key1][key2].total++;
//     countsx[key1].total++;
//     countsx.total++;
// });

// console.log("Counts:", countsx);

// function countMembers(data, key, subKey) {
//     if (data.hasOwnProperty(key)) {
//         if (subKey && data[key].hasOwnProperty(subKey)) {
//             return data[key][subKey].length;
//         } else {
//             let count = 0;
//             for (let subKey in data[key]) {
//                 count += data[key][subKey].length;
//             }
//             return count;
//         }
//     }
//     return 0;
// }

// console.log(result);
// console.log(countMembers(datax, '1', '101'));  // Outputs: 2
</script>
<body>
<div id="loading-overlay" style="display: none;">
    <div class="preloader-wrapper active">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
    <main>
        <div class="container">
       
            <div id="homePage" class="page active">
                <h4>Welcome to Dengue Occurrence in Laos</h4>
                <p>Please use the navigation to explore the map or view user details.</p>
            </div>
            <div id="mapPage" class="page">
                <div class="mapcontol row">
                    <div class="col s12" style="margin-bottom: -100px;">
<!--                         <div class="search-wrapper">
                            <input id="autocomplete-input" type="text" placeholder="Search for a district or province">
<label for="autocomplete-input">Search for a district or province</label>
                            <i class="material-icons" id="searchButton">search</i>
                        </div> -->
                        <div class="input-field col s12 ctitle" style="z-index: 1002;margin-bottom: -1px;">
                        <label style="position: relative;" for="autocomplete-input">Search for a district or province</label>
                            <input type="text" id="autocomplete-input" class="autocomplete">
                            
                        </div>
			  <div class="input-field col s12 ctitle" style="z-index: 1002;margin-bottom: -100px;">
			<label style="position: relative;" for="date-range">Start and End Date</label>
            <input hidden type="text" id="date-range" placeholder="Choose Date Range">
            
            <input type="text" id="range-picker" placeholder="Select date range">
           
                        </div>
			   
      
                    </div>
                </div>
                <div id="map"></div>
                <script type="text/javascript" src="scriptc.js"></script>
            </div>
            <div id="userPage" class="page">
                <h4>User Details</h4>
               <div class="row">
    <div class="col s12">
        <p><strong>Username:</strong> <span id="userDetailUsername"></span></p>
        <p><strong>Email:</strong> <span id="userDetailEmail"></span></p>
        <p><strong>Address:</strong> <span id="userDetailAddress"></span></p>
        
        <!-- Editable Status Dropdown -->
	<p><strong>Status:</strong> <span id="userDetailStatus"></span></p>
        <div class="input-field col s12">
            <select id="statusDropdown">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
<!--             <label for="statusDropdown">Status</label> -->
        </div>
        
        <!-- Update Status Button -->
        <div class="user-actions">
            <a href="#" id="updateStatusButton" class="waves-effect waves-light btn">Update Status</a>
        </div>

        <!-- Logout Button -->
        <div class="user-actions">
            <a href="#" id="logoutButton" class="waves-effect waves-light btn red darken-2">Logout</a>
        </div>
    </div>
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
<!-- Report Modal -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <h4>Report</h4>
                 <table id="treeTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Type</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
            <!-- The rows will be dynamically populated -->
        </tbody>
    </table>

    <script type="text/javascript"  src="treeTable.js"></script>
        </div>
    </div>
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
            <form id="registerForm" action="register.php" method="post"">
                <div class="input-field">
                    <input id="firstname" name="firstname" type="text" class="validate" required>
                    <label for="firstname">First Name</label>
                </div>
                <div class="input-field">
                    <input id="lastname" name="lastname" type="text" class="validate" required>
                    <label for="lastname">Last Name</label>
                </div>
                <div class="input-field">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input id="address"type="text" class="autocomplete validate" required>
                    <label for="address">Address</label>
<!-- 		<input type="text" id="village-autocomplete-input" class="autocomplete">
                <label for="village-autocomplete-input">Search for village</label> -->
                 <!-- Hidden input to store the numeric value -->
    <input type="hidden" id="selected_option_id" name="selected_option_id">
                </div>
                <div class="input-field">
                    <input id="regPassword" name="regPassword" type="password" class="validate" required>
                    <label for="regPassword">Password</label>
                </div>
                <div class="input-field">
                    <input id="confirmPassword" name="confirmPassword" type="password" class="validate" required>
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
         // Get today's date
         const today = new Date();
         const todayDateString = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    // Initialize Flatpickr for Date Range
    flatpickr("#range-picker", {
      enableTime: false, // Disable time picking, only date
      dateFormat: "Y-m-d", // Only show year, month, and day
      mode: "range", // Enable range mode
      maxDate: todayDateString, // Range cannot exceed today
      onChange: function (selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
          const startDate = selectedDates[0];
          const endDate = selectedDates[1];
          
          // Check that the end date is within the same year as the start date
          if (startDate.getFullYear() !== endDate.getFullYear()) {
            alert("The end date must be within the same year as the start date.");
            instance.clear(); // Clear the input if the range is invalid
          }else{
            resetRealDB(allData,startDate.toISOString().split('T')[0],endDate.toISOString().split('T')[0]);
          }
        }
      },
    });
        
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
                                
				 
                 prop === 'uucne' ? villageAutocompleteData[`${properties.uucne} &lt;br&gt;- ${properties.urcne} - ${properties.uscne}`] = `${properties.urid}-${properties.usid}-${properties.uuid}` : autocompleteDatax[properties[prop]] = null;
              
                // prop === 'uucne' ? villageAutocompleteData[`${properties.urcne} - ${properties.uscne} - ${properties.uucne}`] = `${properties.urid}-${properties.usid}-${properties.uuid}` : autocompleteDatax[properties[prop]] = null;
                           }
                        });
                    });

                    // Initialize main autocomplete
		    //////////////////////////
		//////////////////////////
		//////////////////////////
		    var elemsstatus = document.querySelectorAll('#statusDropdown');
    			var instances = M.FormSelect.init(elemsstatus);
		    
                    var elems = document.querySelectorAll('#autocomplete-input');
                    var instances = M.Autocomplete.init(elems, {
                        data: autocompleteData,
                        limit: 10,
                        minLength: 1,
                        onAutocomplete: function(text) {
                            console.log("Selected location:", text);
				//var newStr = text.replace(/\s(?=[^ ]*$)/, "&lt;br&gt;");
				var newStr = text.replace("District ", "District &lt;br&gt;");
                
				//console.log(newStr);
				var layer = autocompleteData[newStr];
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

	//////////////////////////
	//////////////////////////
	//////////////////////////
                    // Initialize village autocomplete
                    var villageElems = document.querySelectorAll('#address');
                    var villageInstances = M.Autocomplete.init(villageElems, {
                        data: villageAutocompleteData,
                        limit: 10,
                        minLength: 1,
                        onAutocomplete: function(text) {
                            let parts = text.split('-');
                            // Replace the second space (index 2 in the parts array) with "<br>"
                            parts[0] = parts[0] + "&lt;br&gt;";
                            // Join the parts back into a string 
                            let result = parts.join('-');
                             console.log("Selected village:", result);
                            selectedVillageIds = villageAutocompleteData[result];
                            document.getElementById('selected_option_id').value = selectedVillageIds;
                            console.log("Selected village IDs:", selectedVillageIds);
                        }
                    });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
			 
////////////date time////////////
//////////////////////////
// const dateRangeInput = document.getElementById('date-range');
//       let startDate = null;

//       // Event listener to handle date range selection
//       dateRangeInput.addEventListener('focus', function () {

// 	       // Show indicator for Start Date selection
//         // indicator.textContent = 'Selecting Start Date...';

//         // Initialize Start Date Picker
// 	let startDateSelected = false; // Flag to track if the start date was selected
// 	let endDateSelected = false; // Flag to track if the start date was selected
//         const startPicker = M.Datepicker.init(dateRangeInput, {
//           format: 'yyyy-mm-dd',
//           autoClose: false,
// 	  maxDate: new Date(),
// 	  onOpen: function () {
// 	          // Find the modal and insert a custom title
// 	          const modal = document.querySelector('.datepicker-modal');
// 	          if (modal && !modal.querySelector('.datepicker-title')) {
// 	            const title = document.createElement('div');
// 	            title.className = 'datepicker-title';
// 	            title.textContent = 'Selecting Start Date...'; // Set your custom title here
// 	            modal.prepend(title);
// 	          }
//           },
// 	  onSelect: function (selectedDate) {
// 	          startDateSelected = true; // Mark start date as selected
// 	          // endPicker.options.minDate = selectedDate; // Set minDate for the end date picker
// 	        	},
//           onClose: function () {
// 		  if (startDateSelected) {
//             // If a start date is selected, open the end date picker
//             //endPicker.open();
          
//             startDate = new Date(dateRangeInput.value); // Save the selected start date
//             const startYear = startDate.getFullYear();
// 	   const endOfYearDate = new Date(startDate.getFullYear(), 11, 31);
		  
// 	 // Update indicator for End Date selection
//             // indicator.textContent = 'Selecting End Date...';

//             // Initialize End Date Picker after Start Date is selected
//             M.Datepicker.init(dateRangeInput, {
//               format: 'yyyy-mm-dd',
//               autoClose: false,
//               minDate: startDate,
// 	      maxDate: endOfYearDate,
//               // yearRange: [startYear, startYear],
// 	      onOpen: function () {
// 	          // Find the modal and insert a custom title
// 	          const modal = document.querySelector('.datepicker-modal');
// 	          if (modal && !modal.querySelector('.datepicker-title')) {
// 	            const title = document.createElement('div');
// 	            title.className = 'datepicker-title';
// 	            title.textContent = 'Selecting End Date...'; // Set your custom title here
// 	            modal.prepend(title);
// 	          }
//           	},
// 	      onSelect: function (selectedDate) {
// 		 endDateSelected =true;
// 	      },
//               onClose: function () {
// 		if (endDateSelected) {
//                 const endDate = new Date(dateRangeInput.value); // Save the selected end date

//                 // Combine the dates into a range
//                 if (startDate && endDate) {
//                   dateRangeInput.value = `${startDate.toISOString().split('T')[0]} to ${endDate.toISOString().split('T')[0]}`;
// 		resetRealDB(allData,startDate.toISOString().split('T')[0],endDate.toISOString().split('T')[0]);
// 		startDateSelected = false;
// 		endDateSelected =false;
// 		  // indicator.textContent = ''; // Clear the indicator after selection
             
//                 }
// 	      }else
// 		{
// 		dateRangeInput.value ="";
// 		startDateSelected = false;
// 		endDateSelected =false;
// 		}
//               }
//             }).open();
		
// 		  }
//           startDateSelected = false;
//           }
		
//         });
//         startPicker.open();
//      });
//////////////////////////
//////////////////////////
	 // Initialize Date Picker for Start Date
    // const startDateInput = document.getElementById('start-date');
    // const endDateInput = document.getElementById('end-date');
    
    // const startDatePicker = M.Datepicker.init(startDateInput, {
    //   format: 'yyyy-mm-dd', // Date format
    //   autoClose: true,       // Auto close after selecting a date
    //   onSelect: function (date) {
    //     // Once the start date is selected, update the end date picker
    //     const startYear = date.getFullYear();
    //     const startDate = date;

    //     // Update end date picker to ensure it comes after the start date and within the same year
    //     endDatePicker.options.minDate = startDate;
    //     endDatePicker.options.yearRange = [startYear, startYear]; // Same year restriction
    //     endDatePicker.update(); // Reinitialize end date picker with updated options
    //   }
    // });

    // // Initialize Date Picker for End Date
    // const endDatePicker = M.Datepicker.init(endDateInput, {
    //   format: 'yyyy-mm-dd',
    //   autoClose: true,
    //   minDate: new Date() // Initially set minDate to today
    // });		 
////////////////////////			 
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

  if (checksession){
        document.getElementById('loginLink').style.display = 'none';
        document.getElementById('userLink').style.display = 'block';
        document.getElementById('userDetailUsername').textContent = sessiondata.username;
        document.getElementById('userDetailEmail').textContent = sessiondata.email;
        document.getElementById('userDetailAddress').textContent = sessiondata.address;
	    document.getElementById('statusDropdown').value = sessiondata.status;
           
    // loginSuccess({
    //                 username: sessiondata.username,
    //                 email: sessiondata.email,
    //                 address: sessiondata.address,
    //                 status: sessiondata.status
    //             });
//  loginSuccess(sessiondata);
  }
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

            // const formData = new FormData(this);
            // const jsonData = {};
            // formData.forEach((value, key) => {
            //     jsonData[key] = value; // Add key-value pairs to jsonData object
            // });
            // Send the form data using the fetch API
            document.getElementById("loading-overlay").style.display = "flex";
            fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                username: username,
                password: password
        })
            })
            .then(response => response.json()) // Assuming PHP returns text response
            .then(data => {
                if (data.status === 'success') {
            // Access the username from the response
            const loggedUsername = data.user.username;
            console.log('logged in Username:', loggedUsername);
            // alert('User registered: ' + loggedUsername);
            // M.toast({html: 'logged in Successful!'});
            loginSuccess({
                    username: loggedUsername,
                    email: data.user.email,
                    address: data.user.address,
                    status: data.user.status
                });
        } else {
            // Handle error response
            console.error('Error:', data.message);
            M.toast({html: 'Invalid credentials'});
        }
        }).catch(error => {
    console.error('Error:', error);
})
.finally(() => {
    // Hide loading indicator
    document.getElementById("loading-overlay").style.display = "none";
});

            
            // if (username === "user" && password === "password") {
            //     loginSuccess({
            //         username: username,
            //         email: "user@example.com",
            //         role: "Standard User"
            //     });
            // } else {
            //     M.toast({html: 'Invalid credentials'});
            // }
        });

        function loginSuccess(user) {
            document.getElementById('loginLink').style.display = 'none';
            document.getElementById('userLink').style.display = 'block';
            document.getElementById('userDetailUsername').textContent = user.username;
            document.getElementById('userDetailEmail').textContent = user.email;
            document.getElementById('userDetailAddress').textContent = user.address;
            // document.getElementById('userDetailStatus').textContent = user.status;
		document.getElementById('statusDropdown').value = user.status;
            M.Modal.getInstance(document.getElementById('loginModal')).close();
            M.toast({html: 'Login successful'});
            showPage('userPage');
        }

	  // Handle update status button click
        document.getElementById('updateStatusButton').addEventListener('click', function(e) {
		e.preventDefault();
        // var username = document.getElementById('username').value;
        // var password = document.getElementById('password').value;
            var selectedStatus = document.getElementById('statusDropdown').value;
            let intValue = +selectedStatus;

            fetch('update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                ustatus: intValue
        })
            })
            .then(response => response.json()) // Assuming PHP returns text response
            .then(data => {
                if (data.status === 'success') {
                    console.log('Updated Status:', selectedStatus);
            // Perform the update logic here (e.g., send status to the server)
            M.toast({html: 'Status updated to ' + selectedStatus});
        } else {
            // Handle error response
            console.log('Updated Status:', selectedStatus);
            // Perform the update logic here (e.g., send status to the server)
            M.toast({html: 'unable to updated'});
        }
        });

        });

        // Logout functionality
        document.getElementById('logoutButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loginLink').style.display = 'block';
            document.getElementById('userLink').style.display = 'none';
            showPage('homePage');
            fetch('signout.php', {
                method: 'GET'
             })
                .then(response => response.json())
                .then(data => {
                if (data.status === 'success') {
                    M.toast({html: 'Logged out successfully'});
                } else {
                    // Handle error response
                    console.log('Fail');
                    // Perform the update logic here (e.g., send status to the server)
                    M.toast({html: 'Fail to logout'});
                    }
            });

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
             // Gather form data
            e.preventDefault();

            const formData = new FormData(this);
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value; // Add key-value pairs to jsonData object
            });
            // Send the form data using the fetch API
            fetch('register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData) // Convert js object to JSON string
            })
            .then(response => response.json()) // Assuming PHP returns text response
            .then(data => {
                if (data.status === 'success') {
            // Access the username from the response
            const registeredUsername = data.user.username;
            console.log('Registered Username:', registeredUsername);
            // alert('User registered: ' + registeredUsername);
            M.toast({html: 'Registration Successful!'});
            loginSuccess({
                    username: registeredUsername,
                    email: data.user.email,
                    status: data.user.status
                });
        } else {
            // Handle error response
            console.error('Error:', data.message);
           M.toast({html:'Registration failed: ' + data.message});
        }
                // Show success message or handle response
                // M.toast({html: 'Registration Successful!'});
                // loginSuccess({
                //     username: username,
                //     email: "user@example.com",
                //     role: "Standard User"
                // });
                // console.log(data); // You can log or manipulate the response data
            })
            .catch(error => {
                M.toast({html: 'Error submitting form'});
                console.error('Error:', error);
            });
            // M.toast({html: 'Registration functionality not implemented yet'});
       
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
