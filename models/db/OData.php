<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;
//use app\models\Sklad;

class OData extends ActiveRecord {

    public static function getDb() {
        return Yii::$app->get('dbMonitoring');
    }

    public static function tableName() {
        return 'o_data';
    }

    public function rules() {
        return [
            [['id', 'date', 'receiver', 'sender', 'sender_id'], 'required', 'on' => ['create']],
            [['office_count', 'sender_count'], 'integer', 'on' => ['create', 'update']],
        ];
    }


//    public function beforeValidate() {
//        if ($this->isNewRecord) {
//            $sender = $this->getSkladByName($this->sender);
//            $this->sender_id = $sender->id;
//        }
//        return parent::beforeValidate();
//    }
    
}
