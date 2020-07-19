<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userFiles}}`.
 */
class m200719_075415_create_userFiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userFiles}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(11),
            'catalogId' => $this->integer(11),
            'name'=>$this->string(512)->notNull(),
            'description'=>$this->text()->Null(),
            'active'=>$this->boolean()->defaultValue(true),
            'shared'=>$this->boolean()->defaultValue(false),
            'created_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%userFiles}}');
    }
}
