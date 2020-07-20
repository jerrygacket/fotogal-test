<?php


namespace app\models;


use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Catalog extends \app\base\models\Catalog
{
    /**
     * @var UploadedFile[]
     */
    public $uploadedFiles;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['uploadedFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4, 'maxSize' => 5242880, 'tooBig' => 'Не более 5MB'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),[
            'uploadedFiles' => \Yii::t('app', 'Uploaded Files'),
        ]);
    }

    /**
     * Gets query for [[UserFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFiles()
    {
        return $this->hasMany(UserFiles::className(), ['catalogId' => 'id']);


    }public function getFile($id)
    {
        return UserFiles::findOne([$id]);
    }



    public function uploadFiles()
    {
        $result = [];
        if ($this->validate()) {
            foreach ($this->uploadedFiles as $file) {
                $fileName = 'files' . ThumbGenerator::DS
                    . \Yii::$app->user->id . ThumbGenerator::DS
                    . $this->id . ThumbGenerator::DS
                    . $file->baseName . '.' . $file->extension;
                if (!is_dir(dirname($fileName))) {
                    mkdir(dirname($fileName), 0755, true);
                }
                is_uploaded_file($file->tempName) ?
                    $file->saveAs($fileName) :
                    rename($file->tempName,$fileName);
                $userFile = new UserFiles();
                $userFile->userId = \Yii::$app->user->id;
                $userFile->catalogId = $this->id;
                $userFile->name = $file->baseName . '.' . $file->extension;
                $userFile->save();
                ThumbGenerator::generate($fileName);
            }
            return true;
        } else {
            return false;
        }
    }
}