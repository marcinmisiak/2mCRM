<?php
/* @var $this StatusController */
/* @var $model Status */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

?>

<?php
$this->breadcrumbs=array(
	'Statuses'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Status', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Status', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Aktualizacja Status', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Usuń Status', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Status', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Podgląd','Status '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nazwa',
	),
)); ?>