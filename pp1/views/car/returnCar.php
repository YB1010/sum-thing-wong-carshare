<?php

use app\assets\AppAsset;
use app\models\Car;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\assets\MapAsset;
use app\assets\GoogleMapCallback;
\app\assets\AppAsset::register($this);


?>

<h1>Thanks For your use</h1>

<form action="index.php?r=car/return-car" method="post" id="mapForm"><button class="btn btn-primary" id="startClocking" name="booking2" value="return">return</button>
