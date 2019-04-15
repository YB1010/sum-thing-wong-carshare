/*jshint unused:false*/
/*jshint strict:false */
/*jshint esversion: 6 */
var map, infoWindow;

function Car(id, Lat, Lng, pending, inUse, carName,carImgUrl ) {
    this.id = id;
    this.Lat = Lat;
    this.Lng = Lng;
    this.pending = pending;
    this.inUse = inUse;
    this.carName = carName;
    this.carImgUrl = carImgUrl;
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

function displayPopupWindows(carMaker,carInfo,map,userLatLng) {
    callDistance(userLatLng, carInfo,function (distance) {
        var distanceStr=distance;
        let contentString = 'Car:'+carInfo.id+'</br>Distance: '+distanceStr+
            '</br><span id="count"></span><button class="btn btn-primary" id="startClocking" name="booking1">Book</button>';
        let popupWindow = new google.maps.InfoWindow({
            content: contentString
        });
        carMaker.addListener('click', function() {
            popupWindow.open(map, carMaker);
            $.getScript('js/jquery-3.3.1.min.js');
        });
    });
}
function showCarsOnMap(userLatLng,map,carlist,image) {

    for (let i = 0; i < carlist.length; i++) {

        if(carlist[i].pendingTime === 'true'||carlist[i].inUse === 'true'){
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
    infoWindow = new google.maps.InfoWindow();

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
