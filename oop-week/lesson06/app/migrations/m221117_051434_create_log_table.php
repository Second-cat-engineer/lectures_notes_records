<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m221117_051434_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'message' => $this->text(),
        ]);

        $this->createIndex('idx-log-user_id', '{{%log}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
