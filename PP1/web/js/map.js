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
        pending: 'n',
        inUse: 'n'
    },
    {
        id: 2,
        latitude: -37.782222,
        longitude: 145.166666,
        pending: 'n',
        inUse: 'n'
    },
    {
        id: 3,
        latitude: -37.785555,
        longitude: 145.163463,
        pending: 'n',
        inUse: 'n'
    }
];
function callDistance(userLatLng, car,fn) {

    var service = new google.maps.DistanceMatrixService();
    var origin = new google.maps.LatLng(userLatLng.latitude,userLatLng.longitude);
    var destination = new google.maps.LatLng(car.latitude,car.longitude);
    service.getDistanceMatrix(
        {
            origins: [origin],
            destinations: [destination],
            travelMode: 'WALKING'
        }, function callback(response, status){
         fn(response.rows[0].elements[0].distance.text);
    });
}
function displayPopupWindows(carMaker,carInfo,map,userLatLng) {
    callDistance(userLatLng, carInfo,function (distance) {
        var distanceStr=distance;
        let contentString = 'Car:'+carInfo.id+'</br>Distance: '+distanceStr+'</br><button>Rent</button>';

        let popupWindow = new google.maps.InfoWindow({
            content: contentString
        });
        carMaker.addListener('click', function() {
            popupWindow.open(map, carMaker);
        });
    })
}
function showCarsOnMap(userLatLng,map,carlist,image) {

    for (let i = 0; i < carlist.length; i++) {

        if(carlist[i].pending === 'y'||carlist[i].inUse === 'y'){
            continue;
        }


        let car = new google.maps.Marker({
            position: {
                lat: carlist[i].latitude,
                lng: carlist[i].longitude
            },
            icon: image,
            map: map
        });
        displayPopupWindows(car,carlist[i],map,userLatLng);
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

            let userLatLng = {
                latitude: user.getPosition().lat(),
                longitude: user.getPosition().lng()
            };
            showCarsOnMap(userLatLng, map, cars, image);


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