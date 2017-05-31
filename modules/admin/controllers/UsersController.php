<?php

namespace app\modules\admin\controllers;

use app\models\User;
use Yii;

class UsersController extends DefaultController {

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

    public function actionIndex($id = '') {
        $this->view->title = "USERS";
        $model = new User(['scenario' => 'view']);
        $columns = $model->columns;
        $find = $model->find();
        return $this->render('index', ['model' => $find, 'columns' => $columns]);
    }

    public function actionView($id) {
        $this->view->title = "VIEW USER";
        $model = User::findOne(['id' => $id]);
        if ($model) {
            $model->scenario = 'view';
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $this->view->title = "UPDATE USER";
        $model = User::findOne(['id' => $id]);
        if ($model) {
            $model->scenario = 'update';
            $model->roles = explode(',', $model->roles);
        }
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if (is_array($model->roles)) {
                        $model->roles = implode(',', $model->roles);
                    }
                    $model->save();
                    $this->redirect(Yii::$app->urlManager->createUrl('admin/users'));
                }
            } else {
                
            }
        }
        return $this->render('update', ['model' => $model]);
    }
    public function actionCreate() {
        $this->view->title = "CREATE USER";
        $model = new User(['scenario' => 'create']);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if (is_array($model->roles)) {
                        $model->roles = implode(',', $model->roles);
                    }
                    $model->save();
                    $this->redirect(Yii::$app->urlManager->createUrl('admin/users'));
                }
            } else {
                
            }
        }
        return $this->render('update', ['model' => $model]);
    }

}
