<?php

namespace app\models\db;

use app\models\db\BaseModel;

class IncidentBySender extends BaseModel {

    public static function tableName() {
        return 'incident_by_sender';
    }

    public function rules() {
        return [
            [['name','errors'],'safe','on'=>['view']],
            [['name'],'safe','on'=>['search']],
        ];
    }
    public function attributeLabels() {
        return parent::attributeLabels() + [
            'name' => 'Наименование',
            'errors' => 'Ошибки',
        ];
    }
    
}
