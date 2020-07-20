<?php


namespace app\controllers;


use yii\helpers\ArrayHelper;

class CatalogController extends \app\base\BaseController
{
    public function actionIndex() {
        $component = \Yii::$app->catalog;
        return $this->render('index', [
            'data' => $component->getDataProvider(['userId' => \Yii::$app->user->id, 'active' => true])
        ]);
    }

    public function actionNew() {
        $component = \Yii::$app->catalog;
        $model = $component->getModel();

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            if ($component->createCatalog($model)) {
                $this->redirect('/catalog');
            }
        }

        return $this->render('new', [
            'model' => $model
        ]);
    }

    public function actionEdit() {
        $component = \Yii::$app->catalog;
        $model = $component->getModel(
            ArrayHelper::merge(
                \Yii::$app->request->queryParams,
                ['userId' => \Yii::$app->user->id, 'active' => true]
            )
        );

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            if ($component->updateCatalog($model)) {
                $this->redirect('/catalog/view?id='.$model->id);
            }
        }

        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionDelete() {
        if (!\Yii::$app->request->isPost) {
            $this->redirect('/catalog');
        }
        $component = \Yii::$app->catalog;
        $model = $component->getModel(
            [
                'id' => \Yii::$app->request->post()['id'],
                'userId' => \Yii::$app->user->id,
            ]
        );

        if ($model) {
            if ($component->deleteCatalog($model)) {
                $this->redirect('/catalog');
            }
        }

        $this->redirect('/catalog');
    }

    public function actionView() {
        $component = \Yii::$app->catalog;
        $model = $component->getModel(
            ArrayHelper::merge(
                \Yii::$app->request->queryParams,
                ['userId' => \Yii::$app->user->id]
            )
        );

        if ($model) {
            return $this->render('view', [
                'model' => $model,
                'images' => $model->getUserFiles()->all(),
            ]);
        }

        $this->redirect('/catalog');
    }
}