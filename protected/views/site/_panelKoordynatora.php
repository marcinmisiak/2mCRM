<?php
?>
<h2>Panel koordynatora</h2>
<div class="row">

	<div class="panel panel-default">
		<div class="panel-heading">Pracownicy</div>
		<div class="panel-body">
<?php

$this->widget ( 'bootstrap.widgets.BsGridView', array (
		'id' => 'users-grid',
		'dataProvider' => $pracownicy->search (),
		'filter' => $pracownicy,
		'columns' => array (
				'imie',
				'nazwisko',
				'roles',
				array (
						'name' => 'id',
						'value' => '$data->getButtonK()',
						'type' => 'raw',
						'filter' => '',
						'header' => '' 
				) 
		)
		 
)
// array(
// 'class'=>'bootstrap.widgets.BsButtonColumn',
// 'buttons'=>array(

// 'update' => array(
// 'url'=>'Yii::app()->controller->createUrl("/klient/update/",array("id"=>$data->id))',
// ),
// 'view' => array(
// 'url'=>'Yii::app()->controller->createUrl("/users/$data->id")',
// )
// ),
// ),

 );
if (! empty ( $przydzielenie->users_id )) {
	$pracownik = Users::model ()->findByPk ( $przydzielenie->users_id );
	?>
<div class="panel panel-default">
				<div class="panel-body">

					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Domeny przydzielone pracownikowi</h4>
								<h5><?php echo $pracownik->imie . " ".$pracownik->nazwisko ." ". $pracownik->email; ?></h5>
							</div>
							<div class="panel-body">

<?php
	
	$this->widget ( 'bootstrap.widgets.BsGridView', array (
			'id' => 'domenyPrzydzielone-grid',
			'dataProvider' => $przydzielenie->search (),
			'filter' => $przydzielenie,
			
			'columns' => array (
					array (
							'name' => 'kiedy',
							'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
									'model' => $przydzielenie,
									'attribute' => 'kiedy',
									'language' => 'pl',
									'htmlOptions' => array (
											'size' => '10' 
									),
									'options' => array ( // (#3)
											'showOn' => 'focus',
											'dateFormat' => 'yy-mm-dd',
											'showOtherMonths' => true,
											'selectOtherMonths' => true,
											'changeMonth' => true,
											'changeYear' => true,
											'showButtonPanel' => false 
									) 
							), true ) 
					),
					
					array (
							'name' => 'wykonano',
							'filter' => array (
									"0" => "Nie",
									"1" => "Tak" 
							),
							'value' => '$data->wykonano ? "Tak":"Nie"' 
					),
					'domains.name',
					'domains.client',
					'domains.expiry_date',
					array (
							'class' => 'bootstrap.widgets.BsButtonColumn',
							'buttons' => array (
									'delete' => array (
											'url' => 'Yii::app()->controller->createUrl("/przydzielenie/delete/",array("id"=>$data->id))',
											'options' => array (
													'ajax' => array (
															'type' => 'POST',
															'url' => 'js:$(this).attr("href")',
															'success' => 'js:function(data) { $.fn.yiiGridView.update("domenyDostepne-grid"); $.fn.yiiGridView.update("domenyPrzydzielone-grid"); }' 
													),
											),
									),
									'update' => array (
											'url' => 'Yii::app()->controller->createUrl("/przydzielenie/update/",array("id"=>$data->id))' 
									),
									'view' => array (
											'url' => 'Yii::app()->controller->createUrl("/przydzielenie/$data->id")' 
									) 
							) 
					) 
			) 
	)
	 );
	
	?>

</div>


						</div>
					</div>



					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Domeny nieprzydzielone pracownikom</h4>
							</div>
							<div class="panel-body">

<?php
	
	Yii::app ()->clientScript->registerScript ( 'szukajDomaneyDostepne', "

$('#buttonSzujakDostepneDomeny').click(function(){
	$('#domenyDostepne-grid').yiiGridView('update', {
		data: $('#formDomenyDostepne').serialize()
	});
	return false;
});

		

				
" );
	
	$form = $this->beginWidget ( 'bootstrap.widgets.BsActiveForm', array (
			'action' => "#",
			'method' => 'get',
			'id' => "formDomenyDostepne",
			'layout' => BsHtml::FORM_LAYOUT_INLINE 
	) );
	echo $form->label ( $domains_dostepne, 'expiry_date_od', array (
			'class' => 'control-label' 
	) );
	echo $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
			'model' => $domains_dostepne,
			'attribute' => 'expiry_date_od',
			'language' => 'pl',
			'htmlOptions' => array (
					// 'id' => 'datepicker_for_expiry_date_do',
					'size' => '10',
					'class' => 'form-label' 
			),
			'options' => array (
					
					'showOn' => 'focus',
					'dateFormat' => 'yy-mm-dd',
					'altFormat' => 'yy-mm-dd', // show to user format
					'showOtherMonths' => true,
					'selectOtherMonths' => true,
					'changeMonth' => true,
					'changeYear' => true,
					'showButtonPanel' => true 
			) 
	), true );
	echo $form->label ( $domains_dostepne, 'expiry_date_do', array (
			'class' => 'control-label' 
	) );
	echo $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
			'model' => $domains_dostepne,
			'attribute' => 'expiry_date_do',
			'language' => 'pl',
			'htmlOptions' => array (
					// 'id' => 'datepicker_for_eexpiry_date_do',
					'size' => '10',
					'class' => 'form-label' 
			),
			'options' => array (
					
					'showButtonPanel' => true,
					'showOn' => 'focus',
					'dateFormat' => 'yy-mm-dd',
					'altFormat' => 'yy-mm-dd', // show to user format
					'showOtherMonths' => true,
					'selectOtherMonths' => true,
					'changeMonth' => true,
					'changeYear' => true,
					'showButtonPanel' => true 
			) 
	), true );
	
	echo $form->textFieldControlGroup ( $domains_dostepne, 'name' );
	echo $form->textFieldControlGroup ( $domains_dostepne, 'client' );
	
	?>
