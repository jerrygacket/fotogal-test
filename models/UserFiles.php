<?php


namespace app\models;


class UserFiles extends \app\base\models\UserFiles
{
    public function getImage($size) {
        return \Yii::$app->homeUrl.'files/'.$this->userId.'/'.$this->catalogId.'/'.$size.'/'.$this->name;
    }

    public function getTitle() {
        return $this->name;
    }
}