<div class="panel panel-default col-sm-6">
<div class="panel-heading">
<h3 class="panel-title">Dostępne domeny</h3>
</div>
<div class="panel-body">
<?php
$this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domains-grid',
		'dataProvider'=>$domains->searchWolne(),
		'filter'=>$domains,
		'columns'=>array(
				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'template'=>'{add}',
						'buttons'=>array(
								'add'=>array(
										'label'=>BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT),
										'url'=>'Yii::app()->controller->createUrl("klient/updateAddDomain/",array("id"=>$data->id,"klient_id"=>'.$klient_id.'))',
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
		),
		 
		 
            )); ?>
     </div></div>