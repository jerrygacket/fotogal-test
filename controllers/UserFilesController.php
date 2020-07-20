<?php


namespace app\controllers;


use yii\web\UploadedFile;

class UserFilesController extends \app\base\BaseController
{
    public function actionAdd($catalogId = null){
        $component = \Yii::$app->images;

        if (\Yii::$app->request->isPost) {
            $component->uploadedFiles = UploadedFile::getInstancesByName('uploadedFiles');
            if (!empty($component->uploadedFiles)) {
                $component->uploadFiles(\Yii::$app->request->post('catalogId'));
                $this->redirect('/catalog/view?id='.\Yii::$app->request->post('catalogId'));
            }
        }

        return $this->render('add', ['catalogId' => $catalogId]);
    }
}