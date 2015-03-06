<?php

//$domenyWybrane = new CActiveDataProvider(Domains,array(
//			'criteria'=>$criteria,
//		));)
//var_dump($domenyWybrane);exit;
$this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domainsWybrane-grid',
		'dataProvider'=>$dataProvider,
		//'filter'=>Domains::model(),
		'columns'=>array(
			//	array('type'=>'raw', 'value' => '$data->getButtons()'),
				'name',
				//'expiry_date',
				//'registrar',
				//'added_date',

				'client',

				// 'email',


		),
   )); 
?>