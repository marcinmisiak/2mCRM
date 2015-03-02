<?php
/* @var $this UzytkownikController */
/* @var $model Uzytkownik */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'iduzytkownik'); ?>
    <?php echo $form->textFieldControlGroup($model,'login',array('maxlength'=>130)); ?>
    <?php echo $form->textFieldControlGroup($model,'haslo',array('maxlength'=>32)); ?>
    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>24)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>145)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_sl',array('maxlength'=>145)); ?>
    <?php echo $form->textFieldControlGroup($model,'skype',array('maxlength'=>145)); ?>
    <?php echo $form->textAreaControlGroup($model,'opis',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'roles',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'funkcja_idfunkcja'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
