<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200719_075213_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'login'=>$this->string(150)->notNull(),
            'active'=>$this->boolean()->defaultValue(true),
            'password_hash'=>$this->string('300')->notNull(),
            'token'=>$this->string('300'),
            'auth_key'=>$this->string('300'),
            'created_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex('users_loginInd','users','login',true);
        $this->execute('');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
