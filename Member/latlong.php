<?php
// include './redirect.php';
// include '../Include/connect2.php';

// try
// {
    // $GOOGLE_API_KEY="AIzaSyBRQLQEDxc7SYhmET8csxmx3LUBiYnSnas";
    
    // $email=$_SESSION['member_email'];
    // $get_address=$connection->prepare("SELECT address FROM members WHERE email=?");
    // $get_address->execute([$email]);
    // if($get_address->rowCount() > 0) 
    // {
    //     $row=$get_address->fetch(PDO::FETCH_ASSOC);
    //     $address=$row['address'];
    //     // echo $address;
    // }

    // // Formatted address 
    // $formatted_address = str_replace(' ', '+', $address); 

    // // Get geo data from Google Maps API by address 
    // $geocodeFromAddr = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address}&key={$GOOGLE_API_KEY}"); 

    // // Decode JSON data returned by API 
    // $apiResponse = json_decode($geocodeFromAddr); 

    // // print_r($apiResponse);
    // // Retrieve latitude and longitude from API data 
    // $latitude  = $apiResponse->results[0]->geometry->location->lat;  
    // $longitude = $apiResponse->results[0]->geometry->location->lng; 

    // // Render the latitude and longitude of the given address 
    // echo "Given address :".$address;
    // echo 'Latitude: '.$latitude; 
    // echo '<br/>Longitude: '.$longitude;


// }
// catch (PDOException $e) 
// {
//     // Handle query errors
//     $error=$e->getMessage();
//     $_SESSION['error-message'] = "Database error: " . $error;
// }
?>





<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRQLQEDxc7SYhmET8csxmx3LUBiYnSnas"></script>
</head>
<body>
<h1>Sign Up</h1>
<div id="map" style="height: 400px;width:400px"></div>
<form id="signupForm">
  <label for="latitude">Latitude:</label>
  <input type="text" id="latitude" name="latitude" readonly><br>
  <label for="longitude">Longitude:</label>
  <input type="text" id="longitude" name="longitude" readonly><br>
  <input type="submit" value="Sign Up">
</form>

<script>
let map;
let marker;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 20.5937, lng: 78.9629 },
    zoom: 5,
  });

  marker = new google.maps.Marker({
    position: { lat: 20.5937, lng: 78.9629 },
    map: map,
    draggable: true,
  });

  google.maps.event.addListener(marker, "dragend", function () {
    updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
  });

  google.maps.event.addListener(map, "click", function (event) {
    marker.setPosition(event.latLng);
    updateLatLng(event.latLng.lat(), event.latLng.lng());
  });
}

function updateLatLng(latitude, longitude) {
  document.getElementById("latitude").value = latitude;
  document.getElementById("longitude").value = longitude;
}

document.getElementById("signupForm").addEventListener("submit", function (event) {
  event.preventDefault();
  // Submit the form data with latitude and longitude
  let formData = new FormData(this);
  formData.append("latitude", document.getElementById("latitude").value);
  formData.append("longitude", document.getElementById("longitude").value);
});
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRQLQEDxc7SYhmET8csxmx3LUBiYnSnas&callback=initMap"></script>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Location Picker</title>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRQLQEDxc7SYhmET8csxmx3LUBiYnSnas"></script>

<style>
  #map {
    height: 400px;
    width: 100%;
  }
</style>
</head>
<body>
<h1>Location Picker</h1>
<input type="text" id="locationInput" placeholder="Enter a location">
<div id="map"></div>
<div id="latlongDisplay"></div>

<script>
let map;
let marker;
let autocomplete;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 20.5937, lng: 78.9629 }, // Default center (India)
    zoom: 5,
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
  });
  marker = new google.maps.marker.AdvancedMarkerElement({
  map: map,
  draggable: true,
});


  autocomplete = new google.maps.places.Autocomplete(document.getElementById("locationInput"));

  autocomplete.addListener("place_changed", function () {
    let place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    updateLatLng(place.geometry.location.lat(), place.geometry.location.lng());
  });

  google.maps.event.addListener(marker, "dragend", function () {
    updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
  });

  google.maps.event.addListener(map, "click", function (event) {
    marker.setPosition(event.latLng);
    updateLatLng(event.latLng.lat(), event.latLng.lng());
  });

  // Listen for keyup event on the input for real-time updates
  document.getElementById("locationInput").addEventListener("keyup", function () {
    let inputText = this.value.trim();
    if (inputText !== '') {
      geocodeAddress(inputText);
    }
  });
}

function updateLatLng(latitude, longitude) {
  document.getElementById("latlongDisplay").innerHTML = `Latitude: ${latitude}<br>Longitude: ${longitude}`;
}

function geocodeAddress(address) {
  let geocoder = new google.maps.Geocoder();
  geocoder.geocode({ address: address }, function (results, status) {
    if (status === "OK" && results[0]) {
      let location = results[0].geometry.location;
      map.setCenter(location);
      map.setZoom(17);
      marker.setPosition(location);
      updateLatLng(location.lat(), location.lng());
    } else {
      window.alert("Geocode was not successful for the following reason: " + status);
    }
  });
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRQLQEDxc7SYhmET8csxmx3LUBiYnSnas&libraries=places&callback=initMap"></script>
</body>
</html>
