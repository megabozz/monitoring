<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class Sklad extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public static function tableName() {
        return 'sklad';
    }

    public function rules() {
        return [
            [['name'], \yii\validators\UniqueValidator::className(), 'on' => ['create','update']],
        ];
    }
    
}
