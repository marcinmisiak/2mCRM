<?php
/* @var $this UzytkownikController */
/* @var $model Uzytkownik */
?>

<?php
$this->breadcrumbs=array(
	'Uzytkowniks'=>array('index'),
	$model->iduzytkownik,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Uzytkownik', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Uzytkownik', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Uzytkownik', 'url'=>array('update', 'id'=>$model->iduzytkownik)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Uzytkownik', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->iduzytkownik),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Uzytkownik', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Uzytkownik '.$model->iduzytkownik) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'iduzytkownik',
		'login',
		'haslo',
		'imie',
		'nazwisko',
		'telefon',
		'email_pryw',
		'email_sl',
		'skype',
		'opis',
		'roles',
		'funkcjaIdfunkcja.nazwa',
	),
)); ?>