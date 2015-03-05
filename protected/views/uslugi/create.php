<?php
/* @var $this UslugiController */
/* @var $model Uslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Usługi'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Usług', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Usługami', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Usługę') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>