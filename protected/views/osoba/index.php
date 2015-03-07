<?php
/* @var $this OsobaController */
/* @var $dataProvider CActiveDataProvider */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Osobas',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Osoba', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Osoba', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Osobas') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>