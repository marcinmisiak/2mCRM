<?php
/* @var $this FunkcjaController */
/* @var $model Funkcja */
?>

<?php
$this->breadcrumbs=array(
	'Funkcjas'=>array('index'),
	$model->idfunkcja,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Funkcja', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Funkcja', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Funkcja', 'url'=>array('update', 'id'=>$model->idfunkcja)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Funkcja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idfunkcja),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Funkcja', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Funkcja '.$model->idfunkcja) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'idfunkcja',
		'nazwa',
	),
)); ?>