<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->params['tytulstrony'];

?>


<?php
if (! Yii::app ()->user->isGuest) {
	
	echo '<div id="AjFlash" class="alert alert-success" role="alert" style="display:none"></div>';
	
	if ( Yii::app ()->user->checkAccess ( array('telemarketer') ) ){
		$domains = new Domains('search');
		$domains->user_id=Yii::app()->user->id;
		$domains->user_id=369;
		
		$this->renderPartial('_panelTeleparketera',array('domains'=>$domains));
	}
	
	if ( Yii::app ()->user->checkAccess ( array('koordynator') ) ){
		echo BsHtml::linkButton("Panel koorsynatora", array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'url'=> Yii::app()->createUrl('site/panelKoordynatora')));
		
	
		
			}
} else {
	?>
<h1>
	Witamy w <i><?php echo CHtml::encode(Yii::app()->name); ?></i>
</h1>
<?php

}

?>


