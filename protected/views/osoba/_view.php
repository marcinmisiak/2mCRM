<?php
/* @var $this OsobaController */
/* @var $data Osoba */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imie')); ?>:</b>
	<?php echo CHtml::encode($data->imie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwisko')); ?>:</b>
	<?php echo CHtml::encode($data->nazwisko); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefon')); ?>:</b>
	<?php echo CHtml::encode($data->telefon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefon_kom')); ?>:</b>
	<?php echo CHtml::encode($data->telefon_kom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_pryw')); ?>:</b>
	<?php echo CHtml::encode($data->email_pryw); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email_sl')); ?>:</b>
	<?php echo CHtml::encode($data->email_sl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aktywny')); ?>:</b>
	<?php echo CHtml::encode($data->aktywny); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('klient_id')); ?>:</b>
	<?php echo CHtml::encode($data->klient_id); ?>
	<br />

	*/ ?>

</div>