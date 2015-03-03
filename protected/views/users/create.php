<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Users', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','użytkownika') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>