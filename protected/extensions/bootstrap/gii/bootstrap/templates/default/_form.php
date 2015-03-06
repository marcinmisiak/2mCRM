<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 * @author Marcin Misiak 2mmarcinmisiak@gmail.com
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
<?php echo "?>\n"; ?>

<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'" . $this->class2id($this->modelClass) . "-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>\n"; ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach ($this->tableSchema->columns as $column) :
    if ($column->autoIncrement) {
        continue;
    }
    ?>
    <?php echo "<?php echo " . $this->generateActiveControlGroup($this->modelClass, $column) . "; ?>\n"; ?>
<?php endforeach; ?>

    <?php echo "<?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>\n"; ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>