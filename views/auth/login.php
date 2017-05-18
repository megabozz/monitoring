<?php

use yii\widgets\ActiveForm;


echo "<div style='width:20em;margin:auto;'>";
$form = ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => [
//        'style' => 'width:20em;' 
    ]
]);
echo $form->field($model, 'login')->textInput();
echo $form->field($model, 'password')->passwordInput();

echo \yii\bootstrap\Html::submitButton('Вход');

ActiveForm::end();
echo "</div>";
