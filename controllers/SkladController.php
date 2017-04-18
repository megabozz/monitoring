<?php

namespace app\controllers;

use app\models\db\SkladGroup;
use yii\data\ActiveDataProvider;

class SkladController extends DefaultController {

    public function behaviors() {
        $b = parent::behaviors();
        $b['access']['rules'][] = [
            'allow' => true,
            'roles' => ['?'],
        ];
        return $b;
    }

    public function actionIndex() {
        $sklad = SkladGroup::find()->orderBy([
            'name' => SORT_ASC
        ]);
        $skladProvider = new ActiveDataProvider([
            'query' => $sklad
        ]);


        return $this->render('index', ['modelDataProvider' => $skladProvider]);
    }

}
