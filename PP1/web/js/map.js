/*jshint unused:false*/
/*jshint strict:false */
/*jshint esversion: 6 */

var map, infoWindow;
function Car(id, Lat, Lng, pending, inUse) {
    this.id = id;
    this.Lat = Lat;
    this.Lng = Lng;
    this.pending = pending;
    this.inUse = inUse;
}

//get the cars data from database
var cars = [
    {
        id: 1,
        latitude: -37.781827,
        longitude: 145.167733,
        pending: false,
        inUse: false
    },
    {
        id: 2,
        latitude: -37.782222,
        longitude: 145.166666,
        pending: false,
        inUse: false
    },
    {
        id: 3,
        latitude: -37.785555,
        longitude: 145.163463,
        pending: false,
        inUse: false
    }
];
function showCarsOnMap(map,carlist,image) {

    for (let i = 0; i < carlist.length; i++) {
        if(carlist[i].pending||carlist[i].inUse){
            continue;
        }
        let contentString = 'Car:'+carlist[i].id+'</br><button>Rent</button>';

        let popupWindow = new google.maps.InfoWindow({
            content: contentString
        });
        let car = new google.maps.Marker({
            position: {
                lat: carlist[i].latitude,
                lng: carlist[i].longitude
            },
            icon: image,
            map: map
        });
        car.addListener('click', function() {
            popupWindow.open(map, car);
        });
    }

}
 
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 18
        //18
    });
    infoWindow = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var user = new google.maps.Marker({
                position: pos,
                map: map,
                title: 'Hello World!'
            });
            map.setCenter(pos);
//http://pngimg.com/uploads/taxi/taxi_PNG7.png
            var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            showCarsOnMap(map,cars,image);


        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}
window.alert(document.getElementById('map').innerText);