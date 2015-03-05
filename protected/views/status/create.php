<?php
/* @var $this StatusController */
/* @var $model Status */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Statuses'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Status', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Status', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Status') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>