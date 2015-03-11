<div class="row">
<div class="col-sm-8">
<div id="createByDomain_info"></div>
<div class="panel panel-default">
  <div class="panel-heading">Klient</div>
  <div class="panel-body">
   <?php 
   if (!empty($domains)) {
   	
   
   if (!empty($klient)) {
   		echo "$klient->nazwa";
   } else {
   echo	BsHtml::alert(BsHtml::ALERT_COLOR_WARNING, 'Dla wybraniej domeny nie ma kartoteki klienta '.
   		 BsHtml::ajaxButton("Utwórz kartotekę kliena na podstawie danych o domenie $domains->name", Yii::app()->createAbsoluteUrl('/klient/createByDomain/'.$domains->id),
		array('success'=>'js: window.location="'.Yii::app()->getRequest()->getUrl().'"' )));
   
   }
   }
   ?>
  </div>
</div>
</div>
<div class="col-sm-4">
<div class="panel panel-default">
  <div class="panel-heading">
  Kolejka przydzielonych klientów
    </div>
  <div class="panel-body">
  <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'tuslugi-grid',
			'dataProvider'=>$przydzielanie->search(),
			'filter'=>$przydzielanie,
			
			'columns'=>array(
					array (
							'class' => 'bootstrap.widgets.BsButtonColumn',
							'template' => '{wybierz}',
							'buttons' => array (
									'wybierz' => array (
											'label' => BsHtml::icon ( BsHtml::GLYPHICON_ARROW_LEFT ),
											'url' => 'Yii::app()->controller->createUrl("site/panelTelemarketera", 
											array("id"=>"$data->domains_id", "Przydzielenie_page"=>"'.Yii::app()->getRequest()->getParam('Przydzielenie_page',false).'" )
  											)',
											'options' => array (
													'title' => 'Pokaż',
												
											)
									)
							)
					),
		'domains.name',
		'domains.client',
		'domains.expiry_date',
				
			),
        )); ?>

   
   
  </div>
</div>
</div>
</div>

