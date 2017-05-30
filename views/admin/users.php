<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$provider = new ActiveDataProvider(
        [
    'query' => $model,
    'sort' => [
    ],
        ]);

$columns[] = [
    'class' => ActionColumn::className()
];

GridView::begin([
    'dataProvider' => $provider,
    'columns' => $columns,
        // you may configure additional properties here
   
]);
GridView::end();

