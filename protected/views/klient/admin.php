<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */


$this->breadcrumbs=array(
	'Klientci'=>array('index'),
	'Zarządzaj',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Klientóœ', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Klienta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#klient-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Zarządzaj','Klients') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Zaawansowane szukanie',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
       

        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'klient-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		
		'nazwa',
		'adrrej_adres',
		array('header'=>'Adres Kod, Miasto, Kraj',
				'value' => 	'$data->adrrej_kod ." ". $data->adrrej_miasto ." ". $data->adrrej_kraj'),
		
		'nip',
		'regon',
		'krs',
		'www',
		'email',
		//array('name'=>'domains.name',
		//'value'=> 'getDomains()'),
					/*
		'notatka',
		'rozmowa_konczaca',
		'status_id',
		'users_id',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




