<?php

/**
 * This is the model class for table "uzytkownik".
 *
 * The followings are the available columns in table 'uzytkownik':
 * @property integer $iduzytkownik
 * @property string $login
 * @property string $haslo
 * @property string $imie
 * @property string $nazwisko
 * @property string $telefon
 * @property string $email_pryw
 * @property string $email_sl
 * @property string $skype
 * @property string $opis
 * @property string $roles
 * @property integer $funkcja_idfunkcja
 *
 * The followings are the available model relations:
 * @property Funkcja $funkcjaIdfunkcja
 */
class Uzytkownik extends CActiveRecord
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uzytkownik';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login,  imie, nazwisko, funkcja_idfunkcja', 'required'),
			array('funkcja_idfunkcja', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>130),
			array('haslo', 'length', 'max'=>32),
			array('imie', 'length', 'max'=>24),
			array('nazwisko', 'length', 'max'=>30),
			array('telefon', 'length', 'max'=>11),
			array('email_pryw, email_sl, skype', 'length', 'max'=>145),
			array('roles', 'length', 'max'=>45),
			array('opis', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iduzytkownik, login, haslo, imie, nazwisko, telefon, email_pryw, email_sl, skype, opis, roles, funkcja_idfunkcja', 'safe', 'on'=>'search'),
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
			'funkcjaIdfunkcja' => array(self::BELONGS_TO, 'Funkcja', 'funkcja_idfunkcja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iduzytkownik' => 'Iduzytkownik',
			'login' => 'Login',
			'haslo' => 'Haslo',
			'imie' => 'Imie',
			'nazwisko' => 'Nazwisko',
			'telefon' => 'Telefon',
			'email_pryw' => 'Email Pryw',
			'email_sl' => 'Email Sl',
			'skype' => 'Skype',
			'opis' => 'Opis',
			'roles' => 'Roles',
			'funkcja_idfunkcja' => 'Funkcja Idfunkcja',
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

		$criteria->compare('iduzytkownik',$this->iduzytkownik);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('haslo',$this->haslo,true);
		$criteria->compare('imie',$this->imie,true);
		$criteria->compare('nazwisko',$this->nazwisko,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('email_pryw',$this->email_pryw,true);
		$criteria->compare('email_sl',$this->email_sl,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('roles',$this->roles,true);
		$criteria->compare('funkcja_idfunkcja',$this->funkcja_idfunkcja);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Uzytkownik the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
