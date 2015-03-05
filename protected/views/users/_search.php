<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>254)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>32)); ?>
        <?php echo $form->textFieldControlGroup($model,'logins',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_login'); ?>
    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'skype',array('maxlength'=>200)); ?>
    <?php echo $form->textAreaControlGroup($model,'opis',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'roles',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'functions_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
