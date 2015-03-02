<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;
	public function authenticate()
	{
		$record=Uzytkownik::model()->findByAttributes(array('login'=>$this->username) );
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->haslo!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->id=$record->iduzytkownik;
			$this->setState('roles', $record->roles);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId(){
		return $this->id;
	}
}