<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'domains-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'user_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'expiry_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'registrar',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'added_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'client',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>45)); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
