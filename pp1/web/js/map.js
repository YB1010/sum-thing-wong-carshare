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
        var contentString = 'Car:'+carInfo.id+'</br>Distance: '+distanceStr+
            '<p><button class="btn btn-primary" id="startClocking0" name="booking2" value="'+carInfo.id+'">Book</button></p>';
        //var button = '<form action="" method="post" id="mapForm"> <input type="hidden" name="booking2" value="'+carInfo.id+'"><input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/><input type="submit" value="Book"></form>';
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
            image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            userLatLng = {
                latitude: user.getPosition().lat(),
                longitude: user.getPosition().lng()
            };
            makeCarMakers(userLatLng, map, cars, image);
            putCarMakers();


        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}
window.setInterval(function(){
    getCars();
    putCarMakers();
}, 5000);
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}
