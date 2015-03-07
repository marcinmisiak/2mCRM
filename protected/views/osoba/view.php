<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

?>

<?php
$this->breadcrumbs=array(
	'Osobas'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Osoba', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Osoba', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Aktualizacja Osoba', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Usuń Osoba', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Osoba', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Podgląd','Osoba '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'imie',
		'nazwisko',
		'telefon',
		'telefon_kom',
		'email',
		'email_pryw',
		'email_sl',
		'aktywny',
		'klient_id',
	),
)); ?>