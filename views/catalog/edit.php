<?php
$this->title = 'Редактировать альбом '.$model->name.' - '.Yii::$app->name;
?>
<h1>Редактировать альбом <?= $model->name ?></h1>

<?= $this->render('_catalog', ['model' => $model, 'action' => 'edit']) ?>
