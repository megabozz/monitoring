<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class SkladGroup extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public static function tableName() {
        return 'sklad_group';
    }

    public function rules() {
        return [
        ];
    }
    
}
