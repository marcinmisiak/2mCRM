<div class="row">
<div class="col-sm-7">
<div id="createByDomain_info"></div>
<div class="panel panel-default">
  <div class="panel-heading">Klient</div>
  <div class="panel-body">
   <?php 
   if (!empty($domains)) {
   	
   
   if (!empty($klient)) {
   	?>
   		<div class="row">
   		<div class="col-xs-6 pull-left">Numer kontaktowy: <br> <?php echo $klient->telefon; ?></div>
   		<div class="col-xs-6" pull-right">Data: <?php echo date("Y-m-d H:i"); ?></div>
   		</div>
   		<div class="row">
   		<div class="col-xs-4">
   		Dane firmy:<br>
   		<?php echo $klient->nazwa; ?>
   		<br>
   		<?php echo $klient->adrrej_adres; ?>
   		<br>
   		<?php echo $klient->adrrej_kod . " " . $klient->adrrej_miasto; ?>
   		<br>data wygaśnięcia:<br>
   		<?php echo date("d.m.Y", strtotime($domains->expiry_date)); ?>
   		<br>
   		<?php echo $klient->email; ?>
   		<br>rejestrator: 
   		<?php echo $domains->registrar; ?>
   		</div>
   		
   		<div id="col-xs-8">
   		
   		<?php
   		 $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
   				'id'=>'status-form',
   				// Please note: When you enable ajax validation, make sure the corresponding
   				// controller action is handling ajax validation correctly.
   				// There is a call to performAjaxValidation() commented in generated controller code.
   				// See class documentation of CActiveForm for details on this.
   				'enableAjaxValidation'=>false,
   		 		'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
   		));
   		 
   		 ?>
   		 
   		   <?php echo $form->dropDownListControlGroup($klient,'status_id',CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa'),array('empty'=>'Wybierz...',  'controlOptions' => array('class'=>'col-lg-4')), array('class'=>'col-lg-4')); ?>
   		     
   		 <?php echo $form->textAreaControlGroup($klient,'notatka',array('rows'=>3, 'cols'=>50, 'class'=>'input-medium', 'controlOptions' => array('class'=>'col-lg-4'))); ?>
   		    
   		    
   		     <?php echo $form->checkBoxControlGroup($klient,'rozmowa_konczaca',array('Rozmoowa kończąca')); ?>
   		    
   		     
   		
   		<?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
   		<?php $this->endWidget(); ?>
   		
   		</div>
   		</div>
   		<?php
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
<div class="col-sm-5">
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
					array('name'=>'kiedy', 'header'=>'Przydzielono'),
		'domains.name',
		'domains.client',
		'domains.expiry_date',
				
			),
        )); ?>

   
   
  </div>
</div>
</div>
</div>

