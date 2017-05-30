<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            
            <?php
            
            $uitem = [ 'label' => 'GUEST', 'items' => []];
            if(!Yii::$app->user->isGuest){
                    if($d = Yii::$app->user->identity->getADfield('displayname')){
                    $uitem['label'] = $d;
                }else{
                    $uitem['label'] = Yii::$app->user->identity->login;
                }
                if($d = Yii::$app->user->identity->getADfield('description')){
                    $uitem['items'][] = ['label' => $d];
                }
                if($d = Yii::$app->user->identity->getADfield('telephonenumber')){
                    $uitem['items'][] = ['label' => $d];
                }
                if($d = Yii::$app->user->identity->getADfield('mail')){
                    $uitem['items'][] = ['label' => $d];
                }
                $uitem['items'][] = ['label' => 'Logout', 'url' => '/auth/logout'];
            }
                //'label' => Yii::$app->user->isGuest ? 'GUEST' : Yii::$app->user->identity->getFullName()];
            
            
            NavBar::begin([
                'brandLabel' => 'MONITORING',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-left',
                ],
            ]);
            echo "<img height ='50' width = '500' src= monitoring/logo.jpg>";
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
            ['label' => 'SKLAD', 'items' => [
                ['label' => 'Incidents by group', 'url' => ['/sklad/incidents_by_group']],
                ['label' => 'Incidents by sender', 'url' => ['/sklad/incidents_by_sender']],
                ['label' => 'Incidents by group spisok', 'url' => ['/sklad/incidents_by_group_spisok']],
            ]],
            $uitem,
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <div id="breadcrumbs">
                    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
                </div>
                <?= $content ?>
            </div>
        </div>
        <!--
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; INTERTORG <?= date('Y') ?></p>
        
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
        -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
