<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app ()->params['tytulstrony'];

?>


<?php
if (! Yii::app ()->user->isGuest) {
	
	echo '<div id="AjFlash" class="alert alert-success" role="alert" style="display:none"></div>';
	


} else {
	?>
<h1>
	Witamy w <i><?php echo CHtml::encode(Yii::app()->name); ?></i>
</h1>
<h2>Zaloguj się</h2>
<?php

}

?>


