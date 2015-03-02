<?php
/* @var $this UzytkownikController */
/* @var $model Uzytkownik */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'uzytkownik-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'login',array('maxlength'=>130)); ?>
    <?php echo $form->textFieldControlGroup($model,'haslo',array('maxlength'=>32)); ?>
    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>24)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>145)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_sl',array('maxlength'=>145)); ?>
    <?php echo $form->textFieldControlGroup($model,'skype',array('maxlength'=>145)); ?>
    <?php echo $form->textAreaControlGroup($model,'opis',array('rows'=>6)); ?>
    <?php echo $form->dropDownListControlGroup($model,'roles',Yii::app()->params['roles']); ?>
    <?php echo $form->dropDownListControlGroup($model,'funkcja_idfunkcja', CHtml::listData(Funkcja::model()->findAll(array('order'=>'nazwa')),'idfunkcja','nazwa'), array('empty' => 'Wybierz ...')); ?>

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
