<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>





<div class="form">
<?php

$form = $this->beginWidget ( 'bootstrap.widgets.BsActiveForm', array (
		'id' => 'login-form',
		'enableClientValidation' => true,
		'clientOptions' => array (
				'validateOnSubmit' => true 
		),
		'htmlOptions' => array (
				'class' => 'bs-example' 
		) 
) );
?>
<fieldset>
		<legend>Logowanie</legend>
<?php
echo $form->textFieldControlGroup ( $model, 'username' );
echo $form->passwordFieldControlGroup ( $model, 'password' );
echo $form->checkBoxControlGroup ( $model, 'rememberMe', array (
		'Zapamiętaj mnie' 
) );
echo BsHtml::submitButton ( 'Zaloguj', array (
		'color' => BsHtml::BUTTON_COLOR_PRIMARY 
) );
?>
</fieldset>

<?php $this->endWidget(); ?>
</div>
<!-- form -->
