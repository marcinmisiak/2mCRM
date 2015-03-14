<?php
/* @var $this UzycieController */
/* @var $model Uzycie */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */


$this->breadcrumbs=array(
	'Raporty',
	'Raport pracy telemarketera',
);

// $this->menu=array(
// 	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Uzycie', 'url'=>array('index')),
// 	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Uzycie', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#uzycie-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Raport pracy telemarketera') ?>
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
			'id'=>'uzycie-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		
		'od',
		'do',
		'przydzielenie.domains.name',
		array('header'=>'email', 'value'=>'$data->przydzielenie->domains->klients[0]->email'),
		array('header'=>'Nazwa abonenta', 'value'=>'$data->przydzielenie->domains->klients[0]->nazwa'),
		array('header'=>'Telefon', 'value'=>'$data->przydzielenie->domains->klients[0]->telefon'),
		array('header'=>'Data końca','value'=>'$data->przydzielenie->domains->expiry_date' ),
		array('header'=>'Rejestrator','value'=>'$data->przydzielenie->domains->registrar' ),
		array('header'=>'Osoby kontaktowe','value'=>'$data->getOsoby()' ),
					
		array('name'=>'przydzielenie.wykonano',  'value'=>'($data->przydzielenie->wykonano) ? "Tak":"Nie"', 
				//'filter'=>CHtml::dropDownList('Uzycie[wykonano]','', array('0'=>'Nie', '1'=>'Tak'),array('empty'=>'') )
        ),
		array('name' =>'status_id', 'value'=>'$data->status->nazwa', 'filter'=> CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa') ),
		array('header'=>'Notatka', 'value'=>'$data->przydzielenie->domains->klients[0]->notatka'),
		array('header'=>'Zainteresowany', 'value'=>'$data->getZaineteresowany()'),
		array('name' =>'users_id', 'value'=>'$data->users->imie ." ". $data->users->nazwisko ." (".$data->users->email .")"', 'filter'=> CHtml::listData(Users::model()->findAll(array('condition'=>"roles is not null or roles !=''", 'order'=>'nazwisko')), 'id', 'nazwisko') )
			),
        )); ?>
    </div>
</div>




