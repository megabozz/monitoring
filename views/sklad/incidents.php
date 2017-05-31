<?php

//use yii\data\ActiveDataProvider;
use yii\grid\GridView;

//$provider = new ActiveDataProvider(
//        [
//    'query' => $model->search(),
//    'sort' => [
////        'attributes' => [
////            
////        ],
//    ],
//        ]);

//$model->scenario = 'search';
$in = $model->columns;
$model->scenario = 'view';
$columns = $model->getColumns($in);
//var_dump($columns);exit;
GridView::begin([
    'dataProvider' => $model->search(),
    'filterModel' => $model,
    'columns' => $columns
]);
GridView::end();

//foreach($provider->models as $m){
//    var_dump($m->name);
//}
