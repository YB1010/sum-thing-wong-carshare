<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 10/05/2019
 * Time: 2:30 PM
 */

/* @var $this \yii\web\View */
$this->title = 'Modify car details';

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
<?= $form->field($model, 'carName')->textInput(); ?>
<?= $form->field($model, 'carImgUrl')->textInput(); ?>
<?= $form->field($model, 'numOfPassenger')->textInput(); ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Update details', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php $form = ActiveForm::end() ?>
</body>