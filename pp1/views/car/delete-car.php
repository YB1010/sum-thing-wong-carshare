<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 6/05/2019
 * Time: 6:04 PM
 */

/* @var $this \yii\web\View */
$this->title = 'delete car';

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>
<head>
    <title><?= HTML::encode($this->title) ?></title>
</head>
<body>
<?php $form = ActiveForm::begin([
    'id' => 'Car',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'id')->textInput(); ?>
<?= $form->field($model, 'latitude')->textInput(); ?>
<?= $form->field($model, 'longitude')->textInput(); ?>
<?= $form->field($model, 'pendingTime')->textInput(); ?>
<?= $form->field($model, 'inUse')->textInput() ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Delete', ['class' => 'btn btn-primary']) ?>
        <p>Add the car page <a href="index.php?r=car/add-car">Add</a></p>
    </div>
</div>
<?php $form = ActiveForm::end() ?>
</body>