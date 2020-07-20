<?php

use yii\helpers\Html;

echo Html::beginForm('/user-files/add', 'POST', ['enctype' => 'multipart/form-data']);
echo Html::hiddenInput('catalogId', $catalogId, ['label' => false]);
echo Html::hiddenInput('userId', Yii::$app->user->id, ['label' => false]);
echo Html::fileInput('uploadedFiles[]', null, ['multiple' => true, 'accept' => 'image/*']);
echo Html::submitButton('Сохранить', ['class' => 'btn btn-gray']);
echo Html::endForm();