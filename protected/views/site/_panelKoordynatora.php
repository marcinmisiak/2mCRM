<div class="row">
<div class="col-sm-7">
<div class="panel panel-default">
<div class="panel-heading">Klienci</div>
<div class="panel-body">
<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'klienci-grid',
		'dataProvider'=>$klienci->search(),
		'filter'=>$klienci,
			
		'columns'=>array(
			 array('name'=>	'bez_telefonu', 'filter'=>array("2"=>'Ma telefon', "1"=>"Bez telefonu")),
				'nazwa', 'email',
				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'buttons'=>array(
								'delete'=>array(
										
										'url'=>'Yii::app()->controller->createUrl("/klient/delete/",array("id"=>$data->id))',
										
								),
								'update' => array(
										'url'=>'Yii::app()->controller->createUrl("/klient/update/",array("id"=>$data->id))',
								),
								'view' => array(
										'url'=>'Yii::app()->controller->createUrl("/klient/$data->id")',
								)
						),
				),

		),
));

?>
  </div>
</div>
</div>
<div class="col-sm-5">
<div class="panel panel-default">
  <div class="panel-heading">
  Domeny bez klienta (data wygaśniecia od: <?php echo date('Y-m-d',$expiry_data_od); ?>)
  
    </div>
  <div class="panel-body">
  <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'domains-grid',
			'dataProvider'=>$domains->searchBezKlienow(),
			'filter'=>$domains,
			
			'columns'=>array(
        		
		'name',
		'client',
		'expiry_date',
					array(
							'class'=>'bootstrap.widgets.BsButtonColumn',
							'template'=>'{przydziel} {view}',
							'buttons'=>array(
									'przydziel'=>array(
											 'url'=>'Yii::app()->controller->createUrl("/domains/przydziel/",array("id"=>$data->id))',
											'label'=>BsHtml::icon(BsHtml::GLYPHICON_USER),
											'options'=>array( 'title'=>'przydziel', 'data-title'=>'przydziel', 'data-original-title'=>''),
											),
									
									'view' => array(
											'url'=>'Yii::app()->controller->createUrl("/klient/$data->id")',
									)
							),
					),
				
			),
        )); ?>

   
   
  </div>
</div>
</div>
</div>

<!-- Modal -->
<div id="modalPrzydziel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
 
    // this will open the Modal with the given id
    function openModal( id, header, body){
        var closeButton = '<button data-dismiss="modal" class="close" type="button">×</button>';
 
        $("#" + id + " .modal-header").html( closeButton + '<h3>'+ header + '</h3>');
        $("#" + id + " .modal-body").html(body);
     // $("#" + id + " .modal-footer").html(footer data); // you can also change the footer
        $("#" + id).modal("show");
    }
 
</script>