<?php
/* @var $this FunkcjaController */
/* @var $data Funkcja */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfunkcja')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idfunkcja),array('view','id'=>$data->idfunkcja)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazwa')); ?>:</b>
	<?php echo CHtml::encode($data->nazwa); ?>
	<br />


</div>