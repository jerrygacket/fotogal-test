<?php

namespace app\components;

use app\base\BaseComponent;
use app\models\Users;
use Yii;

class AuthComponent extends BaseComponent
{
    /**
     * @param $password
     * @param $passwordHash
     * @return bool
     */
    private function checkPassword($password,$passwordHash){
        return Yii::$app->security->validatePassword($password,$passwordHash);
    }

    /**
     * @param $username
     * @return Users|array|\yii\db\ActiveRecord|null
     */
    private function getUserFromLogin($username){
        return $this->nameClass::find()->andWhere(['login'=>$username])->one();
    }

    private function generateAuthKey(){
        return Yii::$app->security->generateRandomString();
    }

    private function hashPassword($password){
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function authUser(&$model):bool{
        $model->setAuthorizationScenario();
        if(!$model->validate(['login','password'])){
            $model->addError('login','Неверный пользователь или пароль');
            $model->addError('password','Неверный пользователь или пароль');
            return false;
        }

        $user = $this->getUserFromLogin($model->getUsername());
        if(empty($user) || !$this->checkPassword($model->password,$user->password_hash)) {
            $model->addError('login','Неверный пользователь или пароль');
            $model->addError('password','Неверный пользователь или пароль');
            return false;
        }

        return Yii::$app->user->login($user,$model->rememberMe ? 0 : 3600);
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function createUser(&$model):bool{
        $model->setRegistrationScenario();
        $model->password_hash = $this->hashPassword($model->password);
        $model->auth_key = $this->generateAuthKey();

        return $model->save();
    }
}