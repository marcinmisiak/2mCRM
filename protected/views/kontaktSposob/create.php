<?php
/* @var $this KontaktSposobController */
/* @var $model KontaktSposob */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Sposobs'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista KontaktSposob', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktSposob', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','KontaktSposob') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>