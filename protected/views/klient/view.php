<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

?>

<?php
$this->breadcrumbs=array(
	'Klients'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Klient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Klient', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Aktualizacja Klient', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Usuń Klient', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Klient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Podgląd','Klient '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
	
		'nazwa',
			'telefon',
		'adrrej_adres',
		'adrrej_kod',
		'adrrej_miasto',
		'adrrej_kraj',
		'nip',
		'regon',
		'krs',
		'www',
		'email',
		'notatka',
		'rozmowa_konczaca',
		'status_id',
		'users_id',
	),
)); ?>