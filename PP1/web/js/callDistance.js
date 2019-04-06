/*jshint unused:false*/
/*jshint strict:false */
/*jshint esversion: 6 */

/**
 * @param {object} userLatLng - user's latitude and longitude
 * @param {number} userLatLng.latitude
 * @param {number} userLatLng.longitude
 * @param {object} car - car object
 * @param {number} car.latitude
 * @param {number} car.longitude
 * @callback {function} fn(response,status)
 *             the function is called, after the distance is calculated
 *             response {string}: the distance in string
 *             status {boolean}: whether a change has occurred
 *
 * call this function to calculate the distance between two object
 */
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