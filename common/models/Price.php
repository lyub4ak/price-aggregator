<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $m_price
 * @property int $i_quantity
 * @property int $size_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Size $size
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
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
            [['m_price', 'size_id'], 'required'],
            [['m_price'], 'number', 'min'=>0],
            [['i_quantity'], 'integer', 'min'=>0],
            [['i_quantity'], 'default', 'value'=>0],
            [['size_id', 'created_at', 'updated_at'], 'integer'],
            [['size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Size::className(), 'targetAttribute' => ['size_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Trade Offer ID',
            'm_price' => 'Price',
            'i_quantity' => 'Quantity',
            'size_id' => 'Size ID',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'productName' => 'Product Name',
            'width' => 'Width',
            'length' => 'Length',
            'height' => 'Height'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Size::className(), ['id' => 'size_id']);
    }

    /**
     * @return string Product name.
     */
    public function getProductName() {
        return $this->size->getProductName();
    }

    /**
     * @return string Product width.
     */
    public function getWidth() {
        return $this->size->i_width;
    }

    /**
     * @return string Product length.
     */
    public function getLength() {
        return $this->size->i_length;
    }

    /**
     * @return string Product width.
     */
    public function getHeight() {
        return $this->size->i_height;
    }
}
