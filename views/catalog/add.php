<?php
$this->title = 'Добавить фото - Альбом '.$model->name.' - '.Yii::$app->name;
?>
<h1>Загрузить фото</h1>
<?= $this->render('_form', ['model' => $model]) ?>
