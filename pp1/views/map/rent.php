<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 2/04/2019
 * Time: 11:53 AM
 */

/* @var $this \yii\web\View */
use app\models\Car;
use app\assets\MapAsset;
MapAsset::register($this);

use app\assets\GoogleMapCallback;
GoogleMapCallback::register($this);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

</head>
<body>


</body>
</html>
