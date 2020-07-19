<?php

namespace app\base;

use yii\base\Action;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @param $action Action
     * @return bool
     * @throws \yii\base\InvalidRouteException
     * @throws \yii\console\Exception
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest){
            return \Yii::$app->runAction('/site/login');
        }
        return parent::beforeAction($action);
    }

    /**
     * @param Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        $page = \Yii::$app->request->url;
        \Yii::$app->session->set('page_url',$page);

        return parent::afterAction($action, $result);
    }
}