<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $status
 * @property string $pendingTime
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
            [['status', 'pendingTime'], 'required'],
            [['status', 'pendingTime'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'pendingTime' => 'Pending Time',
        ];
    }

    public function pendingTime(){
        $model = new Car();
        if(isset($_POST['booking1'])){
            $model::updateAll(['status' => 'unavailable'], ['id' => '1']);
        }
    }

}
