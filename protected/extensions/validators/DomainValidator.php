<?php
///////////////////////////////////////////////////////////
///////////////////////// By Mohamed Alsemany
///////////////////////// PHP-CODES.COM
///////////////////////// YII Domain Validation Extension 
///////////////////////////////////////////////////////////

class DomainValidator extends CValidator
{
public $type;

	protected function validateAttribute($object,$attribute){
		
		 $value=$object->$attribute;
		 $val =1; //jesli puste to domyslnie jet ok
		 if (!empty($value)) {
		 $val = checkdnsrr ("$value" , $this->type );
		 }
		if ($val != 1)
		{
		$message = (null !== $this->message) ? $this->message : Yii::t('yii', '{attribute} is not a valid Domain.');
		$this->addError($object, $attribute, $message);
		}
	}
	


 
 }