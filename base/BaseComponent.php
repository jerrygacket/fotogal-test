<?php

namespace app\base;

use yii\data\ActiveDataProvider;

class BaseComponent extends \yii\base\Component
{
    public $nameClass;

    public function init()
    {
        parent::init();

        if (empty($this->nameClass)) {
            throw new \Exception('no ClassName');
        }
    }

    public function getModel($params = []) {
        if (empty($params)) {
            return new $this->nameClass;
        }

        return $this->nameClass::findOne($params) ?? new $this->nameClass;
    }

    public function getDataProvider($params = []) {
        $query = $this->nameClass::find()->where($params);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id'=>SORT_DESC
                ]
            ]
        ]);
    }
}