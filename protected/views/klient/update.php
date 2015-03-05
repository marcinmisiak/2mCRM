<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Klients'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Klient', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Klient', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Klient', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Klient', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','Klient '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model,'domains'=>$domains)); ?>