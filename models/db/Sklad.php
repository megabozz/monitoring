<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

class Sklad extends BaseModel {

    public static function tableName() {
        return 'sklad';
    }

    public function rules() {
        return [
            [['name'], \yii\validators\UniqueValidator::className(), 'on' => ['create', 'update']],
        ];
    }

}
