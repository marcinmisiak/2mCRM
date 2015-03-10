<?php
/* @var $this PrzydzielenieController */
/* @var $model Przydzielenie */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

?>

<?php
$this->breadcrumbs=array(
	'Przydzielenies'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Przydzielenie', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Przydzielenie', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Aktualizacja Przydzielenie', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Usuń Przydzielenie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Przydzielenie', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Podgląd','Przydzielenie '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kiedy',
		'wykonano',
		'domains_id',
		'users_id',
	),
)); ?>