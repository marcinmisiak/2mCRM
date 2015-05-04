<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'domains-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'user_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'expiry_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'registrar',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'added_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'client',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>45)); ?>

    <?php  echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
 <?php 
 /* echo BsHtml::ajaxSubmitButton('Zapisz', Yii::app()->createAbsoluteUrl('klient/createDomain'),
 		 array('type'=>'POST', 'update'=>'#nowaDomena',
 		 		// 'data'=>'js:$("#domains-form1").serialize()'
 		),
 		array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); 
 		*/
 ?>
<?php $this->endWidget(); ?>
