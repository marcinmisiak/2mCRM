<?php
/* @var $this PrzydzielenieController */
/* @var $data Przydzielenie */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kiedy')); ?>:</b>
	<?php echo CHtml::encode($data->kiedy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wykonano')); ?>:</b>
	<?php echo CHtml::encode($data->wykonano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domains_id')); ?>:</b>
	<?php echo CHtml::encode($data->domains_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />


</div>