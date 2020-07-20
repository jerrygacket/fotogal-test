<?php

use yii\helpers\Html;
$this->title = 'Альбом '.$model->name.' - '.Yii::$app->name;
?>
<h1>Альбом <?= $model->name ?></h1>
<p><?= Html::a('Все альбомы', '/catalog', ['class' => 'btn btn-success', 'style' => 'margin-bottom: 1em;']) ?></p>
<p><?= $model->description ?></p>
<p><?= Html::a('Добавить фото', '/user-files/add?catalogId='.$model->id, ['class' => 'btn btn-info', 'style' => 'margin-bottom: 1em;']) ?></p>
<div class="row">
    <?php if (!empty($images)) {
        foreach ($images as $image) {
            ?>
            <div class="col-12 col-md-2">
                <img src="<?= $image->getSmall() ?>" alt="<?= $image->getTitle() ?>">
            </div>
            <?php
        }
    }
    ?>
</div>
