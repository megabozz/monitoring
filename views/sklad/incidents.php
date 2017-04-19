<?php

use yii\data\ActiveDataProvider;

use yii\grid\GridView;
        $provider = new ActiveDataProvider(
                [
            'query' => $model,
            'sort' => [
                'attributes' => [
                ],
            ],
        ]);

GridView::begin([
    'dataProvider' => $provider,
]);


GridView::end();
