<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class DefaultController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) {


        if (Yii::$app->user->can('admin')) {

            if (!isset($this->view->params['menu'])) {
                $this->view->params['menu'] = [];
            }
            if (!isset($this->view->params['menu']['items'])) {
                $this->view->params['menu']['items'] = [];
            }

            $this->view->params['menu']['items'][] = [
                'label' => 'ADMIN', 'items' => [
                    ['label' => 'Users Manage', 'url' => ['admin/users']]
                ]
            ];
        }
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->view->title = "INDEX";
        return $this->render('index');
    }

}
