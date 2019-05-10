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
var cars = jsonObj;

function displayPopupWindows(carMaker,carInfo,map,userLatLng) {
    callDistance(userLatLng, carInfo,function (distance) {
        var distanceStr=distance;
        var contentString = 'Car:'+carInfo.id+'</br>Distance: '+distanceStr+
            '<p><form action="" method="post" id="mapForm"><button class="btn btn-primary" id="startClocking0" name="booking2" value="'+carInfo.id+'">Book</button></form></p>';
        //var button = '<form action="" method="post" id="mapForm"> <input type="hidden" name="booking2" value="'+carInfo.id+'"><input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/><input type="submit" value="Book"></form>';
        var popupWindow = new google.maps.InfoWindow({
            content: contentString
        });
        carMaker.addListener('click', function() {
            popupWindow.open(map, carMaker);
            $(document).ready(function() {
                $('#startClocking0').click(function () {
                    $('#mapForm').ajaxSubmit();
                });
            });
        });
    });
}
function showCarsOnMap(userLatLng,map,carlist,image) {

    for (let i = 0; i < carlist.length; i++) {

        if(carlist[i].pendingTime !== 'off'||carlist[i].inUse !== 'available'){
            continue;
        }


        let car = new google.maps.Marker({
            position: {
                lat: parseFloat(carlist[i].latitude),
                lng: parseFloat (carlist[i].longitude)
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
