<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Osobas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Aktualizuj',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Osoba', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Osoba', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Osoba', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Osoba', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Aktualizacja','Osoba '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>