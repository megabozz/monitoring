<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class IncidentByGroup extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public static function tableName() {
        return 'incident_by_group';
    }

    public function rules() {
        return [
        ];
    }
    
}
