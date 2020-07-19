<?php

use yii\db\Migration;

/**
 * Class m200719_081355_create_catalogFK
 */
class m200719_081355_create_catalogFK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('catalog_userIdFK',
            'catalog','userId','users','id',
            'SET NULL','SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('catalog_userIdFK','catalog');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200719_081355_create_catalogFK cannot be reverted.\n";

        return false;
    }
    */
}
