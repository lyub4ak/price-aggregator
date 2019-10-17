<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%size}}`.
 */
class m191017_194410_create_size_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%size}}', [
            'id' => $this->primaryKey(),
            'i_width' => $this->tinyInteger(1)->notNull(),
            'i_length' => $this->tinyInteger(1)->notNull(),
            'i_height' => $this->tinyInteger(1)->notNull(),
            'product_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Creates index for column `product_id`.
        $this->createIndex(
            'idx-size-product_id',
            'size',
            'product_id'
        );

        // Adds foreign key for table `product`.
        $this->addForeignKey(
            'fk-size-product_id',
            'size',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drops foreign key for table `product`.
        $this->dropForeignKey(
            'fk-size-product_id',
            'size'
        );

        // Drops index for column `product_id`.
        $this->dropIndex(
            'idx-size-product_id',
            'size'
        );

        $this->dropTable('{{%size}}');
    }
}
