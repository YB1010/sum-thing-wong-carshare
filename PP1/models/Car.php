<?php

namespace app\models;

use Yii;

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
}
