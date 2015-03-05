<?php
/* @var $this UslugiController */
/* @var $data Uslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opis')); ?>:</b>
	<?php echo CHtml::encode($data->opis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tuslugi_id')); ?>:</b>
	<?php echo CHtml::encode($data->tuslugi_id); ?>
	<br />


</div>