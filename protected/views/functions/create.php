<?php
/* @var $this FunctionsController */
/* @var $model Functions */
?>

<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Functions', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Functions', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Functions') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>