<div class="row">
<div id="ajaxUsers"></div>
	<div class="panel panel-default">
		<div class="panel-heading">Pracownicy</div>
		<div class="panel-body">
<?php

$this->widget ( 'bootstrap.widgets.BsGridView', array (
		'id' => 'users-grid',
		'dataProvider' => $pracownicy->search (),
		'filter' => $pracownicy,
		'type'=>BsHtml::GRID_TYPE_HOVER,
		'columns' => array (
				'imie',
				'nazwisko',
				'telefon',
				'email',
				'functions.name',
				'roles',
					array (
								'class' => 'bootstrap.widgets.BsButtonColumn',
								'template' => '{uzycie} {update} <br> {przydzielanie}  {przydzel_masowo}',
								
								'buttons' => array (
										'update' =>array(
												'url'=> 'Yii::app()->controller->createUrl("users/update", array("id"=>"$data->id"))',
										),
										'uzycie' => array(
												'label' => BsHtml::icon ( BsHtml::GLYPHICON_LIST_ALT ),
												'url'=> 'Yii::app()->controller->createUrl("uzycie/byUser", array("id"=>"$data->id"))',
												'options' => array (
														'title' => 'Raport wykonania'
												)
										),
										'przydzielanie' => array(
												'label' => BsHtml::icon ( BsHtml::GLYPHICON_PHONE ),
												'url'=> 'Yii::app()->controller->createUrl("site/panelKoordynatora/", array("user_id"=>"$data->id"))',
												'options' => array (
														'title' => 'Przydziel'
												)
										),
										'przydzel_masowo' => array(
												'label' => BsHtml::icon ( BsHtml::GLYPHICON_COG ),
												//'url'=> 'Yii::app()->controller->createUrl("przydzielenie/masowo", array("id"=>"$data->id"))',
												'url'=> 'Yii::app()->controller->createUrl("przydzielenie/masowoModal", array("id"=>"$data->id"))',
												//'url'=>"#",
												'options' => array (
														'title' => 'Przydziel masowo',
												
												'ajax'=>array(
														'type'=>'POST',
														'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
														// 'update'=>'#ajaxUsers',
														'success' => 'js:function(data){
														$("#PrzydzelMasowoModal .modal-body-form").html(data);
														$("#PrzydzelMasowoModal").modal("show");
														}
														'
												),
														)
												
										)
								) 
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
<div id="przydzielenie_info"></div>
<?php
	
	$this->widget ( 'bootstrap.widgets.BsGridView', array (
			'id' => 'domenyPrzydzielone-grid',
			'dataProvider' => $przydzielenie->search (),
			'filter' => $przydzielenie,
			'type'=>BsHtml::GRID_TYPE_HOVER,
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
								<h4>Domeny nieprzydzielone pracownikom</h4><h5>Przypisane do klientów</h5>
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
					'class' => 'form-control' 
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
					'class' => 'form-control' 
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
	echo $form->dropdownListControlGroup ( $domains_dostepne, 'przydzielone', array("Wszytkie", "Nie przydzielone") );
	
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
			'type'=>BsHtml::GRID_TYPE_HOVER,
			'columns' => array (
					array (
							'class' => 'bootstrap.widgets.BsButtonColumn',
							'template' => '{add}',
							'buttons' => array (
									'add' => array (
											'label' => BsHtml::icon ( BsHtml::GLYPHICON_ARROW_LEFT ),
											 
											'click' => "function() {
											 $.fn.yiiGridView.update('domenyDostepne-grid', {
                                       		 type:'POST',
                                       		 url:$(this).attr('href'),
                                        	success:function(data) {
                                              $('#przydzielenie_info').html(data).fadeIn().animate({opacity: 1.0}, 5000).fadeOut('slow');
 
                                              $.fn.yiiGridView.update('domenyDostepne-grid');
											 $.fn.yiiGridView.update('domenyPrzydzielone-grid');
                                        	}
                                   			 })
                                   			return false;
											}",
											'url' => 'Yii::app()->controller->createUrl("/przydzielenie/przydziel/", array("id"=>"$data->id", "users_id"=>"' . $przydzielenie->users_id . '"))',
											'options' => array ('title' => 'Przydziel pracownikowi',),
													
// 											'options' => array (
// 													'title' => 'Przydziel pracownikowi',
// 													'ajax' => array (
// 															'type' => 'POST',
// 															'url' => 'js:$(this).attr("href")',
// 															//'url'=>'Yii::app()->controller->createUrl("/przydzielenie/przydziel/", array("id"=>"$data->id", "users_id"=>"' . $przydzielenie->users_id . '"))',
// 															// 'success' => 'js:function(data) { $.fn.yiiGridView.update("domenyDostepne-grid"); $.fn.yiiGridView.update("domenyPrzydzielone-grid"); }',
// 															'complete'=>'js: function() {$.fn.yiiGridView.update("domenyDostepne-grid"); $.fn.yiiGridView.update("domenyPrzydzielone-grid"); }',
// 													) 
// 											) 
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
		'type'=>BsHtml::GRID_TYPE_HOVER,
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
	 <div id="createklientbydomain"></div>
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
				'type'=>BsHtml::GRID_TYPE_HOVER,
				'afterAjaxUpdate' => 'reinstallDatePicker',
				'columns' => array (
						
						'name',
						'client',
						array('name'=>'expiry_date','filter'=> $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
									'model' => $domains,
									'attribute' => 'expiry_date',
									'language' => 'pl',
									'htmlOptions' => array (
											'id'=>'expiry_date',
											'size' => '10',
											'class'=>'form-control'
									),
									'options' => array ( 
											// 'showOn' => 'focus',
											'dateFormat' => 'yy-mm-dd',
											'showOtherMonths' => true,
											'selectOtherMonths' => true,
											'changeMonth' => true,
											'changeYear' => true,
											'showButtonPanel' => false 
									) 
							), true )),
						array('name'=>'added_date', 'filter'=> $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
									'model' => $domains,
									'attribute' => 'added_date',
									'language' => 'pl',
									'htmlOptions' => array (
											'id'=>'added_date',
											'size' => '10',
											'class'=>'form-control'
									),
									'options' => array ( 
											// 'showOn' => 'focus',
											'dateFormat' => 'yy-mm-dd',
											'showOtherMonths' => true,
											'selectOtherMonths' => true,
											'changeMonth' => true,
											'changeYear' => true,
											'showButtonPanel' => false 
									) 
							), true )
						 ),
						'phone',
						array (
								'class' => 'bootstrap.widgets.BsButtonColumn',
								'template' => '{dodajklient} {view}',
								'buttons' => array (
										'dodajklient' => array (
												'url' => 'Yii::app()->controller->createUrl("/klient/createByDomain/",array("id"=>$data->id))',
												'label' => BsHtml::icon ( BsHtml::GLYPHICON_USER ),
												'options' => array (
														'title' => 'Utwórz klienta',
														'ajax' => array(
																'type'=>'POST',
																'url' => 'js:$(this).attr("href")', 
																'update' =>'#createklientbydomain',
																
															 'success' => 'js:function(data) { $("#createklientbydomain").html(data);  $.fn.yiiGridView.update("domains-grid"); }',
															
															)
												),
												
										),
										
									
										
										'view' => array (
												'url' => 'Yii::app()->controller->createUrl("/domains/$data->id")' 
										) 
								) 
						) 
				) 
		)
		 );
		
		Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#added_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['pl'],{'dateFormat':'yy-mm-dd'}));
	$('#expiry_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['pl'],{'dateFormat':'yy-mm-dd'}));
}
");
		?>

   
   
  </div>
		</div>
	</div>
	
<div id="PrzydzelMasowoModal" role="dialog" tabindex="-1" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button data-dismiss="modal" class="close" type="button">&times;</button><h3>Przydzielanie masowe klientów do pracownika</h3></div>
<div class="modal-body">
<?php

$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'PrzydzielanieModal-form',
				'enableAjaxValidation'=>false,
				'action'=>'#',
				//'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
				
		)); 

