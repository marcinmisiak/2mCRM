<?php
/* @var $this KontaktSposobController */
/* @var $model KontaktSposob */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Sposobs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista KontaktSposob', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz KontaktSposob', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd KontaktSposob', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktSposob', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','KontaktSposob '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>