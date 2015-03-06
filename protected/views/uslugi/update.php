<?php
/* @var $this UslugiController */
/* @var $model Uslugi */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Usługi'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Usług', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Usługę', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Usługi', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Usługami', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','Usługi '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>