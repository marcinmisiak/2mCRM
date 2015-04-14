<?php
return array (
		// This path may be different. You can probably get it from `config/main.php`.
		'basePath' => dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
		'name' => 'Automat 2mCRM',
		'language' => 'pl',
		'preload' => array (
				'log' 
		),
		
		'import' => array (
				'application.components.*',
				'application.models.*',
				'ext.YiiMailer.YiiMailer' 
		),
		// We'll log cron messages to the separate files
		'components' => array (
				'log' => array (
						'class' => 'CLogRouter',
						'routes' => array (
								array (
										'class' => 'CFileLogRoute',
										'logFile' => 'cron.log',
										'levels' => 'error, warning' 
								),
								array (
										'class' => 'CFileLogRoute',
										'logFile' => 'cron_trace.log',
										'levels' => 'trace' 
								) 
						) 
				),
				
				// Your DB connection
			'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mjkr',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging'  => true, 
		),
				'mail' => array (),
				'format' => array (
						'numberFormat' => array (
								'decimals' => 3,
								'decimalSeparator' => ',',
								'thousandSeparator' => '-' 
						) 
				) 
		)
		,
		'params' => array (
				'adminEmail' => 'marcin@wseip.edu.pl', // email wysyslny from
				// this is used in contact page
			//	'adminEmail'=>'maciej.krawczyk@mjkr.pl',
				'meta_description' => 'tu wpisz opis strony',
				'meta_keywords' =>'slowa, kluczowe, z przecinakami',
					
				'roles'=>array('administrator'=>'administrator','koordynator'=>'koordynator', 'redaktor'=>'redaktor', 'telemarketer'=> 'telemarketer'),
				'tytulstrony' => '2M CRM'
		)
		 
);