<?php
$this->pageTitle = Yii::app ()->name . ' - Konto';
echo "<h1>Role</h1>";
$this->widget ( 'zii.widgets.grid.CGridView', array (
		'dataProvider' => $role 
)
 );
echo "<h1>Dane pracownika</h1>";

$this->widget ( 'bootstrap.widgets.BsGridView', array (
		'dataProvider' => $pracownik->search (),
		'columns' => array (
				'nazwisko',
				'login',
				'telefon',
				'email' 
		) 
)
 );