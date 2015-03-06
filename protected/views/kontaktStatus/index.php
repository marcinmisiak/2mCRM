<?php
/* @var $this KontaktStatusController */
/* @var $dataProvider CActiveDataProvider */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Statuses',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz KontaktStatus', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktStatus', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Kontakt Statuses') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>