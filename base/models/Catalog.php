<?php

namespace app\base\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property int|null $userId
 * @property string $name
 * @property string|null $description
 * @property int|null $active
 * @property int|null $shared
 * @property string $created_on
 * @property string $updated_on
 *
 * @property Users $user
 * @property UserFiles[] $userFiles
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'active', 'shared'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 512],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'shared' => Yii::t('app', 'Shared'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[UserFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFiles()
    {
        return $this->hasMany(UserFiles::className(), ['catalogId' => 'id']);
    }
}
