<?php

namespace app\controllers;

use app\models\db\IncidentByGroup;
use app\models\db\IncidentBySender;

class SkladController extends DefaultController {

    public function behaviors() {
        $b = parent::behaviors();

        // добавление правила авторизации
        $b['access']['rules'][] = [
            'allow' => true,
            // разрешённые actions для данного правила (если пусто то разрешены любые actions)
            'actions' => [
            ],
            // разрешённые roles для данного правила
            'roles' => [
                'admin',
            ],
        ];
        
        // добавление правила авторизации
        $b['access']['rules'][] = [
            'allow' => true,
            // разрешённые actions для данного правила
            'actions' => [
                'incidents_by_group',
                'incidents_by_sender',
            ],
            // разрешённые roles для данного правила
            'roles' => [
                'sklad',
            ],
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
        return $this->render('incidents', ['model' => $find, 'columns' => $columns]);
    }

    public function actionIncidents_by_sender() {
        $this->view->title = "SKLAD / INCIDENTS BY SENDER";
        $model = new IncidentBySender(['scenario' => 'view']);
        $find = $model->find();
        $columns = $model->getColumns();
        return $this->render('incidents', ['model' => $find, 'columns' => $columns]);
    }
     public function actionIncidents_by_group_spisok() {
        $this->view->title = "SKLAD / INCIDENTS BY GROUP SPISOK";
        $model = new IncidentByGroup(['scenario' => 'view']);
        $columns = $model->getColumns();
        $find = $model->find();
        return $this->render('incidents', ['model' => $find, 'columns' => $columns]);
    }
}
