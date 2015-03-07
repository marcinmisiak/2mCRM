<?php
/* @var $this DomainsController */
/* @var $model Domains */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */


$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Zarządzaj',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Domains', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Domains', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#domains-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Zarządzaj','Domains') ?>
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
			'id'=>'domains-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'user_id',
		'name',
		'expiry_date',
		'registrar',
		'added_date',
		/*
		'client',
		'phone',
		'email',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




