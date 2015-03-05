<?php
/* @var $this KlientController */
/* @var $model Klient */
/* @var $form BSActiveForm */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'klient-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Pola oznaczone <span class="required">*</span> są wymagane.</p>

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
    <?php echo $form->dropDownListControlGroup($model,'status_id',CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa'),array('empty'=>'Wybierz...')); ?>
    
   
    <?php
    if($model->scenario == "administrator") {
   		echo $form->dropDownListControlGroup($model,'users_id',CHtml::listData(Users::model()->findAll(array('condition'=>"roles != ''", 'order'=>'nazwisko')), 'id', 'Label'),array('empty'=>'Wybierz...')); 
    } else {
    	echo $form->hiddenField($model,'users_id');
    }
     
 ?>
  <div class="panel panel-default col-sm-6">
    <div class="panel-heading">
        <h3 class="panel-title">Domeny klienta</h3>
    </div>
    <div class="panel-body" id="domeny_obecne">
    
   
     <?php 
   //  Klient::model()->domains
    // var_dump($model->domains);
     $session = Yii::app()->session;
     $domainsID = $session['domainsID'];
     $domainsID = array_unique($domainsID);
     $criteria= new CDbCriteria;
     $criteria->addInCondition('id', $domainsID);
     
     $domenyWybrane = Domains::model()->findAll($criteria);
     $dataProvider=new CArrayDataProvider($domenyWybrane, 
     		array(
     		'id'=>'id',    
     
     		'pagination'=>array(
     				'pageSize'=>10,
     		),
     ));
     $this->renderPartial("_domainsWybrane",array('dataProvider'=>$dataProvider));
     
     /*
     $this->widget('bootstrap.widgets.BsGridView',array(
    		'id'=>'domains-grid',
    		'dataProvider'=> $model->domains,
    		//'filter'=>$model->domains,
    		'columns'=>array(
    				
    				'domains.name',
    				//'expiry_date',
    				//'registrar',
    				//'added_date',
    				
    				 'domains.client',
    
   // 'email',
    
    				array(
    						'class'=>'bootstrap.widgets.BsButtonColumn',
    				),
    		),
            )); 
            */
            ?>
   </div>
   </div>
   
 
 <div class="panel panel-default col-sm-6">
    <div class="panel-heading">
        <h3 class="panel-title">Dostępne domeny</h3>
    </div>
    <div class="panel-body">
 <?php 

     $this->widget('bootstrap.widgets.BsGridView',array(
    		'id'=>'domains-grid',
    		'dataProvider'=>$domains->search(),
    		'filter'=>$domains,
    		'columns'=>array(
    				array('type'=>'raw', 'header' => "", 'value' => "BsHtml::ajaxButton(
				BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT),
				Yii::app()->createUrl('klient/createAddDomain/', array('id'=>name),
				array('method'=>'POST', 'data'=>array('idaaa'=>id), 'update'=>'#domeny_obecne'),
				array('color' => BsHtml::BUTTON_COLOR_INFO, 'size' => BsHtml::BUTTON_SIZE_SMALL,)
				))"),
    				'id',
    				'name',
    				//'expiry_date',
    				//'registrar',
    				//'added_date',
    				
    				 'client',
    
   // 'email',
    
    				
    		),
            )); ?>
     </div></div>
     

    <?php echo BsHtml::submitButton('Zapisz', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
