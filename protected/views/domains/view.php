<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

?>

<?php
$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name,
);

$this->menu=array(
  //  array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Domains', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Nowa domena', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Aktualizacja domeny', 'url'=>array('update', 'id'=>$model->id)),
//	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Usuń Domains', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Domains', 'url'=>array('admin')),

		
);
?>

<?php echo BsHtml::pageHeader('Podgląd','Domeny '.$model->name) ?>
<div id="klientInfo"></div>
<?php 
echo BsHtml::ajaxButton("Utwórz klienta na podstawie domeny", Yii::app()->createAbsoluteUrl('klient/createByDomain/'. $model->id), 
array('type'=>'POST', 'update'=>'#klientInfo'),
		array('color' => BsHtml::BUTTON_COLOR_PRIMARY,
				'icon'=>BsHtml::GLYPHICON_USER,
				'class'=>'pull-right'
)
);
?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		 // 'id',
		 array("label" => "Dodał", "value" => $model->user->imie . " " . $model->user->nazwisko . " " . $model->user->email),
		'name',
		'expiry_date',
		'registrar',
		'added_date',
		'client',
		'phone',
		'email',
	),
)); ?>