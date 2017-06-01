<?php

namespace app\controllers;

use Yii;
use app\helpers\Ldap;

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
            'roles' => ['@', '?'],
        ];
        //$b['verbs']['actions']['login'] = ['post'];
        return $b;
    }

    public function actionLogin() {

        if (Yii::$app->user->isGuest) {
            $model = new \yii\base\DynamicModel([
                'login',
                'password',
            ]);
            $model->addRule(['login', 'password'], 'required');
            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if ($model->validate()) {
                    $identity = \app\models\User::findOne([
                                'login' => $model->login,
                                'password' => $model->password,
                                'active' => 1,
                    ]);
                    if ($identity) {
                        //$ADinfo = Ldap::getUserInfo($model->login, $model->password);
                        //if ($ADinfo) {
                        if ($e = Yii::$app->user->login($identity)) {
                            //Yii::$app->user->identity->ADinfo = $ADinfo;
                            //Yii::$app->session['user.adinfo'] = $ADinfo;
                            return $this->redirect(\yii\helpers\Url::previous());
                        }
                        //}
                    }else{
                        $model->login = $model->password = '';
                    }
                }
            }
            

            return $this->render('login', ['model' => $model]);
        }
        return $this->redirect('/');
    }

    public function actionLogout() {

        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->redirect('/');
    }

}
