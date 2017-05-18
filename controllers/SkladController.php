<?php

namespace app\controllers;

use app\models\db\IncidentByGroup;
use app\models\db\IncidentBySender;

class SkladController extends DefaultController {

    public function behaviors() {
        $b = parent::behaviors();
        $b['access']['rules'][] = [
            'allow' => true,
            'roles' => ['admin'],
        ];
        return $b;
    }

    public function actionIndex() {
        $this->view->title = "SKLAD";
        return $this->render('index');
    }

    public function actionIncidents_by_group() {
        $this->view->title = "SKLAD / INCIDENTS BY GROUP";
        $model = new IncidentByGroup(['scenario' => 'view']);
        $columns = $model->getColumns();
        $find = $model->find();
        return $this->render('incidents', ['model' => $find, 'columns'=> $columns]);
    }
    public function actionIncidents_by_sender(){
        $this->view->title = "SKLAD / INCIDENTS BY SENDER";
        $model = new IncidentBySender(['scenario'=>'view']);
        $find = $model->find();
        $columns = $model->getColumns();
        return $this->render('incidents', ['model' => $find, 'columns'=> $columns]);
        
    }

}
