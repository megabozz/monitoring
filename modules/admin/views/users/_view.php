    <?php
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;
    ?>
     
    <div class="news-item">
        <h2><?= Html::encode($model->login) ?></h2>
        <?= HtmlPurifier::process($model->text) ?>    
    </div>
