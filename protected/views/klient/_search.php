<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'nazwa',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_adres',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_kod',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_miasto',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_kraj',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'nip',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'regon',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'krs',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'www',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>250)); ?>
    <?php echo $form->textAreaControlGroup($model,'notatka',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'rozmowa_konczaca'); ?>
    <?php echo $form->textFieldControlGroup($model,'status_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'users_id',array('maxlength'=>11)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Szukaj',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
