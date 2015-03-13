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
				
				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'template'=>'{usun}',
						'buttons'=>array(
								'usun'=>array(
										'label'=>BsHtml::icon(BsHtml::GLYPHICON_CIRCLE_ARROW_RIGHT),
										
										'url'=>'Yii::app()->controller->createUrl("klient/createDeleteDomain/",array("id"=>$data->id))',
										'options' => array('ajax' =>
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