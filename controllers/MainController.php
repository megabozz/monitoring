<?php

namespace app\controllers;

//use Yii;
//use yii\filters\AccessControl;
//use app\controllers\DefaultController;
//use yii\filters\VerbFilter;

class MainController extends DefaultController
{
    public function behaviors()
    {
        $b = parent::behaviors();
        $b['access']['rules'][] = [
            'allow' => true,
        ];
        return $b;
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = "INDEX";
        return $this->render('index');
    }


}
