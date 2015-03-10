<?php
/* @var $this PrzydzielenieController */
/* @var $model Przydzielenie */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'przydzielenie-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'kiedy'); ?>
    <?php echo $form->textFieldControlGroup($model,'wykonano'); ?>
    <?php echo $form->textFieldControlGroup($model,'domains_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'users_id',array('maxlength'=>11)); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
