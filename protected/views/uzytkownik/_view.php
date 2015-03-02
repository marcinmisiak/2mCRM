<?php
/* @var $this UzytkownikController */
/* @var $data Uzytkownik */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduzytkownik')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iduzytkownik),array('view','id'=>$data->iduzytkownik)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('haslo')); ?>:</b>
	<?php echo CHtml::encode($data->haslo); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_pryw')); ?>:</b>
	<?php echo CHtml::encode($data->email_pryw); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email_sl')); ?>:</b>
	<?php echo CHtml::encode($data->email_sl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skype')); ?>:</b>
	<?php echo CHtml::encode($data->skype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opis')); ?>:</b>
	<?php echo CHtml::encode($data->opis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roles')); ?>:</b>
	<?php echo CHtml::encode($data->roles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funkcja_idfunkcja')); ?>:</b>
	<?php echo CHtml::encode($data->funkcja_idfunkcja); ?>
	<br />

	*/ ?>

</div>