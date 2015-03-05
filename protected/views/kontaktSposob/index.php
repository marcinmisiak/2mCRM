<?php
/* @var $this KontaktSposobController */
/* @var $dataProvider CActiveDataProvider */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Kontakt Sposobs',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz KontaktSposob', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj KontaktSposob', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Kontakt Sposobs') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>