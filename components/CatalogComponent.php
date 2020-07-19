<?php


namespace app\components;


class CatalogComponent extends \app\base\BaseComponent
{
    public function createCatalog($model) {
        $model->userId = \Yii::$app->user->id;
        return $model->save();
    }

    public function updateCatalog($model) {
       return $model->save();
    }

    public function deleteCatalog($model) {
        $model->active = 0;

        return $model->save();
    }
}