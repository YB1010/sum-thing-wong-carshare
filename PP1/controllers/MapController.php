<?php
/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 2/04/2019
 * Time: 11:48 AM
 */

namespace app\controllers;


use app\models\MapForm;
use yii\web\Controller;

class MapController extends Controller
{
    public function actionRent(){
        $model = new MapForm();
//        $model->pendingTime();
        return $this->render('rent');
//        return $this->redirect(['map/rent']);
    }



}