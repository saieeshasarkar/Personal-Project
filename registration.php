<?php

// Read GeoJSON file
$jsonString = file_get_contents('data/village.geojson');

// Decode JSON string into PHP array
$data = json_decode($jsonString, true);

// // Function to search for a feature by property
// function searchByProperty($data, $propertyName, $propertyValue) {
//     $result = array();
//     foreach ($data['features'] as $feature) {
//         if (isset($feature['properties'][$propertyName]) && $feature['properties'][$propertyName] == $propertyValue) {
//             // $result[] = $feature;
//             $result[] = array(
//                 'urcne' => $feature['properties']['urcne'],
//                 'uscne' => $feature['properties']['uscne']
//             );
//         }
//     }
//     return $result;
// }

// // Example usage
// $searchPropertyName = 'uucne';
// $searchPropertyValue = 'B. Nongping';
// $results = searchByProperty($data, $searchPropertyName, $searchPropertyValue);

// if (!empty($results)) {
//     echo "Search results for '$searchPropertyName' = '$searchPropertyValue':<br>";
//     foreach ($results as $result) {
//         echo "urcne: {$result['urcne']}, uscne: {$result['uscne']}<br>";
//         // echo "Feature ID: {$result['id']}, Coordinates: [{$result['geometry']['coordinates'][0]}, {$result['geometry']['coordinates'][1]}]<br>";
//     }
// } else {
//     echo "No results found for '$searchPropertyValue'.";
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        datalist {
  position: absolute;
  max-height: 20em;
  border: 0 none;
  overflow-x: hidden;
  overflow-y: auto;
}

datalist option {
  font-size: 0.8em;
  padding: 0.3em 1em;
  background-color: black;
  color: white;
  cursor: pointer;
}

datalist option:hover, datalist option:focus {
  color: white;
  background-color: gray;
  outline: 0 none;
}
datalist optgroup {

    background-color: #515A5A;
  color: white;
    pointer-events: none; /* Disable selection */
  }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript for validation -->
    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (email === "" || password === "" || confirmPassword === "") {
                alert("All fields are required!");
                return false;
            }

            // Email validation
            var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
            if (!email.match(emailRegex)) {
                alert("Invalid email address!");
                return false;
            }

            // Password match validation
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Registration Form</h2>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="firstname" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="fullname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">

            <label for="address" class="form-label"> Address:</label>
            <input autocomplete="off" id="search" list="searchOptions" type="text" class="form-control" id="address" name="address" required>

<datalist id=searchOptions>
<?php foreach ($data['features'] as $feature):?>
        <option id="<?= htmlspecialchars($feature['properties']['uuid']) ?>" value="<?= htmlspecialchars($feature['properties']['uucne']) ?>">
            <?= htmlspecialchars($feature['properties']['urcne'] . ' - ' . $feature['properties']['uscne'] . ' - ' . $feature['properties']['uucne']) ?>
        </option>
    <?php endforeach; ?>
</datalist>

                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datalist-css/dist/datalist-css.min.js"></script>
<script>
    $(function() {
        $('#search').on('blur', function() {
            var selectedValue = $(this).val();
            if ($(this).val()) {
                var options = $('#searchOptions').find('option').map(function() {
                    return this.value;
                }).get();
                if (options.indexOf(selectedValue) === -1) {
                    alert('Please select a value from the list.');
                    $(this).val('');
                }
            }
        });
    });
</script>

</body>
</html>
