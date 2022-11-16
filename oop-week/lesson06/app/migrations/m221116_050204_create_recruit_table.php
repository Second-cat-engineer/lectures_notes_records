<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recruit}}`.
 */
class m221116_050204_create_recruit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recruit}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
        ]);

        $this->createIndex('idx-recruit-order_id', '{{%recruit}}', 'order_id');
        $this->createIndex('idx-recruit-employee_id', '{{%recruit}}', 'employee_id');

        $this->addForeignKey(
            'fk-recruit-order_id',
            '{{%recruit}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-recruit-employee_id',
            '{{%recruit}}',
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
        $this->dropTable('{{%recruit}}');
    }
}
