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
/*
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
*/

Yii::app ()->clientScript->registerScript ( 'exportExcel', "

$('.form-control').change(function() {
$('#btn-excel').attr('href', function(index, href) {
	var param = $('.form-control').serialize();

	if (href.charAt(href.length - 1) === '?')
		return href + param;
	else if (href.indexOf('?') > 0)
		return href + '&' + param;
	else
		return href + '?' + param;
});
})
" );

echo BsHtml::linkButton ( 'Excel', array (
		'id' => 'btn-excel',
		'url' => Yii::app ()->createAbsoluteUrl ( 'uzycie/admin', array (
				'exportType' => 'Excel2007'
		) ),
		'color' => BsHtml::BUTTON_COLOR_LINK,
		'icon' => BsHtml::GLYPHICON_EXPORT
) );
$this->widget ( 'ext.mPrint.mPrint', array (
		// 'pagination'=>false,
		'title' => 'Lista Grup', // the title of the document. Defaults to the HTML title
		'tooltip' => 'Druk', // tooltip message of the print icon. Defaults to 'print'
		'text' => 'Drukuj', // text which will appear beside the print icon. Defaults to NULL
		'element' => '#uzycie-grid', // the element to be printed.
		'exceptions' => array ( // the element/s which will be ignored
				'.summary',
				'.search-form',
				'.pagination'
		),
		'publishCss' => true  // publish the CSS for the whole page?
) );

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Raport pracy telemarketera
    </div>
    <div class="panel-body">
    

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'uzycie-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
					array('name' =>'users_id', 'header'=>'Pracownik', 'value'=>'$data->users->imie ." ". $data->users->nazwisko ." (".$data->users->email .")"', 'filter'=> CHtml::listData(Users::model()->findAll(array('condition'=>"roles is not null or roles !=''", 'order'=>'nazwisko')), 'id', 'nazwisko') ),
		'od',
		'do',
		array('header'=>'Czas otwartego przydzielenia', 'value'=>'$data->getCzasoddo()' ),
		array('header'=>'Czas od przydzielenia', 'value'=>'$data->getCzasodPrzydzielenia()' ),
		'przydzielenie.domains.name',
					array('type'=>'raw', 'header'=>'Abonent', 'value'=>'$data->przydzielenie->domains->klients[0]->nazwa ."<br>" . $data->przydzielenie->domains->klients[0]->telefon
			."<br>" . $data->przydzielenie->domains->klients[0]->email
				'
					),
				
		
		array('header'=>'Data końca','value'=>'$data->przydzielenie->domains->expiry_date' ),
		array('header'=>'Rejestrator','value'=>'$data->przydzielenie->domains->registrar' ),
		array('header'=>'Osoby kontaktowe','value'=>'$data->getOsoby()' ),
					
		array('name'=>'przydzielenie.wykonano',  'value'=>'($data->przydzielenie->wykonano) ? "Tak":"Nie"', 
				 'filter'=>CHtml::dropDownList('Uzycie[wykonano]','', array('0'=>'Nie', '1'=>'Tak'),array('empty'=>'', 'class'=>'form-control') )
        ),
		array('name' =>'status_id', 'value'=>'$data->status->nazwa', 'filter'=> CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa') ),
		array('header'=>'Notatka', 'value'=>'$data->przydzielenie->domains->klients[0]->notatka'),
		array('header'=>'Zainteresowany', 'value'=>'$data->getZaineteresowany()', 'type'=>'raw'),
		
			),
        )); ?>
    </div>
</div>




