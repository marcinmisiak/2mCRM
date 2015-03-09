<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo Yii::app()->params['meta_description'];?>">
<meta name="keywords" content="<?php echo Yii::app()->params['meta_keywords'];?>">
<meta name="author"
	content="Marcin Misiak marcin@wseip.edu.pl and YII with Bootstrap contributors">

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
$cs = Yii::app ()->clientScript;
$themePath = Yii::app ()->theme->baseUrl;

$cs->registerCssFile ( $themePath . '/assets/css/bootstrap.css' )->registerCssFile ( $themePath . '/assets/css/bootstrap-theme.css' );

$cs->registerCoreScript ( 'jquery', CClientScript::POS_END )->registerCoreScript ( 'jquery.ui', CClientScript::POS_END )->registerScriptFile ( $themePath . '/assets/js/bootstrap.min.js', CClientScript::POS_END )->registerScript ( 'tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();
        $('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY );
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/respond.min.js"></script>
<![endif]-->
<link rel="apple-touch-icon"
	href="<?php echo Yii::app()->theme->baseUrl ?>/assets/jpg/aple.png">
<link rel="icon"
	href="<?php echo Yii::app()->theme->baseUrl ?>/assets/jpg/zkmotors.ico">
</head>

<body role="document">

<?php
include ('topmenu.php');

?>
<div class="container-fluid" id="page">
<?php
$this->widget ( 'bootstrap.widgets.BsNavbar', array (
		
		'collapse' => true,
		'brandUrl' => Yii::app ()->getBaseUrl ( true ),
		'brandLabel' => Yii::app ()->params ['tytulstrony'],
		'items' => array (
				
				array (
						'class' => 'bootstrap.widgets.BsNav',
						'type' => 'navbar',
						'activateParents' => true,
						'items' => $items 
				) 
		),
		//'container' => true ,
		'position' => BsHtml::NAVBAR_POSITION_STATIC_TOP
) );
?>
</div>


<div class="container-fluid">

<?php if(isset($this->breadcrumbs)):?>
		<?php
	
	$this->widget ( 'bootstrap.widgets.BsBreadcrumb', array (
			'links' => $this->breadcrumbs 
	) );
	?>
	<?php endif?>
<?php
// przyklad: Yii::app ()->user->setFlash("1", array(BsHtml::ALERT_COLOR_SUCCESS, "Włączono dostęp przez WiFi"));
foreach ( Yii::app ()->user->getFlashes () as $key => $message ) {
	echo BsHtml::alert ( $message [0], $message [1] );
}
?>
	<?php echo $content; ?>
</div>

	<div class="footer">
		<div class="container bs-docs-footer">
			<div class="row">
				<div class="col-md-1 col-xs-12">
					<img src="<?php echo $themePath . Yii::app()->params['logo'];?>"
						alt="<?php echo Yii::app()->params['altlogo']; ?>"
						id="footer_logo_zk">
				</div>
				<div class="col-md-9 col-xs-12">
					<a href="https://plus.google.com/+MarcinMisiak/">System 2MCRM</a> (<?php echo Yii::app()->params['wersjaaplikacji']; ?>) Copyright &copy; <?php echo date('Y'); ?><small><br>
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						Autor: <a href="https://www.facebook.com/misiak2">Marcin Misiak</a></small>
				</div>
				<div class="col-md-2 col-xs-12">
					<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
					<a href="<?php echo Yii::app()->params['urlpomoc']; ?>"
						target="_blank">Pomoc</a>
				</div>
			</div>
		</div>
	</div>
	<img src="<?php echo $themePath."/assets/jpg/ajax-loader.gif"?>"
		id="loading-indicator" style="display: none" />
</body>
</html>
