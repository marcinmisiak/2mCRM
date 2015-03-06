<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Domains', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Domains', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Domains') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>