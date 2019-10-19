<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */
/* @var $form yii\widgets\ActiveForm */
/* @var $a_sizes array */
?>

<div class="price-form">

    <?php
        $form = ActiveForm::begin();
        $a_select = [];
        foreach($a_sizes as $o_size) {
            $a_select[$o_size->getProductName()][$o_size->id] = $o_size->i_width.'x'.$o_size->i_length.'x'.$o_size->i_height;
        }
    ?>

    <?=
        $form->field($model, 'size_id')
            ->dropDownList($a_select, [ 'prompt' => 'Select product and size'])
            ->label('Product');
    ?>

    <?= $form->field($model, 'm_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'i_quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
