<?php
/* @var $this KonfiguracjaController */
/* @var $model Konfiguracja */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */


$this->breadcrumbs=array(
	'Konfiguracjas'=>array('index'),
	'Zarządzaj',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Konfiguracja', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Konfiguracja', 'url'=>array('create')),
);

?>

<?php echo BsHtml::pageHeader('Zarządzaj','Konfiguracjas') ?>
<div class="panel panel-default">
   
    <div class="panel-body">
   

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'konfiguracja-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'wolne_dni_tygodnia',
		'wolne_dni_daty',
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




