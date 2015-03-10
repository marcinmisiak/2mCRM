<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domenyDostepne-grid',
		'dataProvider'=>$domains_dostepne->search(),
		//'filter'=>$domains_dostepne,

		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'template'=>'{add}',
						'buttons'=>array(
								'add'=>array(
										'label'=>BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT),
										'url'=>'Yii::app()->controller->createUrl("klient/przydzielDomene/",array("id"=>$data->id,"klient_id"=>"???"))',
										'options' => array('ajax' =>
												array('type' => 'POST',
														'url'=>'js:$(this).attr("href")',
														'success' => 'js:function(data) { $.fn.yiiGridView.update("domains-grid"); $.fn.yiiGridView.update("domainsWybrane-grid")}')
										),
								),
						),
				),
				'name',
				'client',
				'expiry_date'
		),
));

Yii::app()->clientScript->registerScript('szukajDomaneyDostepne', "

$('#buttonSzujakDostepneDomeny').click(function(){
	$('#domenyDostepne-grid').yiiGridView('update', {
		data: $('#formDomenyDostepne').serialize()
	});
	return false;
});


		$('#formDomenyDostepneCheck input:checkbox').click(function(){
		if (! $('#buttonZapiszPrzydzialenie').length)
		{
		alert ('Wybierz pracownika!');
		 $('#formDomenyDostepneCheck input:checkbox').removeAttr('checked');
		} else {
			$('#przydzielanie-form-input-hiden').html('');
			$('#formDomenyDostepneCheck input:checkbox:checked').each( function() {

			 $('#przydzielanie-form-input-hiden').append( '<input type=\"hidden\" name=\"domains_id[]\" value=\"' + this.value + '\">');
			// alert(this.value);
			});
		}
		});

");
?>