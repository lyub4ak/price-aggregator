<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SizeSearch represents the model behind the search form of `backend\models\Size`.
 */
class SizeSearch extends Size
{
    /**
     * Product name.
     *
     * @var string
     */
    public $productName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'i_width', 'i_length', 'i_height', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['productName'], 'safe']
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
        $query = Size::find();
        $query->joinWith(['product']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'i_width',
                'i_length',
                'i_height',
                'product_id',
                'created_at',
                'updated_at',
                'productName' => [
                    'asc' => ['product.text_name' => SORT_ASC],
                    'desc' => ['product.text_name' => SORT_DESC],
                    'label' => 'Product Name'
                ]
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
            'id' => $this->id,
            'i_width' => $this->i_width,
            'i_length' => $this->i_length,
            'i_height' => $this->i_height,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        // Adds filter by product name.
        $query->andFilterWhere(['like', 'product.text_name', $this->productName]);

        return $dataProvider;
    }
}
