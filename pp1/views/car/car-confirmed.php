<?php
/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 11/04/2019
 * Time: 7:44 PM
 */
use app\assets\PaypalCallback;
use app\models\Car;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/* @var $this \yii\web\View */
\app\assets\AppAsset::register($this);
PaypalCallback::register($this);
use app\assets\MapAsset;
use app\assets\GoogleMapCallback;
MapAsset::register($this);
GoogleMapCallback::register($this);
$cars = Car::find()->orderBy('id')->all();
$data = ArrayHelper::toArray($cars, [
    'app\models\Car' => [
        'id',
        'latitude',        'longitude',
        'pendingTime',
        'inUse',
        'carName',
        'carImgUrl',
        'numOfPassenger'
    ],
]);
$jsonData = json_encode($data);
echo "<input type=\"hidden\" name=\"helper\" id=\"helper2\" value=\"".$_SESSION['carID']."\" />";
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map{
            width: 100%;
            height: 763px;
            float: right;
        }
        #paypal-button-container{
            width: 20%;
            float: left;
            position: relative;
        }
    </style>
</head>
<body onload="pendingTime()" style="text-align:center;">
<script>
    var jsonObj = <?php echo $jsonData; ?>;
    jsdata =[];
</script>
<div id="confirm-page">
<input type="hidden" name="helper" id="helper" value="confirm" />
<h1>The car is booked for you</h1>
    <h2>Please following the map to get the car in
        <span id="count" ></span></h2>
    <div id="map"></div>
<div id="paypal-button-container">To confirm the book</div>

</div>
</body>