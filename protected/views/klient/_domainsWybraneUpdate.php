<?php

//$domenyWybrane = new CActiveDataProvider(Domains,array(
//			'criteria'=>$criteria,
//		));)
//var_dump($domenyWybrane);exit;
$this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domainsWybrane-grid',
		'dataProvider'=>$dataProvider,
		//'filter'=>Domains::model(), nalezy dodrobi metote searchWybrane()
		'columns'=>array(
				'name',
				'client',
				'expiry_date',
				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'template'=>'{usun}',
						'buttons'=>array(
								'usun'=>array(
										'label'=>'',
										
										'url'=>'Yii::app()->controller->createUrl("klient/updateDeleteDomain/",array("id"=>$data->id,"klient_id"=>'.$klient_id.'))',
										'options' => array(
										'class'=>"glyphicon " . BsHtml::GLYPHICON_CIRCLE_ARROW_RIGHT,
										'title'=>"Usuń domene",
										'ajax' =>
												array('type' => 'POST',
														'url'=>'js:$(this).attr("href")',
														'success' => 'js:function(data) { $.fn.yiiGridView.update("domains-grid"); $.fn.yiiGridView.update("domainsWybrane-grid")}'),
														'alt'=>'usuń'
										),
								),
						),
				),

		),
   )); 
?>