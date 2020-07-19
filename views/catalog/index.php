<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Альбомы - '.Yii::$app->name;
?>
<div class="site-index">
    <h1>Альбомы</h1>
    <?= Html::a('Создать', '/catalog/new', ['class' => 'btn btn-success', 'style' => 'margin-bottom: 1em;']) ?>
    <?=\yii\grid\GridView::widget([
        'dataProvider' => $data,
        'columns' => [
//            'name:html',
            [
                'attribute'=>'name',
                'content'=>function($data){
                    return Html::a($data['name'], '/catalog/view?id='.$data['id'], ['class' => 'btn btn-link']);
                }
            ],
            'description:html',
            [
                'class' => '\yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view} &nbsp;&nbsp; {edit} &nbsp;&nbsp; {delete}',
                'controller' => 'catalog',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye"></i>', $url);
                    },
                    'edit' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>', $url);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::beginForm(['/catalog/delete'], 'post', ['style' => 'display:inline;'])
                            . Html::hiddenInput('id', $model->id)
                            . Html::submitButton(
                                '<i class="fa fa-times" style="color:red"></i>',
                                [
                                    'class' => 'btn btn-link',
                                    'onclick' => 'if(confirm("Хотите удалить?")){
                                             return true;
                                            }else{
                                             return false;
                                            }',
                                ]
                            )
                            . Html::endForm();
                    },
                ]
            ],
        ],
        'pager' => [
            'options'=>['class'=>'pagination pg-teal justify-content-center'],
//        'disableCurrentPageButton' => 'true',
            'disabledPageCssClass' => 'disabled',
            'disabledListItemSubTagOptions' => [
                'tag' => 'a',
                'class' => 'page-link',
            ],
            'linkContainerOptions' => [
                'class' => 'page-item',
            ],
            'prevPageLabel' => '<',   // Set the label for the “previous” page button
            'nextPageLabel' => '>',   // Set the label for the “next” page button
            'firstPageLabel'=>'<<',   // Set the label for the “first” page button
            'lastPageLabel'=>'>>',    // Set the label for the “last” page button
//        'nextPageCssClass'=>'page-item',    // Set CSS class for the “next” page button
//        'prevPageCssClass'=>'page-item',    // Set CSS class for the “previous” page button
//        'firstPageCssClass'=>'page-item',    // Set CSS class for the “first” page button
//        'lastPageCssClass'=>'page-item',    // Set CSS class for the “last” page button
            'maxButtonCount'=>10,    // Set maximum number of page buttons that can be displayed
            'linkOptions' => [
                'class' => 'page-link'
            ]
        ],
    ])
    ?>

</div>
