<?php
/* @var $this KonfiguracjaController */
/* @var $model Konfiguracja */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Konfiguracjas'=>array('index'),
	'Utwórz',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Konfiguracja', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Konfiguracja', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Utwórz','Konfiguracja') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>