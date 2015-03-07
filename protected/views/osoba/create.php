<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Osobas'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Osoba', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Osoba', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Osoba') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>