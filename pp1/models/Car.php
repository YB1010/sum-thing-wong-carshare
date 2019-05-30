<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\web\UploadedFile;
/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $latitude
 * @property string $longitude
 * @property string $pendingTime
 * @property string $inUse
 * @property string $carName
 * @property string $carImgUrl
 * @property int $numOfPassenger
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude', 'pendingTime', 'inUse'], 'required','on'=>['add']],
            [['latitude', 'longitude'], 'string'],
            [['numOfPassenger'], 'integer'],
            [['id', 'carName','numOfPassenger'], 'required', 'on' => ['change']],
            [['pendingTime', 'inUse'], 'string', 'max' => 30],
            [['carImgUrl'],'file','extensions' => 'jpg,png,gif,jpeg'],
            [['carName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'pendingTime' => 'Pending Time',
            'inUse' => 'In Use',
            'carName' => 'Car Name',
            'carImgUrl' => 'Car Img Url',
            'numOfPassenger' => 'Num Of Passenger',
        ];
    }

    /**
     * Update database when user clicks on booking button
     */
    public function updateBookingStatus(){
        $command = Yii::$app->db->createCommand();
        $id= Yii::$app->request->bodyParams["booking2"];

        try {
                $command->update('car', ['pendingTime' => 'on', 'inUse' => 'pending'], 'id = '.$id)->execute();
        } catch (Exception $e) {
            printf("Cannot update data");
        }
    }


}
