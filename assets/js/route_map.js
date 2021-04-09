    function initAutocomplete() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13,
        mapTypeId: 'roadmap'
      });

      geocoder = new google.maps.Geocoder();

      // Create the search box and link it to the UI element.
      var input = document.getElementById('pac-input');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });
      
      var markers = [];
      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        //console.log(places);
        if (places.length == 0) {
          return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
          marker.setMap(null);
        });

          /*marker = new google.maps.Marker({
          position: latLng,
          title: 'Point A',
          map: map,
          draggable: true
        });*/
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {
          if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
          }
          var icon = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };

          // Create a marker for each place.
          markers.push(new google.maps.Marker({
            map: map,
            icon: icon,
            title: place.name,
            position: place.geometry.location,
            //draggable: true
          }));

          var marker = new google.maps.Marker({
          position: place.geometry.location,
          title: 'Point A',
          map: map,
          draggable: true
          });



  // Update current position info.
  updateMarkerPosition(place.geometry.location);
  geocodePosition(place.geometry.location);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
   });

   google.maps.event.addListener(marker, 'dragend', function() {
     updateMarkerStatus('Drag ended');
     geocodePosition(marker.getPosition());
   });
       /* marker = new google.maps.Marker({
          position: latLng,
          title: 'Point A',
          map: map,
          draggable: true
        });
      */
          //console.log(place.geometry.location.lat());

          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
          //console.log(place.geometry.location);
         // alert();
        });
        map.fitBounds(bounds);
        
      });
    }

    function updateMarkerStatus(str) {
//document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
document.getElementById('info').innerHTML = [
  latLng.lat(),
  latLng.lng()
].join(', ');
//geocodePosition(latLng);

}

function updateMarkerAddress(str) {
 //document.getElementById('address').innerHTML = str;
}


function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      // console.log([pos.lat(), pos.lng(),responses[0].formatted_address].join(', '));
       console.log(responses[0].formatted_address);
    } else {
      return 'Cannot determine address at this location.';
    }
  });
}

