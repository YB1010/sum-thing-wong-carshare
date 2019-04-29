<?php

/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 16/03/2019
 * Time: 7:10 PM
 */

/* @var $this \yii\web\View */
$this->title = 'Sign in';
$this->params['breadcrumbs'][] = ['label' => 'registration', 'url' => ['signin']];
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html; ?>
<head>
    <title><?= HTML::encode($this->title) ?></title>
</head>
<body>
<?php $form = ActiveForm::begin([
    'id' => 'Registration',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'email')->textInput(['placeholder'=>Yii::t('app','Email')]); ?>
<?= $form->field($model, 'password')->passwordInput(['id'=>'password']); ?>

<?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= HTML::submitButton('Sign in', ['class' => 'btn btn-primary']) ?>
        <p>Apply for an account <a href="index.php?r=registration/signup">Sign up</a></p>
    </div>
</div>
<?php ActiveForm::end() ?>
</body>
