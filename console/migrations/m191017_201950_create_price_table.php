<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m191017_201950_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'm_price' => $this->decimal(10, 2)->notNull(),
            'size_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Creates index for column `size_id`.
        $this->createIndex(
            'idx-price-size_id',
            'price',
            'size_id'
        );

        // Adds foreign key for table `size`.
        $this->addForeignKey(
            'fk-price-size_id',
            'price',
            'size_id',
            'size',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drops foreign key for table `size`.
        $this->dropForeignKey(
            'fk-price-size_id',
            'price'
        );

        // Drops index for column `size_id`.
        $this->dropIndex(
            'idx-price-size_id',
            'price'
        );

        $this->dropTable('{{%price}}');
    }
}
