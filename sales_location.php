<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- MapBox -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />

  </head>
  <body>
  <h1 style="text-align:center;"> Testing Sales Location from Admin </h1>
  <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 pt-5">
                <p id="simpanlt"></p>
                <p id="simpanlg"></p>
                <button id="location-button" class="btn btn-success btn-block">Track Sales Location</button>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row pt-3">
            <div class="col-4"></div>
            <div id="map" class="col-4 pt-5" style="width:100%; height:400px;"></div>
            <div class="col-4"></div>
        </div>
</div>
  

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script>
    $('#location-button').click(function(){
        var id = 2;
        mapboxgl.accessToken = 'pk.eyJ1IjoicmljaDIyMTEiLCJhIjoiY2t3MjdsYW1jMWc2aTJ4bm93aXM2M2o2dyJ9.c7ZebgZYwmK0xH-J0yhCVQ';

        $.ajax({
            url: '/ProyekManpro/services/get_location.php',
            method: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                //window.location = data['redirect'];
                console.log(data);
                $('#simpanlt').text(data['latitude']);
                $('#simpanlg').text(data['longitude']);
                // DRAW MAP
                let map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [data['latitude'], data['longitude']],
                    zoom: 13
                });
                let marker = new mapboxgl.Marker()
                    .setLngLat([data['latitude'], data['longitude']])
                    .addTo(map);
                map.addControl(
                    new mapboxgl.GeolocateControl({
                    positionOptions: {
                    enableHighAccuracy: true
                    },
                        // When active the map will receive updates to the device's location as it changes.
                    trackUserLocation: true,
                        // Draw an arrow next to the location dot to indicate which direction the device is heading.
                    showUserHeading: true
                    })
                );
            },
            error: function($xhr, textStatus, errorThrown) {
                 alert($xhr.responseJSON['error']);
            }
        });
    });
  </script>

  
  </body>
</html>