?>
<div class="modal-body-form"></div>
<?php 



$this->endWidget('PrzydzielanieModal-form');
?>

</div>
<div class="modal-footer">
<?php echo BsHtml::ajaxButton('Szukaj nieprzydzielonych',
		array('przydzielenie/MasowoModal' ),
		array(
				'type'=>'POST',
				'url'=> Yii::app()->createAbsoluteUrl('przydzielenie/szukajNieprzydzielonychAjax' ),
				'data' => 'js:$("#PrzydzielanieModal-form").serialize()',
				'update'=>'#PrzydzelMasowoModal .modal-body-form',
				// 'success'=>'js:alert("ok")',
		),
		array('color' => BsHtml::BUTTON_COLOR_PRIMARY));
?>

<?php echo BsHtml::ajaxButton('Przydziel',
		array('przydzielenie/PrzydzielMasowo' ),
		array(
				'type'=>'POST',
				//'url'=> Yii::app()->createAbsoluteUrl('przydzielenie/PrzydzielMasowo' ),
				'data' => 'js:$("#PrzydzielanieModal-form").serialize()',
				'update'=>'#ajaxNieprzydzieloneInfo',
				// 'success'=>'js:alert("ok")',
		),
		array('color' => BsHtml::BUTTON_COLOR_SUCCESS));
?>

&nbsp;<button data-dismiss="modal" class="btn btn-default" name="yt24" type="button">Zamnkij</button></div>
</div></div></div>
