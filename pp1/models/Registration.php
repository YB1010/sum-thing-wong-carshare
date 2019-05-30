<?php

namespace app\models;

use Yii;
use yii\helpers\Console;

/**
 * This is the model class for table "registration".
 *
 * @property string $FirstName
 * @property string $LastName
 * @property string $email
 * @property string $password
 * @property string $passwordVerify
 * @property int $carId
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FirstName', 'LastName', 'email', 'password', 'passwordVerify'], 'required'],
            [['carId'], 'integer'],
            [['FirstName', 'LastName'], 'string', 'max' => 39],
            [['email'], 'string', 'max' => 50],
            [['password', 'passwordVerify'], 'string', 'max' => 40],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordVerify' => 'Password Verify',
            'carId' => 'Car ID',
        ];
    }

    /**
     * @return bool|null
     * validate the data
     * Insert the information to the database
     */
    public function signUp()
    {
        if (!$this->validate()) {
            return null;
        }
        $model = new Registration();
        $model->FirstName = $this->FirstName;
        $model->LastName = $this->LastName;
        $model->email = $this->email;
        $model->password = $this->password;
        $model->passwordVerify = $this->passwordVerify;
        if ($this->password == $this->passwordVerify) {
            $model->password = md5($model->password);
            $model->passwordVerify = md5($model->passwordVerify);
        }
        $session = Yii::$app->session;
        $session->open();
        $session->set('email', $this->email);
        return $model->save(false);
    }

    /**
     * @param $attribute
     * validate the password with the twice time input password
     */
    public function passwordCheck($attribute)
    {
        if ($this->password != $this->passwordVerify) {
            $this->addError($attribute, "Password does not match");
        }
    }

    /**
     * @param $email
     * @return Registration|null
     * find email
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @param $password
     * @return bool
     * validate password for sign in
     */
    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->auth_key === $authKey;
    }
}
