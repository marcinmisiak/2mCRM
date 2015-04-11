<?php
/**
 * Buowanie pozycji menu
 * @author Marcin Misiak
 */
$items = array (
		array (
				'label' => 'Panel telemarketera',
				'icon' => BsHtml::GLYPHICON_COMMENT,
				'url'=>array('site/PanelTelemarketera'),
				'visible' => Yii::app ()->user->checkAccess ( array( 'telemarketer') ),
		),
		array (
				'label' => 'Panel koordynatora',
				'icon' => BsHtml::GLYPHICON_COMMENT,
				 'url'=>array('site/panelKoordynatora'),
				'visible' => Yii::app ()->user->checkAccess ( array( 'administrator','koordynator') ),
		),
		array (
				'label' => 'Klienci',
				'icon' => BsHtml::GLYPHICON_USER,
				'items' => array (
						array (
								'label' => 'Nowy',
								'url' => array (
										'/klient/create' 
								) 
						),
						array (
								'label' => 'Lista',
								'url' => array (
										'/klient/index' 
								) 
						),
						array (
								'label' => 'Zarządzaj',
								'url' => array (
										'/klient/admin' 
								),
								'visible' => Yii::app ()->user->checkAccess ( array( 'administrator','koordynator')  ) 
						),
					
				),
				
				'visible' => ! Yii::app ()->user->isGuest 
		),

		array (
				'label' => 'Raporty',
				'icon' => BsHtml::GLYPHICON_PRINT,
				// 'url'=>'',
				'visible' => Yii::app ()->user->checkAccess ( array( 'administrator','koordynator') ),
				'items' => array (
						array (
								'label' => 'raport 1',
								'url' => array (
										'/raporty/akcjapromocyjnaList' 
								) 
						),
					
				)
				,
				
		),
		array (
				'label' => 'Ustawienia',
				'icon' => BsHtml::GLYPHICON_COG,
				'url' => '#',
				'visible'=>Yii::app ()->user->checkAccess('administrator'),
				'items' => array (
						array (
								'label' => 'Konfiguracja',
								'url' => array (
										'konfiguracja/update/1'
								),
								'visible' => Yii::app ()->user->checkAccess ( 'administrator' ),
						),
						array (
								'label' => 'Typ usługi',
								'url' => array (
										'tuslugi/admin'
								) ,
						),
						array (
								'label' => 'Usługi',
								'url' => array (
										'uslugi/admin'
								) ,
						),
						array (
								'label' => 'Status kienta',
								'url' => array (
										'status/admin'
								) ,
						),
						
						array (
								'label' => 'Status kontaktu',
								'url' => array (
										'kontaktStatus/admin'
								) ,
						),
						array (
								'label' => 'Sposób kontaktu',
								'url' => array (
										'kontaktSposob/admin'
								) ,
						)
						,
						array (
								'label' => 'Funkcje użytkowników',
								'url' => array (
										'functions/admin' 
								) ,
								'visible'=>Yii::app ()->user->checkAccess('administrator'),
						),
						array (
								'label' => 'Użytkownicy',
								'url' => array (
										'users/admin' 
								),
								'visible' => Yii::app ()->user->checkAccess ( 'administrator' ),
						),
					
								
						
				)
				,
				
		),
		
		array (
				'label' => 'Zaloguj',
				'url' => array (
						'/site/login' 
				),
				'visible' => Yii::app ()->user->isGuest 
		),
		array (
				'label' => 'Zalogowany: ' . Yii::app ()->user->name . '',
				'url' => array (
						'/site/logout' 
				),
				'items' => array (
						array (
								'label' => 'Wyloguj',
								'url' => array (
										'/site/logout' 
								) 
						),
						array (
								'label' => 'Konto',
								'url' => array (
										'/site/viewkonto' 
								) 
						) 
				)
				,
				'visible' => ! Yii::app ()->user->isGuest 
		) 
);