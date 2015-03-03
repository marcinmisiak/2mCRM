<?php
/* @var $this FunctionsController */
/* @var $model Functions */
?>

<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Functions', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Functions', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Functions', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Functions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Functions', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Functions '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>