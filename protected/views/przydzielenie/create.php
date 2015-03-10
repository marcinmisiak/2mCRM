<?php
/* @var $this PrzydzielenieController */
/* @var $model Przydzielenie */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Przydzielenies'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Przydzielenie', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Przydzielenie', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Przydzielenie') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>