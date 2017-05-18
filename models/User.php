<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface {

//    public $id;
//    public $username;
//    public $password;
    public $authKey;
    public $accessToken;
    public $_ADinfo;

    public static function getDb() {
        return Yii::$app->dbMonitoring;
    }

    public static function tableName() {
        return 'users';
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
        //return User::find()->where('id=:id', ['id' => $id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null) {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function setADinfo($adinfo) {
        Yii::$app->session->set('user.adinfo', $adinfo);
    }

    public function getADinfo() {
        if (!$this->_ADinfo) {
            $this->_ADinfo = Yii::$app->session->get('user.adinfo');
        }
        return $this->_ADinfo;
    }

    public function getADfield($field) {
        if ($this->ADinfo && isset($this->ADinfo[$field]) && count($this->ADinfo[$field]) > 0) {
            return $this->ADinfo[$field][0];
        }
        return '';
    }

}
