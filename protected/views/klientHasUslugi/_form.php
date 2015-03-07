<?php
/* @var $this KlientHasUslugiController */
/* @var $model KlientHasUslugi */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'klient-has-uslugi-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'klient_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'uslugi_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'data_od'); ?>
    <?php echo $form->textFieldControlGroup($model,'data_do'); ?>
    <?php echo $form->textFieldControlGroup($model,'kwota',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'zaplacone'); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
