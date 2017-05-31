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
    'class' => ActionColumn::className(),
    'urlCreator' => function($action, $model, $key, $index) {
        //var_dump($this->context->id);
        $url = "{$this->context->id}/{$action}?id=" . $model->id;
        return $url;
    },
    'template' => '{view}{update}',
];

GridView::begin([
    'dataProvider' => $provider,
    'columns' => $columns,
]);
GridView::end();

