<?php 
Yii::app()->clientScript->registerScript('search', "
$('.dodajOsobe-button').click(function(){
$('.dodajOsobe-form').toggle();
return false;
});
	
		");


?>

<div class="panel panel-default">
<div class="panel-heading">Lista kontaktów</div>
<div class="panel-body">
<?php
if (!empty($osoby)) {
 $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'osoba-grid',
		'dataProvider'=>$osoby,
		// 'filter'=>$model,
		'columns'=>array(
				
				'imie',
				'nazwisko',
				'telefon',
				'telefon_kom',
				'email',
				
				 'email_pryw',
'email_sl',
'aktywny',

				array(
						'class'=>'bootstrap.widgets.BsButtonColumn',
						'template'=>'{usun} {update}',
						'buttons'=>array(
								'usun'=>array(
										'label'=>BsHtml::icon(BsHtml::GLYPHICON_TRASH),
										'data-original-title' =>'Usuń',
										'url'=>'Yii::app()->controller->createUrl("klient/updateDeleteDomain/",array("id"=>$data->id,"klient_id"=>'.$klient_id.'))',
										'options' => array('ajax' =>
												array('type' => 'POST',
														'url'=>'js:$(this).attr("href")',
														'success' => 'js:function(data) { $.fn.yiiGridView.update("domains-grid"); $.fn.yiiGridView.update("domainsWybrane-grid")}'),
												'alt'=>'usuń'
										),
								),
								'update' => array(
										'url'=>'Yii::app()->controller->createUrl("/osoba/update/",array("id"=>$data->id))',
 							)
						),
				),
		),
        )); 
				
}
?>
</div></div>
<?php 
echo BsHtml::button('Nowa osoba',array('class' =>'dodajOsobe-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#');
?>

<div class="dodajOsobe-form" style="display:none">
<div class="panel panel-default">
<div class="panel-heading">Dodaj nowy kontakt</div>
<div class="panel-body">
	
<?php

$modelOsoba = new Osoba();
$modelOsoba->klient_id = $klient_id;
 $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'osoba-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
 		'layout' => BsHtml::FORM_LAYOUT_VERTICAL,
 		'action'=>Yii::app()->createAbsoluteUrl('osoba/createKlient/'),
)); 

  ?>

    <?php echo $form->errorSummary($modelOsoba); ?>

    <?php echo $form->textFieldControlGroup($modelOsoba,'imie',array('maxlength'=>24)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'nazwisko',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'telefon',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'telefon_kom',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'email',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'email_pryw',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'email_sl',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($modelOsoba,'aktywny'); ?>
    
    <?php echo $form->hiddenField($modelOsoba,'klient_id'); ?>

    <?php  echo BsHtml::ajaxSubmitButton('Dodaj osobę kontaktową', Yii::app()->createAbsoluteUrl('osoba/createKlient/'), 
    		array('method'=>'POST', 
    				'success' => 'js:function(data) { $.fn.yiiGridView.update("osoba-grid"); $(".dodajOsobe-form").toggle(); }',
    				 'alt'=>'usuń' ),
    		  array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'class'=>'sendOsobe-button')
    );

  ?>

<?php $this->endWidget(); ?>
</div></div>
</div>
<?php 
// var_dump($osoby);