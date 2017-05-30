<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;

class AdminController extends DefaultController {

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
        
        return $b;
    }

    
    public function actionIndex() {
        $this->view->title = "ADMIN";
        return $this->render('index');
    }
    public function actionUsers() {
        $this->view->title = "USERS";
        
        $model = new User(['scenario' => 'view']);
        $columns = $model->columns;
        $find = $model->find();
        return $this->render('users', ['model' => $find, 'columns' => $columns]);
    }

}
