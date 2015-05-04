<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Domeny'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Domen', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Domenami', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Domenę') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>