<input type="hidden" value="domenyDostepne-grid" name="ajax">
   
        <?php echo BsHtml::ajaxSubmitButton('Szukaj', Yii::app()->createUrl('site/panelKoordynatora'), array('method'=>'get', 'data'=>'$(this).serialize()'), array('id'=>'buttonSzujakDostepneDomeny', 'color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
  

<?php
	$this->endWidget (); // koniex form szukania
	
	?>

<?php
	
	$this->widget ( 'bootstrap.widgets.BsGridView', array (
			'id' => 'domenyDostepne-grid',
			'dataProvider' => $domains_dostepne->searchPrzydzielanie (),
			// 'filter'=>$domains_dostepne,
			
			'columns' => array (
					array (
							'class' => 'bootstrap.widgets.BsButtonColumn',
							'template' => '{add}',
							'buttons' => array (
									'add' => array (
											'label' => BsHtml::icon ( BsHtml::GLYPHICON_ARROW_LEFT ),
											'url' => 'Yii::app()->controller->createUrl("/przydzielenie/przydziel/", array("id"=>"$data->id", "users_id"=>"' . $przydzielenie->users_id . '"))',
											'options' => array (
													'title' => 'Przydziel pracownikowi',
													'ajax' => array (
															'type' => 'POST',
															'url' => 'js:$(this).attr("href")',
															
															'success' => 'js:function(data) { $.fn.yiiGridView.update("domenyDostepne-grid"); $.fn.yiiGridView.update("domenyPrzydzielone-grid")}' 
													) 
											) 
									) 
							) 
					),
					
					'name',
					'client',
					'expiry_date' 
			) 
	) );
	
	?>

</div>
						</div>
					</div>
				</div>
			</div>

		</div>
<?php
} // konies users_id nioe puste
?>
<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Klienci/Prospekt</div>
				<div class="panel-body">
<?php

$this->widget ( 'bootstrap.widgets.BsGridView', array (
		'id' => 'klienci-grid',
		'dataProvider' => $klienci->search (),
		'filter' => $klienci,
		
		'columns' => array (
				array (
						'name' => 'bez_telefonu',
						'filter' => array (
								"2" => 'Ma telefon',
								"1" => "Bez telefonu" 
						) 
				),
				'nazwa',
				'email',
				array (
						'name' => 'status_id',
						'value' => '$data->status->nazwa',
						'filter' => CHtml::listData ( Status::model ()->findAll ( array (
								'order' => 'nazwa' 
						) ), 'id', 'nazwa' ) 
				),
				array (
						'class' => 'bootstrap.widgets.BsButtonColumn',
						'buttons' => array (
								'delete' => array (
										
										'url' => 'Yii::app()->controller->createUrl("/klient/delete/",array("id"=>$data->id))' 
								),
								'update' => array (
										'url' => 'Yii::app()->controller->createUrl("/klient/update/",array("id"=>$data->id))' 
								),
								'view' => array (
										'url' => 'Yii::app()->controller->createUrl("/klient/$data->id")' 
								) 
						) 
				) 
		) 
)
 );

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
  <?php
		
		$this->widget ( 'bootstrap.widgets.BsGridView', array (
				'id' => 'domains-grid',
				'dataProvider' => $domains->searchBezKlienow (),
				'filter' => $domains,
				
				'columns' => array (
						
						'name',
						'client',
						'expiry_date',
						array (
								'class' => 'bootstrap.widgets.BsButtonColumn',
								'template' => '{przydziel} {view}',
								'buttons' => array (
										'przydziel' => array (
												'url' => 'Yii::app()->controller->createUrl("/domains/przydziel/",array("id"=>$data->id))',
												'label' => BsHtml::icon ( BsHtml::GLYPHICON_USER ),
												'options' => array (
														'title' => 'przydziel',
														'data-title' => 'przydziel',
														'data-original-title' => '' 
												) 
										),
										
										'view' => array (
												'url' => 'Yii::app()->controller->createUrl("/klient/$data->id")' 
										) 
								) 
						) 
				) 
		)
		 );
		?>

   
   
  </div>
		</div>
	</div>


	<!-- Modal -->
	<div id="modalPrzydziel" class="modal fade bs-example-modal-lg"
		tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body"></div>
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