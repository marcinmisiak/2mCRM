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
	
	if ( Yii::app ()->user->checkAccess ( array('koordynator','administrator') ) ){
		$klienci = new Klient("search");
		$klienci->unsetAttributes();
		$klienci->bez_telefonu=1;
		
		if (isset($_GET['Klient']))
			$klienci->attributes=$_GET['Klient'];
		
		
		$domains = new Domains('searchBezKlienta');
		$domains->unsetAttributes();
		
		$date_od = strtotime("-1 day");
		$domains->expiry_date_od = date('Y-m-d', $date_od); 
		
		$date = strtotime("+100 years");
		$domains->expiry_date_do = date('Y-m-d', $date);
		
		// $domains->klients = array('id'=>NULL);
		if(isset($_GET['Domains']))
			$domains->attributes=$_GET['Domains'];
		//var_dump($_GET['Domains']);
		$this->renderPartial('_panelKoordynatora',array('klienci'=>$klienci,'domains'=>$domains,'expiry_data_od'=>$date_od));
	}
} else {
	?>
<h1>
	Witamy w <i><?php echo CHtml::encode(Yii::app()->name); ?></i>
</h1>
<?php

}

?>


