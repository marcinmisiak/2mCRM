<?php
/* @var $this DomainsController */
/* @var $dataProvider CActiveDataProvider */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php
$this->breadcrumbs=array(
	'Domains',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Domains', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Domains', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Domains') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>