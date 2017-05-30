<?php

namespace app\models\db;

use app\models\db\BaseModel;

class IncidentByGroupSpisok extends BaseModel {


    public static function tableName() {
        return 'incident_by_group_spisok';
    }

    public function rules() {
        return [
            [['date', 'name', 'order_id', 'errors', 'receiver'], 'safe', 'on' => ['view']],
        ];
    }
    
    public function attributeLabels() {
        return parent::attributeLabels() + [
            'date' => 'Дата',
            'name' => 'Наименование',
            'ib_code' => 'Код базы',
            'errors' => 'Ошибки',
            'receiver'=> 'Магазин',
        ];
    }
    
    
}
