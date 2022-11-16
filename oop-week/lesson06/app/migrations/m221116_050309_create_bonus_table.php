<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bonus}}`.
 */
class m221116_050309_create_bonus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bonus}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'cost' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-bonus-order_id', '{{%bonus}}', 'order_id');
        $this->createIndex('idx-bonus-employee_id', '{{%bonus}}', 'employee_id');

        $this->addForeignKey(
            'fk-bonus-order_id',
            '{{%bonus}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE',
            'RESTRICT');

        $this->addForeignKey(
            'fk-bonus-employee_id',
            '{{%bonus}}',
            'employee_id',
            '{{%employee}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bonus}}');
    }
}
