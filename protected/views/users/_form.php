<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'users-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldControlGroup($model,'ilosc_domen',array('maxlength'=>11)); ?>
<?php echo $form->checkBoxControlGroup($model,'automat_domen',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>254)); ?>
    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>32)); ?>
    <?php echo $form->passwordFieldControlGroup($model,'password',array('maxlength'=>64)); ?>
    <?php echo $form->textFieldControlGroup($model,'logins',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_login'); ?>
    <?php echo $form->textFieldControlGroup($model,'imie',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefon',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_pryw',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'skype',array('maxlength'=>200)); ?>
    <?php echo $form->textAreaControlGroup($model,'opis',array('rows'=>6)); ?>
    
   
    
    <?php echo $form->dropDownListControlGroup($model,'roles',Yii::app()->params['roles'], array('empty' => 'Wybierz ...')); ?>
    <?php echo $form->dropDownListControlGroup($model,'functions_id', CHtml::listData(Functions::model()->findAll(array('order'=>'name')),'id','name'), array('empty' => 'Wybierz ...')); ?>
    

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
