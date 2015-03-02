<?php
/* @var $this FunkcjaController */
/* @var $model Funkcja */
?>

<?php
$this->breadcrumbs=array(
	'Funkcjas'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Funkcja', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Funkcja', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Funkcja') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>