<?php


namespace app\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 *
 * @property-read mixed $authKey
 * @property-read mixed $username
 */
class Users extends \app\base\models\Users implements IdentityInterface
{
    public $password;
    public $newPassword = '';
    public $rememberMe = false;

    const SCENARIO_REGISTRATION = 'reg_scenario';
    const SCENARIO_AUTHORIZATION = 'auth_scenario';

    public function setRegistrationScenario(){
        $this->setScenario(self::SCENARIO_REGISTRATION);
        return $this;
    }

    public function setAuthorizationScenario(){
        $this->setScenario(self::SCENARIO_AUTHORIZATION);
        return $this;
    }

    public function getUsername(){
        return $this->login;
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['password','string','min'=>6, 'message' => 'Короткий пароль'],
            ['password', 'required'],
            ['login','unique','on' => self::SCENARIO_REGISTRATION, 'message' => 'Такой пользователь уже есть'],
            ['login','exist','on' => self::SCENARIO_AUTHORIZATION],
        ]);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_on', 'updated_on'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_on'],
                ],
                'value' => new Expression('NOW()')
            ]
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),[
            'newPassword' => Yii::t('app', 'New Password'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember Me'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;;
    }
}