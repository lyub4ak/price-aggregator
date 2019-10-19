<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "size".
 *
 * @property int $id
 * @property int $i_width
 * @property int $i_length
 * @property int $i_height
 * @property int $product_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Price[] $prices
 * @property Product $product
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['i_width', 'i_length', 'i_height', 'product_id'], 'required'],
            [['i_width', 'i_length', 'i_height', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['i_width', 'i_length', 'i_height'], 'in', 'range' => range(1, 5)],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['product_name'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Size ID',
            'i_width' => 'Width',
            'i_length' => 'Length',
            'i_height' => 'Height',
            'product_id' => 'Product ID',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'product_name' => 'Product Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['size_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return string Product name.
     */
    public function getProductName() {
        return $this->product->text_name;
    }
}
