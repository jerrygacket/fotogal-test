<?php

namespace app\base\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property int|null $active
 * @property string $password_hash
 * @property string|null $token
 * @property string|null $auth_key
 * @property string $created_on
 * @property string $updated_on
 *
 * @property Catalog[] $catalogs
 * @property UserFiles[] $userFiles
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password_hash'], 'required'],
            [['active'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['login'], 'string', 'max' => 150],
            [['password_hash', 'token', 'auth_key'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'active' => Yii::t('app', 'Active'),
            'password_hash' => Yii::t('app', ''),
            'token' => Yii::t('app', 'Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }

    /**
     * Gets query for [[Catalogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['userId' => 'id']);
    }

    /**
     * Gets query for [[UserFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFiles()
    {
        return $this->hasMany(UserFiles::className(), ['userId' => 'id']);
    }
}
