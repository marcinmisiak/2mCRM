<?php
/* @var $this KlientHasUslugiController */
/* @var $model KlientHasUslugi */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'klient_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'uslugi_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'data_od'); ?>
    <?php echo $form->textFieldControlGroup($model,'data_do'); ?>
    <?php echo $form->textFieldControlGroup($model,'kwota',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'zaplacone'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
