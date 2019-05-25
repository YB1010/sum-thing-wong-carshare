<?php
/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 4/04/2019
 * Time: 4:36 PM
 */
/* @var $this \yii\web\View */
use app\assets\AppAsset;
use app\models\Car;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\assets\MapAsset;
use app\assets\GoogleMapCallback;
\app\assets\AppAsset::register($this);
MapAsset::register($this);
GoogleMapCallback::register($this);
$this->title = 'Booking car';
$cars = Car::find()->orderBy('id')->all();
$data = ArrayHelper::toArray($cars, [
    'app\models\Car' => [
        'id',
        'latitude',
        'longitude',
        'pendingTime',
        'inUse',
        'carName',
        'carImgUrl',
        'numOfPassenger'
    ],
]);
$jsonData = json_encode($data);
?>
<head>
    <title><?= HTML::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #border{
            width: 60%;
            height: 720px;
            float: left;
            position: relative;
        }
        #map{
            width: 40%;
            height: 720px;
            float: right;
        }
        /* Optional: Makes the sample page fill the window. */
        /* The popup bubble styling. */
        .popup-bubble {
            /* Position the bubble centred-above its parent. */
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(-50%, -100%);
            /* Style the bubble. */
            background-color: white;
            padding: 5px;
            border-radius: 5px;
            font-family: sans-serif;
            overflow-y: auto;
            max-height: 60px;
            box-shadow: 0px 2px 10px 1px rgba(0,0,0,0.5);
        }
        /* The parent of the bubble. A zero-height div at the top of the tip. */
        .popup-bubble-anchor {
            /* Position the div a fixed distance above the tip. */
            position: absolute;
            width: 100%;
            bottom: /* TIP_HEIGHT= */ 8px;
            left: 0;
        }
        /* This element draws the tip. */
        .popup-bubble-anchor::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            /* Center the tip horizontally. */
            transform: translate(-50%, 0);
            /* The tip is a https://css-tricks.com/snippets/css/css-triangle/ */
            width: 0;
            height: 0;
            /* The tip is 8px high, and 12px wide. */
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: /* TIP_HEIGHT= */ 8px solid white;
        }
        /* JavaScript will position this div at the bottom of the popup tip. */
        .popup-container {
            cursor: auto;
            height: 0;
            position: absolute;
            /* The max width of the info window. */
            width: 200px;
        }
    </style>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>
<body >

<h1 style="margin-left: -150px;margin-top: 50px">Socar</h1>
<script>
</script>
<div id="map"></div>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
    <script>
        var jsonObj = <?php echo $jsonData; ?>;
        jsdata =[];
    </script>
    <?php
    foreach ($data as $k => $v) {
        ?>
        <script>
            jsdata['<?php echo $k;?>'] = [];
        </script>
        <?php
            foreach ($v as $kk => $vv){
        ?>
        <script>
            jsdata['<?php echo $k;?>']['<?php echo $kk;?>'] = "<?php echo $vv;?>";
        </script>

        <?php
        }
    }
    ?>
    <script>
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    for (i = 0; i < jsdata.length; i++) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        var p1 = new google.maps.LatLng(lat, lng);
                        var p2 = new google.maps.LatLng(jsdata[i]['latitude'], jsdata[i]['longitude']);
                        var km = (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
                        jsdata[i]['km'] = km;
                    }
                    for(i = 0; i < jsdata.length; i++){
                        for(j=i+1;j<jsdata.length;j++){
                            if(eval(jsdata[i]['km'])>eval(jsdata[j]['km'])){
                                var tmp = jsdata[i];
                                jsdata[i] = jsdata[j];
                                jsdata[j] = tmp;
                            }
                        }
                    }
                    var root = document.getElementById("border");
                    function get() {
                        var html = '';
                        for(var i=0;i<jsdata.length;i++){
                            if(jsdata[i]['inUse']=="available"){
                                var div='<div  style="background:white;border:2px solid blue;border-radius:25px;margin-top: 3px;width: 100%;height:150px;" float:left ;class="panel-body">' +
                                    '<div style="float:left;width:240px;margin-left:10px" >' +
                                    '<div ><img id="'+"img"+i+'" style="width:240px;height:100px;margin-top: 10px" src="'+"img/"+jsdata[i]['carName']+".jpg"+'"></div>' +
                                    '<div style="width:240px;height:30px;font-size:25px;text-align: center"><b><div id="'+"carname"+i+'">'+jsdata[i]['carName']+'</div></b></div>' +
                                    '</div>' +
                                    '<div style="float:left;width:240px;height:150px;text-align:center;"><div style="margin-top:55px;" id="'+"people"+i+'" >'+"people :"+jsdata[i]['numOfPassenger']+'</div><div id="'+"km"+i+'">'+"kilometer:"+jsdata[i]['km']+" km "+'</div> </div>' +
                                    '<div style="width:140px;height:150px;float:left;margin-left:-10px;text-align: right"><span id="count"></span><button class="btn btn-primary" id="startClocking" value="'+jsdata[i]['id']+'" name="booking2" style="width: 140px;text-align:center;margin-top:55px;">Book</button> </div>' +
                                    '</div>';
                                html+=div;
                            }
                        }
                        root.innerHTML = html;
                    }
                    get();
                });
            }
    </script>


<form action="" method="post" id="form">

    <div id="border"   >
    </div>
</form>


</body>