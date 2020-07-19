<?php

use yii\db\Migration;

/**
 * Class m200719_081411_create_userFilesFK
 */
class m200719_081411_create_userFilesFK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('userFiles_userIdFK',
            'userFiles','userId','users','id',
            'SET NULL','SET NULL');
        $this->addForeignKey('userFiles_catalogIdFK',
            'userFiles','catalogId','catalog','id',
            'SET NULL','SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('userFiles_userIdFK','userFiles');
        $this->dropForeignKey('userFiles_catalogIdFK','userFiles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200719_081411_create_userFilesFK cannot be reverted.\n";

        return false;
    }
    */
}
