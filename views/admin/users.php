<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$provider = new ActiveDataProvider(
        [
    'query' => $model,
    'sort' => [
    ],
        ]);

GridView::begin([
    'dataProvider' => $provider,
    'columns' => $columns + [
        'class' => ActionColumn::className(),
        // you may configure additional properties here
    ],
]);
GridView::end();

