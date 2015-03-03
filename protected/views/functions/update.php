<?php
/* @var $this FunctionsController */
/* @var $model Functions */
?>

<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Functions', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Functions', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Functions', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Functions', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Functions '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>