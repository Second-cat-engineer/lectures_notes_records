<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacation}}`.
 */
class m221116_050236_create_vacation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacation}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'date_from' => $this->date()->notNull(),
            'date_to' => $this->date()->notNull(),
        ]);

        $this->createIndex('idx-vacation-order_id', '{{%vacation}}', 'order_id');
        $this->createIndex('idx-vacation-employee_id', '{{%vacation}}', 'employee_id');

        $this->addForeignKey(
            'fk-vacation-order_id',
            '{{%vacation}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-vacation-employee_id',
            '{{%vacation}}',
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
        $this->dropTable('{{%vacation}}');
    }
}
