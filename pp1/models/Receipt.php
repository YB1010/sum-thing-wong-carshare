<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property string $email
 * @property int $carId
 * @property string $startDate
 * @property int $balance
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'carId', 'startDate', 'balance'], 'required'],
            [['carId', 'balance'], 'integer'],
            [['startDate'], 'safe'],
            [['email'], 'string', 'max' => 30],
            [['email', 'carId', 'startDate'], 'unique', 'targetAttribute' => ['email', 'carId', 'startDate']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'carId' => 'Car ID',
            'startDate' => 'Start Date',
            'balance' => 'Balance',
        ];
    }

    /**
     * @return bool
     * add the timestamp, balance and carId to the receipt table
     */
    public function addRecord(){
        $model = new Receipt();
        $email = Yii::$app->session->get('email');
        date_default_timezone_set('Australia/Melbourne');
        $startDate = date("Y-m-d H:i:s");
        $model->email = $email;
        $model->carId = $_SESSION['carID'];
        $model->startDate = $startDate;
        $model->balance = 50;
        return $model->save(false);
    }

}
