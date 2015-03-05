<?php
/* @var $this KontaktStatusController */
/* @var $model KontaktStatus */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Statuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista KontaktStatus', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz KontaktStatus', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd KontaktStatus', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktStatus', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','KontaktStatus '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>