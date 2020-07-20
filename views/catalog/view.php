<?php

use yii\helpers\Html;
$this->title = 'Альбом '.$model->name.' - '.Yii::$app->name;
?>
<h1>Альбом <?= $model->name ?></h1>
<p><?= Html::a('Все альбомы', '/catalog', ['class' => 'btn btn-success', 'style' => 'margin-bottom: 1em;']) ?></p>
<p><?= $model->description ?></p>
<p><?= Html::a('Добавить фото', '/catalog/add-photo?id='.$model->id, ['class' => 'btn btn-info', 'style' => 'margin-bottom: 1em;']) ?></p>
<div class="row">
    <?php if (!empty($images)) {
        foreach ($images as $image) {
            ?>
            <div class="col-12 col-md-4">
                <img src="<?= $image->getImage('small') ?>" alt="<?= $image->getTitle() ?>">
                <?=
                    Html::beginForm(['/catalog/del-photo?id='.$model->id], 'post')
                    . Html::hiddenInput('fileId', $image->id)
                    . Html::submitButton(
                        '<i class="fa fa-times" aria-hidden="true"></i>',
                        [
                            'class' => 'btn btn-danger',
                            'onclick' => 'if(confirm("Хотите удалить?")){
                                             return true;
                                            }else{
                                             return false;
                                            }',
                        ]
                    )
                    . Html::endForm()
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>
