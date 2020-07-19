<?php

/* @var $this yii\web\View */

$this->title = 'Главная - '.Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::$app->name ?></h1>

        <?php if (Yii::$app->user->isGuest) { ?>
        <p class="lead">для просмотра и загрузки фото выполните</p>
        <p><a class="btn btn-lg btn-success" href="/site/login">Вход</a></p>
        <?php } else { ?>
            <p class="lead">Добро пожаловать</p>
            <p><?= Yii::$app->user->identity->username ?></p>
            <p><?= \yii\helpers\Html::a('Альбомы', '/catalog', ['class' => 'btn btn-primary']) ?></p>
            <p><?= \yii\helpers\Html::a('Добавить фото', '/user-files/add', ['class' => 'btn btn-info']) ?></p>
        <?php } ?>

    </div>

</div>
