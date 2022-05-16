<!DOCTYPE html>

<?php 
//print_r($latlong_details[0]->Latitude);
  if(count($latlong_details) > 0)
  {
    $lat_single = $latlong_details[0]->Latitude;
    $long_single = $latlong_details[0]->Longitude;
    $city_single = $latlong_details[0]->City;
  }
  else
  {
    $lat_single = '';
    $long_single = '';
    $city_single = '';
  }
?>
<html>
  <head>
    <title>Complex Marker Icons</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
    <style type="text/css">
    	/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <input type="hidden" id="lat_details" value="{{$latlong_details}}">
    <input type="hidden" id="lat_single" value="{{$lat_single}}">
    <input type="hidden" id="long_single" value="{{$long_single}}">
    <input type="hidden" id="city_single" value="{{$city_single}}">
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgvvPpyxo3IjhB-CMG7wCgCHcYvV7FJxU&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    	// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.
/*$(document).ready(function(){
  var lat_single = $('#lat_single').val();
  var long_single = $('#long_single').val();
  var city_single = $('#city_single').val();
  alert(lat_single);
});*/
function initMap() {
  
  var lat_single = $('#lat_single').val();
  var long_single = $('#long_single').val();
  var city_single = $('#city_single').val();
  // alert(lat_single);

  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    // center: { lat: -33.9, lng: 151.2 },
    center: { lat: 28.578380, lng:77.320220 },
  });

  setMarkers(map);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
var lat_details = $('#lat_details').val();
alert(lat_details);
$.each(lat_details, function( key, value ) {
  alert(value);
});
const beaches = [
  ["Expedien eSolution", 28.578380, 77.320220, 4],
  ["Sector 62", 28.6280, 77.3649, 5],
  // ["Cronulla Beach", -34.028249, 151.157507, 3],
];

function setMarkers(map) {
  // Adds markers to the map.
  // Marker sizes are expressed as a Size of X,Y where the origin of the image
  // (0,0) is located in the top left of the image.
  // Origins, anchor positions and coordinates of the marker increase in the X
  // direction to the right and in the Y direction down.
  const image = {
    url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(20, 32),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 32).
    anchor: new google.maps.Point(0, 32),
  };
  // Shapes define the clickable region of the icon. The type defines an HTML
  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
  // The final coordinate closes the poly by connecting to the first coordinate.
  const shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: "poly",
  };

  for (let i = 0; i < beaches.length; i++) {
    const beach = beaches[i];

    new google.maps.Marker({
      position: { lat: beach[1], lng: beach[2] },
      map,
      icon: image,
      shape: shape,
      title: beach[0],
      zIndex: beach[3],
    });
  }
}
    </script>
  </body>
</html>