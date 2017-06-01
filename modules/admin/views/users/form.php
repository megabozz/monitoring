<?php

use kartik\form\ActiveForm;
//use kartik\builder\Form;
use kartik\builder\FormGrid;

$form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_VERTICAL,
//            'formConfig' => [
//                'deviceSize' => ActiveForm::SIZE_TINY,
//                'showLabels' => true,
//                'showErrors' => true,
//                //'showHints' => true,
//                'labelSpan' => 0,
//            ],
        ]);
echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => $model->getFormAttr()
]);
ActiveForm::end();


