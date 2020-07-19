<?php

use yii\db\Migration;

/**
 * Class m200719_104022_add_users_data
 */
class m200719_104022_add_users_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('users',[
            'login','active','password_hash'],[
            ['admin',true,\Yii::$app->security->generatePasswordHash('123456')],
            ['user',true,\Yii::$app->security->generatePasswordHash('123456')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200719_104022_add_users_data cannot be reverted.\n";

        return false;
    }
    */
}
