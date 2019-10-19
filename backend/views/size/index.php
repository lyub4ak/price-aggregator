<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SizeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sizes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Size', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'product_id',
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value'=>function ($o_size) {
                    return Html::a($o_size->id, ['price/index?PriceSearch%5Bsize_id%5D='.$o_size->id]);
                },
            ],
            [
                'attribute' => 'productName',
                'format' => 'raw',
                'value'=>function ($o_size) {
                    return Html::a($o_size->productName, ['price/index?PriceSearch%5Bsize_id%5D='.$o_size->id]);
                },
            ],
            'i_width',
            'i_length',
            'i_height',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
