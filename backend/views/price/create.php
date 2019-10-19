<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */
/* @var $a_sizes array */

$this->title = 'Create Price';
$this->params['breadcrumbs'][] = ['label' => 'Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a_sizes' => $a_sizes,
    ]) ?>

</div>
