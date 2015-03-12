<?php

/**
 * This is the model class for table "klient".
 *
 * The followings are the available columns in table 'klient':
 * @property integer $id
 * @property string $nazwa
 * @property string $adrrej_adres
 * @property string $adrrej_kod
 * @property string $adrrej_miasto
 * @property string $adrrej_kraj
 * @property string $nip
 * @property string $regon
 * @property string $krs
 * @property string $www
 * @property string $email
 * @property string $notatka
 * @property integer $rozmowa_konczaca
 * @property integer $status_id
 * @property string $users_id
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Users $users
 * @property Domains[] $domains
 * @property Osoba[] $osobas
 * @property Uslugi[] $uslugis
 */
class Klient extends CActiveRecord
{
	
	const DNS_A = 'A'; // this will check for the domain Dns A record
	const DNS_MX = 'MX'; // This will check for MX Records
	const DNS_NS = 'NS'; // This will check for the NS Records
	public $bez_telefonu;
	public $przydzielanie_kiedy; //do from telemnarketera
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'klient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nazwa, status_id, users_id', 'required'),
			array('rozmowa_konczaca, status_id', 'numerical', 'integerOnly'=>true),
			array('nazwa, adrrej_adres', 'length', 'max'=>200),
			array('adrrej_kod', 'length', 'max'=>6),
			array('adrrej_miasto', 'length', 'max'=>50),
			array('adrrej_kraj', 'length', 'max'=>45),
			array('nip, regon, krs', 'length', 'max'=>20),
				array('telefon, users_id', 'length', 'max'=>12),
			array('www, email', 'length', 'max'=>250),
			array('users_id', 'length', 'max'=>11),
			array('notatka, uslugisZaint', 'safe'),
				array('email','email'),
				array('www','ext.validators.DomainValidator', 'type'=>self::DNS_A),
				array('przydzielanie_kiedy', 'required','on'=>'niezamnkienty'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bez_telefonu, id, nazwa, adrrej_adres, adrrej_kod, adrrej_miasto, adrrej_kraj, nip, regon, krs, www, email, notatka, rozmowa_konczaca, status_id, users_id', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
			'domains' => array(self::MANY_MANY, 'Domains', 'klient_has_domains(klient_id, domains_id)'),
			'klientHasUslugis' => array(self::HAS_MANY, 'KlientHasUslugi', 'klient_id'),
			// 'osobas' => array(self::HAS_MANY, 'Osoba', 'klient_id'),
			 'uslugis' => array(self::MANY_MANY, 'Uslugi', 'klient_has_uslugi(klient_id, uslugi_id)'),
			'KlientHasDomains' => array(self::HAS_MANY, 'KlientHasDomains', 'klient_id'),
			'uslugisZaint' => array(self::MANY_MANY, 'Uslugi', 'klient_zainteresowany_uslugi(klient_id, uslugi_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nazwa' => 'Pełna nazwa',
			'adrrej_adres' => 'Adres rejestracji - ULICA, nr',
			'adrrej_kod' => 'Adres rejestracji KOD',
			'adrrej_miasto' => 'Adres rejestracji MIASTO',
			'adrrej_kraj' => 'Adres rejestracji KRAJ',
			'nip' => 'NIP',
			'regon' => 'Regon',
			'krs' => 'KRS',
			'www' => 'www',
			'email' => 'e-mail',
			'notatka' => 'Notatka',
			'rozmowa_konczaca' => 'Rozmowa kończaca',
			'status_id' => 'Status',
			'users_id' => 'Opiekun klienta',
				
				'telefon' => 'Telefon',
				'bez_telefonu'=>'Klient bez telefonu',
				'uslugisZaint'=>'Zainteresowany - inne usługi',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nazwa',$this->nazwa,true);
		$criteria->compare('adrrej_adres',$this->adrrej_adres,true);
		$criteria->compare('adrrej_kod',$this->adrrej_kod,true);
		$criteria->compare('adrrej_miasto',$this->adrrej_miasto,true);
		$criteria->compare('adrrej_kraj',$this->adrrej_kraj,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('regon',$this->regon,true);
		$criteria->compare('krs',$this->krs,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('www',$this->www,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notatka',$this->notatka,true);
		$criteria->compare('rozmowa_konczaca',$this->rozmowa_konczaca);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('users_id',$this->users_id,true);
		
		if( $this->bez_telefonu == 1) {
			$criteria->addCondition("telefon = '' or telefon is null");
			//$criteria->addCondition("telefon is null");
			//$criteria->addCondition('telefon IS NULL', 'OR');
			
		//	var_dump($criteria);exit;
			//$criteria->compare('telefon', '');
			//$criteria->compare('telefon', ' is null');
			//var_dump($criteria);exit;
		} 
		if ($this->bez_telefonu == 2){
			$criteria->addCondition("telefon != ''");
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * pokaz klientow bez domen 
	 * @return CActiveDataProvider
	 */
	public function searchBezDanych()
	{
	
		$criteria=new CDbCriteria;
	//$criteria->with=array('domains');
		//$criteria->addCondition('domains_domains.domains_id is null');
	//$this->domains
		$criteria->compare('id',$this->id);
		$criteria->compare('nazwa',$this->nazwa,true);
		$criteria->compare('adrrej_adres',$this->adrrej_adres,true);
		$criteria->compare('adrrej_kod',$this->adrrej_kod,true);
		$criteria->compare('adrrej_miasto',$this->adrrej_miasto,true);
		$criteria->compare('adrrej_kraj',$this->adrrej_kraj,true);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('regon',$this->regon,true);
		$criteria->compare('krs',$this->krs,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('www',$this->www,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notatka',$this->notatka,true);
		$criteria->compare('rozmowa_konczaca',$this->rozmowa_konczaca);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('users_id',$this->users_id,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Klient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
