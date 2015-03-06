<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Klients'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Klient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Klient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Klient') ?>

<?php // $this->renderPartial('_formCreate', array('model'=>$model, 'domains'=>$domains));
$this->renderPartial('_form', array('model'=>$model, 'domains'=>$domains));
?>


