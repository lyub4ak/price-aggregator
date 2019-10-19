<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Size */
/* @var $a_products array */

$this->title = 'Create Size';
$this->params['breadcrumbs'][] = ['label' => 'Sizes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a_products' => $a_products,
    ]) ?>

</div>
