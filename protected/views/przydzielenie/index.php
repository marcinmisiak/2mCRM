<?php
/* @var $this PrzydzielenieController */
/* @var $dataProvider CActiveDataProvider */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Przydzielenies',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Przydzielenie', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Przydzielenie', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Przydzielenies') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>