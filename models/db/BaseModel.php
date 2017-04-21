<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public function getColumns() {
        $columns = [];
        foreach ($this->safeAttributes() as $k => $v) {
            $columns[$v] = $v;
        }
        return $columns;
    }

}
