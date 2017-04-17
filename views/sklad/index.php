<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$dp = new ActiveDataProvider([
    'query' => $model
]);

GridView::begin([
    'dataProvider' => $dp,
]);


GridView::end();