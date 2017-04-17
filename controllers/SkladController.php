<?php

namespace app\controllers;

use app\models\db\Sklad;


class SkladController extends DefaultController {
    
    public function behaviors() {
        $b = parent::behaviors();
        $b['access']['rules'][] = [
            'allow' => true,
            'roles' => ['?'],
        ];
        return $b;
    }
    
    public function actionIndex(){
        $sklad_m = Sklad::find()
                ->groupBy(['kod_ib'])
                ->distinct(true);
        return $this->render('index', ['model' => $sklad_m]);
    }
    
    
}
