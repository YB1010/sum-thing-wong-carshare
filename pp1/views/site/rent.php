<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\AppAsset;

use app\assets\MapAsset;
MapAsset::register($this);

$this->title = 'Rent';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<html>
<body>

<div id="map"></div>>
</body>

</html>
