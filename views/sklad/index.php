<?php
/* @var $this yii\web\View */

use yii\grid\GridView;


GridView::begin([
    'dataProvider' => $modelDataProvider,
]);


GridView::end();