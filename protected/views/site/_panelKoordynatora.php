<h2>Panel koordynatora</h2>
<div class="row">

<div class="panel panel-default">
<div class="panel-heading">Pracownicy</div>
<div class="panel-body">
<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'users-grid',
		'dataProvider'=>$pracownicy->search(),
		'filter'=>$pracownicy,
		
		'columns'=>array(
			'imie','nazwisko','roles',
				array('name'=>'id', 'value'=>'$data->getButtonK()',
						'type'=>'raw', 'filter'=>'','header'=>''
						
				),
// 				array(
// 						'class'=>'bootstrap.widgets.BsButtonColumn',
// 						'buttons'=>array(
							
// 								'update' => array(
// 										'url'=>'Yii::app()->controller->createUrl("/klient/update/",array("id"=>$data->id))',
// 								),
// 								'view' => array(
// 										'url'=>'Yii::app()->controller->createUrl("/users/$data->id")',
// 								)
// 						),
// 				),

		),
));
?>
<div class="panel panel-default">
<div class="panel-body">

<div class="col-lg-6">
<div class="panel panel-default">


<span id="div_pracownik"></span>

</div>
</div>



<div class="col-lg-6">
<div class="panel panel-default">
<div class="panel-heading"><h4>domeny dostępne</h4></div>
<div class="panel-body">



<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domenyDostepne-grid',
		'dataProvider'=>$domains_dostepne->search(),
		'filter'=>$domains_dostepne,
		
		'columns'=>array(
		'name',
		'client',
		'expiry_date',
		array('name'=>'expiry_date_od',
'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$domains_dostepne, 
                'attribute'=>'expiry_date_od', 
                'language' => 'pl',
                'htmlOptions' => array(
                    // 'id' => 'datepicker_for_expiry_date_do',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'Y-m-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true),
),
				array('name'=>'expiry_date_do',
						'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model'=>$domains_dostepne,
								'attribute'=>'expiry_date_do',
								'language' => 'pl',
								'htmlOptions' => array(
										'id' => 'datepicker_for_eexpiry_date_do',
										'size' => '10',
								),
								'defaultOptions' => array(  // (#3)
										'showOn' => 'focus',
										'dateFormat' => 'yy-mm-dd',
										'showOtherMonths' => true,
										'selectOtherMonths' => true,
										'changeMonth' => true,
										'changeYear' => true,
										'showButtonPanel' => true,
								)
						),
								true),
				)
			
			
				
			),
));


?>

</div>
</div>
</div>
</div>
</div>

</div>
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">Klienci/Prospekt</div>
<div class="panel-body">
<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'klienci-grid',
		'dataProvider'=>$klienci->search(),
		'filter'=>$klienci,
		
		'columns'=>array(
			 array('name'=>	'bez_telefonu', 'filter'=>array("2"=>'Ma telefon', "1"=>"Bez telefonu")),
				'nazwa', 'email', 
				array('name' =>'status_id',
				'value'=> '$data->status->nazwa',
						'filter' => CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa'),
),
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
</div>

<div class="col-sm-12">
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