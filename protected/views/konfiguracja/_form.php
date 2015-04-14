<?php
/* @var $this KonfiguracjaController */
/* @var $model Konfiguracja */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'konfiguracja-form',
    'enableAjaxValidation'=>false,
	//	'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <fieldset><legend>Wolne dni - nieprzydzielamy w tych datach klientów</legend>
	<?php 
	echo $form->label($model, 'wolne_dni_tygodnia');
	?>
	<div>
	<?php 
	echo CHtml::checkBoxList('Konfiguracja[wolne_dni_tygodnia]', unserialize($model->wolne_dni_tygodnia), $model->dni_tygodnia);
	?>
	</div>
	
	
			<div class="form-group">
 <?php
	echo $form->labelEx ( $model, 'data_wolne_dni', array (
			"class" => 'control-label col-lg-2' 
	) );
	?>
	<div class="col-lg-4">
	<?php 
	$this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
			'model' => $model,
			'value' => '',
			'language' => 'pl',
			'attribute' => 'data_wolne_dni',
			'options' => array (
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'altFormat' => 'yy-mm-dd' 
			),
			'htmlOptions' => array (
					'class' => 'form-control',
					'style'=>"width: 80pt", 
			) 
	) );
	?>
	<?php echo BsHtml::button("Dodaj wolną datę", array('id'=>'btnDodajWD'))?>
</div>
	<div class="row"></div>
    <?php
	
     
     //echo $form->textAreaControlGroup($model,'wolne_dni_tygodnia',array('rows'=>6)); ?>
    <?php echo $form->textAreaControlGroup($model,'wolne_dni_daty',array('rows'=>6)); ?>
    </fieldset>
	<fieldset><legend>Automatyczne przydzielanie klientów pracownikom</legend>
	<P>Paramert funkcji strtotime()
	<small>http://php.net/manual/en/function.strtotime.php</small>
    <?php echo $form->textFieldControlGroup($model, 'automat_kiedy'); ?>
    <?php echo $form->textFieldControlGroup($model, 'automat_expiry'); ?>
    </fieldset>
    <fieldset><legend>Emaile</legend>
    <?php echo $form->checkBoxControlGroup($model, 'automat_email_do_admina'); ?>
    </fieldset>
    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
<script>
$('#btnDodajWD').click(function() { 
	var data = $('#Konfiguracja_data_wolne_dni').val();
	var daty_dodane = $('#Konfiguracja_wolne_dni_daty').val();
	daty_dodane += ","+data;
	$('#Konfiguracja_wolne_dni_daty').val(daty_dodane);
});
    </script>
