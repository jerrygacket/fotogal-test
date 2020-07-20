<?php


namespace app\models;


class UserFiles extends \app\base\models\UserFiles
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
        ]);
    }

    public function getSmall() {
        return 'files/'.$this->userId.'/small/'.$this->id.'.jpg';
    }
}