<?php
/* @var $this KontaktStatusController */
/* @var $model KontaktStatus */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Statuses'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista KontaktStatus', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktStatus', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','KontaktStatus') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>