<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>24)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon_kom',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_sl',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'aktywny'); ?>
    <?php echo $form->textFieldControlGroup($model,'klient_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
