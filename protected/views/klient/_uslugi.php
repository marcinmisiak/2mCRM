<div class="panel panel-default">
<div class="panel-heading">Lista usług</div>
<div class="panel-body">
<?php

	$this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'uslugi-grid',
			'dataProvider'=>$klientHasUslugi->search(),
			 'filter'=>$klientHasUslugi,
			'columns'=>array(
					'uslugi.nazwa', 'uslugi.tuslugi.nazwa',
					'data_od', 'data_do', 'kwota',
					array ( 'name'=> 'zaplacone', 'value'=>'$data->zaplacone ? "Tak":"Nie"', 'filter'=>$this->taknie),

// 					array(
// 							'class'=>'bootstrap.widgets.BsButtonColumn',
// 							'template'=>'{usun} {update}',
// 							'buttons'=>array(
// 									'usun'=>array(
// 											'label'=>BsHtml::icon(BsHtml::GLYPHICON_TRASH),
// 											'data-original-title' =>'Usuń',
// 											'url'=>'Yii::app()->controller->createUrl("klient/updateDeleteDomain/",array("id"=>$data->id,"klient_id"=>'.$klient_id.'))',
// 											'options' => array('ajax' =>
// 													array('type' => 'POST',
// 															'url'=>'js:$(this).attr("href")',
// 															'success' => 'js:function(data) { $.fn.yiiGridView.update("domains-grid"); $.fn.yiiGridView.update("domainsWybrane-grid")}'),
// 													'alt'=>'usuń'
// 											),
// 									),
// 									'update' => array(
// 											'url'=>'Yii::app()->controller->createUrl("/osoba/update/",array("id"=>$data->id))',
// 									)
// 							),
// 					),
			),
	));


?>
</div></div>
<?php 


$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'klient-has-uslugi-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
		'layout' => BsHtml::FORM_LAYOUT_VERTICAL,
		'action'=>Yii::app()->createAbsoluteUrl('/klientHasUslugi/validate/'),
));

?>

    <?php echo $form->errorSummary($klientHasUslugi); ?>

    <?php echo $form->dropDownListControlGroup($klientHasUslugi,'uslugi_id', CHtml::listData(Uslugi::model()->findAll(array('order'=>'nazwa')),'id','nazwa'), array('empty' => '(wybierz usluge)'));?>   
    
    <?php echo $form->textFieldControlGroup($klientHasUslugi,'data_od'); ?>
     <?php echo $form->textFieldControlGroup($klientHasUslugi,'data_do'); ?>
      <?php echo $form->textFieldControlGroup($klientHasUslugi,'kwota'); ?>
      <?php echo $form->dropDownListControlGroup($klientHasUslugi,'zaplacone', $this->taknie); ?>
     
    
    <?php echo $form->hiddenField($klientHasUslugi,'klient_id'); ?>

    <?php  echo BsHtml::ajaxSubmitButton('Dodaj usługę', Yii::app()->createAbsoluteUrl('/klientHasUslugi/create/'), 
    		array('method'=>'POST', 
    				'data'=>'js:$("#klient-has-uslugi-form").serialize()',
    				'success' => 'js:function(data) { $.fn.yiiGridView.update("uslugi-grid") }',
    				 'alt'=>'dodaj' ),
    		  array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'class'=>'sendOsobe-button')
    );

  ?>

<?php $this->endWidget(); ?>
