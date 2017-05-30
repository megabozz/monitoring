<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class BaseModel extends ActiveRecord {

    
    
    public static function getDb() {
        return Yii::$app->get('db_monitoring');
    }

    public function getColumns(array $in = []) {
        $columns = [];
        foreach ($this->safeAttributes() as $k => $v) {
            $f = ['attribute' =>  $v];
            if($in && !isset($in[$v])){
                $f['filter'] = false;
            }
            $columns[$v] = $f;
        }
        
        return $columns;
    }
    public function search() {
        $query = $this->find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $attributes = [];
        foreach ($this->getColumns() as $c) {
            $attributes[] = $c['attribute'];
            $query->andFilterWhere(['like', $c['attribute'], $this->getAttribute($c['attribute']) ]);
        }
        $dataProvider->setSort([
            'attributes' => $attributes
        ]);
        return $dataProvider;
    }
    public function filter(){
        $this->scenario = 'view';
        return $this;
    }

}
