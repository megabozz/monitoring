<?php

namespace app\controllers;

use app\models\db\IncidentByGroup;
use app\models\db\IncidentBySender;

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
        $this->view->title = "SKLAD";
        return $this->render('index');
    }

    public function actionIncidents_by_group() {
        $this->view->title = "SKLAD / INCIDENTS BY GROUP";
        $model = IncidentByGroup::find();
        return $this->render('incidents', ['model' => $model]);
    }
    public function actionIncidents_by_sender(){
        $this->view->title = "SKLAD / INCIDENTS BY SENDER";
        $model = IncidentBySender::find();
        return $this->render('incidents', ['model' => $model]);
        
    }

}
