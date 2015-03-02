<?php
/* @var $this FunkcjaController */
/* @var $model Funkcja */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php // echo $form->textFieldControlGroup($model,'idfunkcja'); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwa',array('maxlength'=>45)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
