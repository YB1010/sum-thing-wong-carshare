<?php

namespace app\models;

use dosamigos\google\maps\Size;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $latitude
 * @property string $longitude
 * @property string $pendingTime
 * @property string $inUse
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude', 'pendingTime', 'inUse'], 'required'],
            [['latitude', 'longitude'], 'string'],
            [['pendingTime', 'inUse'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'pendingTime' => 'Pending Time',
            'inUse' => 'In Use',
        ];
    }
    public function updateBookingStatus(){
        $command = Yii::$app->db->createCommand();

        $dataArray = Car::find()->asArray()->all();
        try {
//            for($i=0;$i<sizeof($dataArray);$i++){
                $command->update('car', ['pendingTime' => 'on', 'inUse' => 'pending'], 'id = 1')->execute();
//            }

        } catch (Exception $e) {
            printf("Cannot update data");
        }
    }

    public function addCars(){
        if(!$this->validate()){
            return null;
        }
        $model = new Car();
        $model->id = $this->id;
        $model->latitude = $this->latitude;
        $model->longitude = $this->longitude;
        $model->pendingTime = $this->pendingTime;
        $model->inUse = $this->inUse;
        return $model->save(false);
    }

    public function deleteCars(){
        if(!$this->validate()){
            return null;
        }
        $model = new Car();
        $model->id = $this->id;
        $model->latitude = $this->latitude;
        $model->longitude = $this->longitude;
        $model->pendingTime = $this->pendingTime;
        $model->inUse = $this->inUse;
        $id = $_POST['deleteId'];
        $user = Car::find()->where(['id'=>$id])->one();
        $user->delete();

    }
    public function test(){
        $user = Car::find()->where(['id'=>'12'])->one();
        $user->delete();
    }

}
