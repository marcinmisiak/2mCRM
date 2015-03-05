<?php
/* @var $this TuslugiController */
/* @var $model Tuslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Tuslugis'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Tuslugi', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Tuslugi', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Tuslugi') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>