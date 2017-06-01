<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class SkladGroup extends BaseModel {

    public static function tableName() {
        return 'sklad_group';
    }

    public function rules() {
        return [
        ];
    }
    
}
