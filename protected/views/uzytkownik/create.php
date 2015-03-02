<?php
/* @var $this UzytkownikController */
/* @var $model Uzytkownik */
?>

<?php
$this->breadcrumbs=array(
	'Uzytkowniks'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Uzytkownik', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Uzytkownik', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Uzytkownik') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>