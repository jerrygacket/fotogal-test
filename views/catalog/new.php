<?php

$this->title = 'Создать альбом - '.Yii::$app->name;
?>
<h1>Новый альбом</h1>

<?= $this->render('_catalog', ['model' => $model, 'action' => 'new']) ?>
