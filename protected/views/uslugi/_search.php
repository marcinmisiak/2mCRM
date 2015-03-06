<?php
/* @var $this UslugiController */
/* @var $model Uslugi */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwa',array('maxlength'=>45)); ?>
    <?php echo $form->textAreaControlGroup($model,'opis',array('rows'=>6)); ?>
    <?php echo $form->dropDownListControlGroup($model,'tuslugi_id',CHtml::listData(Tuslugi::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa'),array('empty'=>'Wybierz...')); ?>
    

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
