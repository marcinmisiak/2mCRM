<?php
/* @var $this TuslugiController */
/* @var $model Tuslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Typy usług'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Typów usług', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Typami usług', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Typ usługi') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>