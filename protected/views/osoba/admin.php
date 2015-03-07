<?php
/* @var $this OsobaController */
/* @var $model Osoba */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */


$this->breadcrumbs=array(
	'Osobas'=>array('index'),
	'Zarządzaj',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Osoba', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Osoba', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#osoba-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Zarządzaj','Osobas') ?>
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
			'id'=>'osoba-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'imie',
		'nazwisko',
		'telefon',
		'telefon_kom',
		'email',
		/*
		'email_pryw',
		'email_sl',
		'aktywny',
		'klient_id',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




