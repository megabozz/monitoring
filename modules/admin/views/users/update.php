<?php

use kartik\form\ActiveForm;
//use kartik\builder\Form;
use kartik\builder\FormGrid;

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => $model->getFormAttr()
]);
ActiveForm::end();


