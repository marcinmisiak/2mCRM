<?php
/* @var $this FunkcjaController */
/* @var $model Funkcja */
?>

<?php
$this->breadcrumbs=array(
	'Funkcjas'=>array('index'),
	$model->idfunkcja=>array('view','id'=>$model->idfunkcja),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Funkcja', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Funkcja', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Funkcja', 'url'=>array('view', 'id'=>$model->idfunkcja)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Funkcja', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Funkcja '.$model->idfunkcja) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>