<?php
defined ( 'YII_DEBUG' ) or define ( 'YII_DEBUG', true );
require_once (dirname ( __FILE__ ) . DIRECTORY_SEPARATOR. '..'.DIRECTORY_SEPARATOR."yii".DIRECTORY_SEPARATOR."framework".DIRECTORY_SEPARATOR.'yii.php');
$configFile = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR. 'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'cron.php';
Yii::createConsoleApplication ( $configFile )->run ();