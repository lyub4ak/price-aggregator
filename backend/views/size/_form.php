<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Size */
/* @var $form yii\widgets\ActiveForm */
/* @var $a_products array */
?>

<div class="size-form">

    <?php
        $form = ActiveForm::begin();
        $a_products = ArrayHelper::map($a_products, 'id', 'text_name');
    ?>

    <?= $form->field($model, 'product_id')->dropDownList($a_products)->label('Product') ?>

    <?= $form->field($model, 'i_width')->textInput() ?>

    <?= $form->field($model, 'i_length')->textInput() ?>

    <?= $form->field($model, 'i_height')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
