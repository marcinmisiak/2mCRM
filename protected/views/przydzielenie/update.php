<?php
/* @var $this PrzydzielenieController */
/* @var $model Przydzielenie */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Przydzielenies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Przydzielenie', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Przydzielenie', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Przydzielenie', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Przydzielenie', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','Przydzielenie '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>