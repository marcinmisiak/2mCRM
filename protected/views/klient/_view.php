<?php
/* @var $this KlientController */
/* @var $data Klient */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adrrej_adres')); ?>:</b>
	<?php echo CHtml::encode($data->adrrej_adres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adrrej_kod')); ?>:</b>
	<?php echo CHtml::encode($data->adrrej_kod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adrrej_miasto')); ?>:</b>
	<?php echo CHtml::encode($data->adrrej_miasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adrrej_kraj')); ?>:</b>
	<?php echo CHtml::encode($data->adrrej_kraj); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('regon')); ?>:</b>
	<?php echo CHtml::encode($data->regon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('krs')); ?>:</b>
	<?php echo CHtml::encode($data->krs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('www')); ?>:</b>
	<?php echo CHtml::encode($data->www); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notatka')); ?>:</b>
	<?php echo CHtml::encode($data->notatka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rozmowa_konczaca')); ?>:</b>
	<?php echo CHtml::encode($data->rozmowa_konczaca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />

	*/ ?>

</div>