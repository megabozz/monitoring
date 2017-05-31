<?php

namespace app\models\db;

use app\models\db\BaseModel;

class IncidentByGroup extends BaseModel {


    public static function tableName() {
        return 'incident_by_group';
    }

    public function rules() {
        return [
            [['name', 'ib_code', 'errors'], 'safe', 'on' => ['view']],
            [['name', 'ib_code'], 'safe', 'on' => ['search']],
        ];
    }
    
    public function attributeLabels() {
        return parent::attributeLabels() + [
            'name' => 'Наименование',
            'ib_code' => 'Код базы',
            'errors' => 'Ошибки',
        ];
    }
    
    
}
