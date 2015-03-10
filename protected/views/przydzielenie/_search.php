<?php
/* @var $this PrzydzielenieController */
/* @var $model Przydzielenie */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'kiedy'); ?>
    <?php echo $form->textFieldControlGroup($model,'wykonano'); ?>
    <?php echo $form->textFieldControlGroup($model,'domains_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'users_id',array('maxlength'=>11)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
