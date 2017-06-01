<?php
use \yii\widgets\ListView;

use yii\widgets\DetailView;

DetailView::begin([
    'model' => $model
    //'dataProvider' => $model,
    //'itemView' => '_view',
    //'layout' => "{pager}\n{summary}\n{items}\n{pager}",
]);


DetailView::end();