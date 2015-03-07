usuwamy juz nie potrzebne

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'klient-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
		'layout'=>BsHtml::FORM_LAYOUT_VERTICAL,
)); ?>
<div role="tabpanel">

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#daneKlienta" aria-controls="daneKlienta" role="tab" data-toggle="tab">Dane Klienta</a></li>
    <li role="presentation"><a href="#domeny" aria-controls="domeny" role="tab" data-toggle="tab">Domeny</a></li>
    </ul>
    
    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="daneKlienta">
   
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nazwa',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_adres',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_kod',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_miasto',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'adrrej_kraj',array('maxlength'=>45)); ?>
    <?php echo $form->textFieldControlGroup($model,'nip',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'regon',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'krs',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'www',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>250)); ?>
    <?php echo $form->textAreaControlGroup($model,'notatka',array('rows'=>6)); ?>
   
   
    <?php echo $form->checkBoxControlGroup($model,'rozmowa_konczaca'); ?>
     <P>.</P>
    <?php echo $form->dropDownListControlGroup($model,'status_id',CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa'),array('empty'=>'Wybierz...')); ?>
    
   
    <?php
    if($model->scenario == "administrator") {
   		echo $form->dropDownListControlGroup($model,'users_id',CHtml::listData(Users::model()->findAll(array('condition'=>"roles != ''", 'order'=>'nazwisko')), 'id', 'Label'),array('empty'=>'Wybierz...')); 
    } else {
    	echo $form->hiddenField($model,'users_id');
    }
     
 ?>
 </div>
  <div role="tabpanel" class="tab-pane" id="domeny">
  <div class="panel panel-default col-sm-6">
    <div class="panel-heading">
        <h3 class="panel-title">Domeny klienta</h3>
    </div>
    <div class="panel-body" id="domeny_obecne">
    
   
     <?php 
   //  Klient::model()->domains
    // var_dump($model->domains);
     $domainsID = array();
     $session = Yii::app()->session;
     
     if (!empty($session['domainsID'])) {
     	$domainsID = $session['domainsID'];
     $domainsID = array_unique($domainsID);
     }
     $criteria= new CDbCriteria;
     $criteria->addInCondition('id', $domainsID);
     
     $domenyWybrane = Domains::model()->findAll($criteria);
     $dataProvider=new CArrayDataProvider($domenyWybrane, 
     		array(
     		'id'=>'id',    
     
     		'pagination'=>array(
     				'pageSize'=>50,
     		),
     ));
     $this->renderPartial("_domainsWybrane",array('dataProvider'=>$dataProvider));
     
   
            ?>
   </div>
   </div>
<?php 
  $this->renderPartial("_domainsDostepne",array('domains'=>$domains));
?>
     <div class="col-xs-12">
</div>
</div>
    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
</div>
</div>
<?php $this->endWidget(); ?>