<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'osoba-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
		'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>24)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon_kom',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_sl',array('maxlength'=>200)); ?>
    <?php echo $form->dropDownListControlGroup($model,'aktywny', $this->taknie); ?>
    <?php echo $form->textFieldControlGroup($model->klient,'nazwa', array(
    		'readonly'=>true,
    		'help' => 'Pelna nazwa firmy/klienta wybranej osoby.',
    		 'groupOptions' =>array( 'label'=>'Pełna nazwa klienta'))); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
