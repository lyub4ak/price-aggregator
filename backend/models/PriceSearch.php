<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PriceSearch represents the model behind the search form of `backend\models\Price`.
 */
class PriceSearch extends Price
{
    /**
     * Product name.
     *
     * @var string
     */
    public $productName;

    /**
     * Product width.
     *
     * @var string
     */
    public $width;

    /**
     * Product length.
     *
     * @var string
     */
    public $length;

    /**
     * Product height.
     *
     * @var string
     */
    public $height;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'i_quantity', 'size_id', 'created_at', 'updated_at'], 'integer'],
            [['m_price'], 'number'],
            [['productName', 'width', 'length', 'height'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Price::find();
        $query->joinWith(['size']);
        $query->leftJoin('product', 'size.product_id = product.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'productName' => [
                    'asc' => ['product.text_name' => SORT_ASC],
                    'desc' => ['product.text_name' => SORT_DESC],
                    'label' => 'Product Name'
                ],
                'width' => [
                    'asc' => ['size.i_width' => SORT_ASC],
                    'desc' => ['size.i_width' => SORT_DESC],
                    'label' => 'Width'
                ],
                'length' => [
                    'asc' => ['size.i_length' => SORT_ASC],
                    'desc' => ['size.i_length' => SORT_DESC],
                    'label' => 'Length'
                ],
                'height' => [
                    'asc' => ['size.i_height' => SORT_ASC],
                    'desc' => ['size.i_height' => SORT_DESC],
                    'label' => 'Height'
                ],
                'm_price',
                'i_quantity'
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'price.id' => $this->id,
            'i_quantity' => $this->i_quantity,
            'size_id' => $this->size_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'size.i_width' => $this->width,
            'size.i_length' => $this->length,
            'size.i_height' => $this->height,
        ]);

        // Adds filters by product name and price.
        $query->andFilterWhere(['like', 'product.text_name', $this->productName])
            ->andFilterWhere(['like', 'm_price', $this->m_price]);

        return $dataProvider;
    }
}
