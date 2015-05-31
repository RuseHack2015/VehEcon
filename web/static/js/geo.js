/**
 * Created by Pavel Zlatarov on 30.5.2015 г..
 */
$(function () {
    geolocate();
});

function geolocate(){
    $('#status_message').html('Waiting for geolocation...');
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(getStations,handleErrors);
    } else{
        $('#status_message').html('Your browser does not appear to support geolocation. Sorry.');
    }
}

function getStations(position){
    $('#status_message').html('Geolocation successful!');
    $('#latitude').html(position.coords.latitude.toFixed(4));
    $('#longtitude').html(position.coords.longitude.toFixed(4));
    $('#location').show();
    $('#loc_status').hide();
    getFromApi(position.coords.latitude,position.coords.longitude);
}

function handleErrors(error){
    switch(error.code){
        case error.PERMISSION_DENIED:
            $('#status_message').html('Seems that the geolocation request was denied. Please allow geolocation next time :)');
            break;
        case error.POSITION_UNAVAILABLE:
            $('#status_message').html('We were unable to locate you. :(');
            break;
        case error.TIMEOUT:
            $('#status_message').html('Looks like it took too long to locate you. Refresh the page and try again.');
            break;
        case error.UNKNOWN_ERR:
            $('#status_message').html('Something went wrong. We\'re unsure what. Sorry. :(');
            break;
    }
}

function getFromApi(lat,lon){
    $('#station').show();
    var req = $.ajax({
        url: 'getstations/stations/'+lat+'/'+lon,
        type: 'GET',
        dataType: 'json'
    });

    req.done(function (json){
        if(json.status == 'OK'){
            var station = json.gasstations[0];
            $('#station_info').html('<div class="alert alert-success">The nearest gas station is '+station.brand_name+' '+station.name+' '+' at '+station.distance.toFixed(2)+' km. It\'s located in '+station.city+' and its address is "'+station.address+'".</div>');
            initMap(station.lat,station.lon,lat,lon);
            $('#map').show();
        } else{
            $('#station_info').html('<div class="alert alert-danger">Failed to retrieve data from the server.</div>');
        }
    });

    req.fail(function () {
        $('#station_info').html('<div class="alert alert-danger">Failed to retrieve data from the server.</div>');
    });
}

function initMap(latitude,longitude,yourlat,yourlng) {
    var mapOptions = {
        center: { lat: latitude, lng: longitude},
        zoom: 16
    };
    var map = new google.maps.Map(document.getElementById('map-frame'),
        mapOptions);


   // marker_myloc.setMap(map);
    //marker_station.setMap(map);
    var directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(map);
    var request = {
        origin: new google.maps.LatLng(yourlat,yourlng),
        destination: new google.maps.LatLng(latitude,longitude),
        // Note that Javascript allows us to access the constant
        // using square brackets and a string value as its
        // "property."
        travelMode: google.maps.TravelMode['DRIVING']
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}


