<?php
/* @var $this UslugiController */
/* @var $model Uslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Uslugis'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Uslugi', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Uslugi', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Uslugi') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>