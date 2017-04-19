<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class IncidentBySender extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public static function tableName() {
        return 'incident_by_sender';
    }

    public function rules() {
        return [
        ];
    }
    
}
