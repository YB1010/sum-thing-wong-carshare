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
        'carImgUrl'
    ],
]);
$jsonData = json_encode($data);

if (!isset($_SESSION["email"])) {
    ?>
    Please <a href="index.php?r=registration%2Fsignin">login</a> first!

    <?php
} else {

    MapAsset::register($this);
    GoogleMapCallback::register($this);

    ?>
    <html>
    <head>
        <title><?= HTML::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #border {
                width: 40%;
                height: 720px;
                float: left;
                border: 3px solid red;
                position: relative;
                overflow-y: scroll
            }

            #son_div {
                margin-top: 20px;
                width: 100%;
                float: left;
                border: 3px solid red;
                position: relative;
            }

            #map {
                width: 60%;
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
                box-shadow: 0px 2px 10px 1px rgba(0, 0, 0, 0.5);
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

            #dataHolder {

            }
        </style>
    </head>
    <body>
    <script>
        var jsonObj = <?php echo $jsonData; ?>;
    </script>
    <div id="map"></div>
    <form action="" method="post" id="form">
        <div id="border">
            <?php
            for ($i = 0; $i < sizeof($data); $i++) {
                ?>
                <div id="son_div" style="border:1px solid gray;">
                    <div style="float:left;width:450px;">
                        <div style="width:450px;height:180px;"><img src="img/<?php echo $data[$i]['carImgUrl']; ?>">
                        </div>
                        <div style="width:450px;height:40px;font-size:25px;
				 	 margin-left: 20%"><b><?php echo $data[$i]['carName']; ?></b>&nbsp&nbsp <font size="1px"
                                                                                                   color="gray">or
                                Similar</font></div>
                    </div>
                    <div style="float:left;width:300px;margin-top:35px;">
                        <div style="width:300px;height:80px;float:left;
				 	 "><img src="tu.png" style="width: 30px;height: 40px">
                            &nbsp&nbsp&nbsp
                            <font color="gray" size="5px">Mileage</font>
                        </div>
                        <div style="width:300px;height:50px;float:left;
				 	 "><font size="4px" color="#26DB3C" id="tx<?php echo $i; ?>">
                                <script>
                                    console.log('#startClocking<?php echo $data[$i]['id']; ?>');
                                    console.log(document.getElementById('startClocking<?php echo $data[$i]['id']; ?>'));
                                </script>

                                <?php if ($data[$i]['pendingTime'] !== "off" || $data[$i]['inUse'] !== "available") {
                                    echo "Unlimited";
                                    //TODO DISABLE BUTTON?>
                                    <script>

                                        document.getElementById('startClocking<?php echo $i; ?>').style.visibility="hidden";
                                    </script>
                                <?php } else {
                                ?>
                                    <script>
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(function (position) {
                                                let lat = position.coords.latitude;
                                                let lng = position.coords.longitude;
                                                console.log(lat);
                                                let p1 = new google.maps.LatLng(lat, lng);
                                                let p2 = new google.maps.LatLng(<?php echo $data[$i]['latitude']; ?>, <?php echo $data[$i]['longitude']; ?>);
                                                let km = (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
                                                document.getElementById('tx<?php echo $i; ?>').innerHTML = km + " km per rental";
                                            });

                                        }
                                    </script>
                                    <?php
                                }
                                ?>
                            </font>
                        </div>
                        <div style="width:300px;height:50px;float:left;text-align: right
				 	 ">
                            <span id="count<?php echo $i; ?>"></span>
                            <button class="btn btn-primary" id="startClocking<?php echo $data[$i]['id'] ?>" name="booking2"
                                    style="">
                                Book<?php echo $data[$i]['id']; ?></button>
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                                   value="<?= Yii::$app->request->csrfToken; ?>"/>
                        </div>
                    </div>

                </div>
                <?php
            }
            ?>
        </div>
    </form>

    </body>
    </html>
<?php }
?>