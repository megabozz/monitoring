<?php

namespace app\controllers;

//use app\controllers\MainController;
//use yii\helpers\ArrayHelper;

class AuthController extends DefaultController {

    public function behaviors() {
        $b = parent::behaviors();
        $b['access']['rules'][] = [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
        ];
        $b['access']['rules'][] = [
            'actions' => ['login'],
            'allow' => true,
            'roles' => ['?'],
        ];
        $b['verbs']['actions']['logout'] = ['post'];
        return $b;
    }

    public function actionLogin() {

        return $this->render('login');
    }
    public function actionLogout() {

        return $this->render('login');
    }

}
