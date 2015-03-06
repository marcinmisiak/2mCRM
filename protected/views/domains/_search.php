<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'expiry_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'registrar',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'added_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'client',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'phone',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>45)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
