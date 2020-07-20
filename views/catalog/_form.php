<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action' => '/catalog/add-photo'.($model->id ? '?id='.$model->id : ''),
    'method' => 'POST',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>
<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'userId')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'name')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'description')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'uploadedFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-info',]) ?>

<?php ActiveForm::end() ?>
