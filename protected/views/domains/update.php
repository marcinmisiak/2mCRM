<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Domains', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Domains', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Domains', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Domains', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','Domains '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>