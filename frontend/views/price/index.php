<?php

use kartik\field\FieldRange;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trade Offers';
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'productName',
            'width',
            'length',
            'height',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'm_price',
                'visible' => true,
                'format' => 'raw',
                'filter' => FieldRange::widget([
                    'model' => $searchModel,
                    'attribute1' => 'm_price_from',
                    'name1'=>'UserTagSearch[m_price_from]',
                    'value1' => '',
                    'attribute2' => 'm_price_to',
                    'name2'=>'UserTagSearch[m_price_to]',
                    'value2' => '',
                    'separator' => '-',
                    'useAddons' => false,
                    'template' => '{widget}{error}',
                    'widgetContainer' => [
                        'style' => 'margin-bottom: -15px'
                    ],
                    'type' => FieldRange::INPUT_TEXT,
                ]),
                'contentOptions' => ['style' => 'width:10%'],
            ],
            'i_quantity',
        ],
    ]); ?>


</div>
