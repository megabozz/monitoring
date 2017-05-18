<?php

namespace app\models;

class Webuser extends \yii\web\User{
    public function can($permissionName, $params = array(), $allowCaching = true) {
        $roles = explode(',',($this->identity ? $this->identity->roles : ''));
        if(array_search($permissionName, $roles) !== false){
            return true;
        }
        return parent::can($permissionName, $params, $allowCaching);
    }
}
