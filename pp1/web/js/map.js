/*jshint unused:false*/
/*jshint strict:false */
/*jshint esversion: 6 */
var map, infoWindow;

//get the cars data from database
var cars = jsonObj;

function getCars(){
    var t = $.getJSON(
        {
            type: 'POST',
            dataType: 'json',
            url: 'index.php?r=car/get-cars',
            complete: function(data) {
                // cars = data;
                cars = data.responseJSON;
            }
        }
    );

}
function displayPopupWindows(carMaker,carInfo,map,userLatLng) {
    callDistance(userLatLng, carInfo,function (distance) {
        var distanceStr=distance;
        var contentString = 'Car:'+carInfo.carName+'</br>Distance: '+distanceStr+
            '<p><form action="" method="post" id="mapForm"><button class="btn btn-primary" id="startClocking" name="booking2" value="'+carInfo.id+'">Book</button></form></p>';
        var popupWindow = new google.maps.InfoWindow({
            content: contentString
        });
        carMaker.addListener('click', function() {
            popupWindow.open(map, carMaker);

        });
    });
}
var image;
var userLatLng;
var carsMakers = [];

//only makeCarMakers Once. Because car assets have stable quality.
function makeCarMakers(userLatLng, map, carlist, image) {

    for (let i = 1; i <= carlist.length; i++) {

        let car = new google.maps.Marker({
            position: {
                lat: parseFloat(carlist[i-1].latitude),
                lng: parseFloat (carlist[i-1].longitude)
            },
            icon: image,
            //map: map
        });
        displayPopupWindows(car,carlist[i-1],map,userLatLng);
        carsMakers[parseInt(carlist[i-1].id)]=car;
    }

}

function putCarMakers() {
    for (let i = 1; i <= cars.length; i++) {
        if (cars[i-1].inUse === 'available' && cars[i-1].pendingTime === 'off'){
            carsMakers[i].setMap(map);
        }
        else {
            carsMakers[i].setMap(null);
        }
    }
    console.log(carsMakers.length);
}

try {
    var checkIfConfirm = document.getElementById('helper').value;
}catch (e) {

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
            });
            map.setCenter(pos);
//http://pngimg.com/uploads/taxi/taxi_PNG7.png
            image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            userLatLng = {
                latitude: user.getPosition().lat(),
                longitude: user.getPosition().lng()
            };

            if (checkIfConfirm  === 'confirm'){
                var directionsDisplay = new google.maps.DirectionsRenderer;
                var directionsService = new google.maps.DirectionsService;
                let carid = document.getElementById('helper2').value;
                let carSingleList = [
                    cars[carid-1]
                ];
                console.log(cars);
                console.log(carSingleList);

                makeCarMakers(userLatLng, map, carSingleList, image);
                carsMakers[carid].setMap(map);
                let detination = {
                    lat: parseFloat(carSingleList[0].latitude),
                    lng: parseFloat (carSingleList[0].longitude)
                };
                console.log(detination);
                directionsDisplay.setMap(map);
                calculateAndDisplayRoute(directionsService, directionsDisplay,pos,detination);
            }else{
                makeCarMakers(userLatLng, map, cars, image);
                putCarMakers();
            }


        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}
if (checkIfConfirm==null){
    window.setInterval(function(){
        getCars();
        putCarMakers();
    }, 5000);
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay,origin,destination) {
    directionsService.route({
        origin: origin,  // Haight.
        destination: destination,  // Ocean Beach.
        // Note that Javascript allows us to access the constant
        // using square brackets and a string value as its
        // "property."
        travelMode: 'WALKING'
    }, function(response, status) {
        if (status == 'OK') {
            new google.maps.DirectionsRenderer({
                map: map,
                directions: response,
                suppressMarkers: true
            });
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}
