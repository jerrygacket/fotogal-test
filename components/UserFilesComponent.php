<?php


namespace app\components;


use app\models\ThumbGenerator;
use yii\web\UploadedFile;

class UserFilesComponent extends \app\base\BaseComponent
{
    /**
     * @var UploadedFile[]
     */
    public $uploadedFiles;

    public function uploadFiles($catalogId)
    {
        foreach ($this->uploadedFiles as $file) {
            $fileName = 'files' . ThumbGenerator::DS
                . \Yii::$app->user->id . ThumbGenerator::DS
                . $catalogId . ThumbGenerator::DS
                . $file->baseName . '.' . $file->extension;
            is_uploaded_file($file->tempName) ?
                $file->saveAs($fileName) :
                rename($file->tempName,$fileName);
            ThumbGenerator::generate($fileName);
        }
        exit;
    }
}