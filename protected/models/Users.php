<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $logins
 * @property integer $last_login
 * @property string $imie
 * @property string $nazwisko
 * @property string $telefon
 * @property string $email_pryw
 * @property string $skype
 * @property string $opis
 * @property string $roles
 * @property integer $functions_id
 *
 * The followings are the available model relations:
 * @property Domains[] $domains
 * @property Roles[] $roles0
 * @property UserTokens[] $userTokens
 * @property Functions $functions
 */
class Users extends CActiveRecord
{
	public $maRole; //pokaz z niepusta roles
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
			array('last_login, functions_id', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>254),
			array('username', 'length', 'max'=>32),
			array('password', 'length', 'max'=>64),
			array('logins', 'length', 'max'=>10),
			array('imie, roles', 'length', 'max'=>20),
			array('nazwisko', 'length', 'max'=>30),
			array('telefon', 'length', 'max'=>11),
			array('email_pryw', 'length', 'max'=>250),
			array('skype', 'length', 'max'=>200),
			array('opis', 'safe'),
			array('email, email_pryw','email'),
			array('password','required', 'on'=>'newuser'),
			
			array('email', 'unique','message'=>'Email już istnieje!'),
				
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('maRole ,id, email, username, password, logins, last_login, imie, nazwisko, telefon, email_pryw, skype, opis, roles, functions_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'domains' => array(self::HAS_MANY, 'Domains', 'user_id'),
			'roles0' => array(self::MANY_MANY, 'Roles', 'roles_users(user_id, role_id)'),
			'userTokens' => array(self::HAS_MANY, 'UserTokens', 'user_id'),
			'functions' => array(self::BELONGS_TO, 'Functions', 'functions_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			'logins' => 'Logins',
			'last_login' => 'Last Login',
			'imie' => 'Imie',
			'nazwisko' => 'Nazwisko',
			'telefon' => 'Telefon',
			'email_pryw' => 'Email Pryw',
			'skype' => 'Skype',
			'opis' => 'Opis',
			'roles' => 'Rola',
			'functions_id' => 'Functions',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('logins',$this->logins,true);
		$criteria->compare('last_login',$this->last_login);
		$criteria->compare('imie',$this->imie,true);
		$criteria->compare('nazwisko',$this->nazwisko,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('email_pryw',$this->email_pryw,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('roles',$this->roles,true);
		$criteria->compare('functions_id',$this->functions_id);
		
		if($this->maRole) {
		$criteria->addCondition('roles is not null');
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * zraca imie nazwoko login email do listy dropdown
	 */
	public function getLabel() {
		return $this->imie ." ".$this->nazwisko . " " .$this->email ." ".$this->username;
	}
	
	/**
	 * przyski panelu koordynatora
	 * @return string
	 */
	public function getButtonK() {
// 	return	BsHtml::ajaxLink(
// 		BsHtml::icon(BsHtml::GLYPHICON_CERTIFICATE),
// 		Yii::app()->controller->createUrl('users/viewKlient/'.$this->id),
// 		array(
// 		'method'=>'POST',
// 		'update'=>'#div_pracownik',
// 		'beforeSend'=>'function() { 
// 				$("#div_pracownik").html("Ładuje..");
// 				 $("#Przydzielenie_users_id").val('.$this->id.'); 
// 				 }'
// 				)
// 				);
	
	return 	 BsHtml::link(BsHtml::icon(BsHtml::GLYPHICON_ADJUST), Yii::app()->controller->createUrl('site/panelKoordynatora/', array('user_id'=>$this->id)));
		 
		 
	
	}
}
