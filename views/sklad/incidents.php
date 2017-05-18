<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$provider = new ActiveDataProvider(
        [
    'query' => $model,
    'sort' => [
//        'attributes' => [
//            
//        ],
    ],
        ]);

GridView::begin([
    'dataProvider' => $provider,
    'columns' => $columns
]);
GridView::end();

//foreach($provider->models as $m){
//    var_dump($m->name);
//}
