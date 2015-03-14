<?php
/* @var $this UzycieController */
/* @var $model Uzycie */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'uzycie-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'od'); ?>
    <?php echo $form->textFieldControlGroup($model,'do'); ?>
    <?php echo $form->textFieldControlGroup($model,'przydzielenie_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'status_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'users_id',array('maxlength'=>11)); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
