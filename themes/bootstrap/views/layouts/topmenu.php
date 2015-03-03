<?php
/**
 * Buowanie pozycji menu
 * @author Marcin Misiak
 */
$items = array (
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
								'visible' => Yii::app ()->user->checkAccess ( 'administrator' ) 
						),
					
				),
				
				'visible' => ! Yii::app ()->user->isGuest 
		),

		array (
				'label' => 'Raporty',
				'icon' => BsHtml::GLYPHICON_PRINT,
				// 'url'=>'',
				'items' => array (
						array (
								'label' => 'raport 1',
								'url' => array (
										'/raporty/akcjapromocyjnaList' 
								) 
						),
					
				)
				,
				
				'visible' => ! Yii::app ()->user->isGuest 
		),
		array (
				'label' => 'Ustawienia',
				'icon' => BsHtml::GLYPHICON_COG,
				'url' => '#',
				
				'items' => array (
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
				
				'visible' => ! Yii::app ()->user->isGuest 
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