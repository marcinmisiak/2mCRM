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
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Domains[] $domains
 * @property Osoba[] $osobas
 * @property Uslugi[] $uslugis
 */
class Klient extends CActiveRecord
{
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
			array('nazwa, status_id', 'required'),
			array('rozmowa_konczaca, status_id', 'numerical', 'integerOnly'=>true),
			array('nazwa, adrrej_adres', 'length', 'max'=>200),
			array('adrrej_kod', 'length', 'max'=>6),
			array('adrrej_miasto', 'length', 'max'=>50),
			array('adrrej_kraj', 'length', 'max'=>45),
			array('nip, regon, krs', 'length', 'max'=>20),
			array('www, email', 'length', 'max'=>250),
			array('notatka', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nazwa, adrrej_adres, adrrej_kod, adrrej_miasto, adrrej_kraj, nip, regon, krs, www, email, notatka, rozmowa_konczaca, status_id', 'safe', 'on'=>'search'),
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
			'domains' => array(self::MANY_MANY, 'Domains', 'klient_has_domains(klient_id, domains_id)'),
			'osobas' => array(self::MANY_MANY, 'Osoba', 'klient_has_osoba(klient_id, osoba_id)'),
			'uslugis' => array(self::MANY_MANY, 'Uslugi', 'klient_has_uslugi(klient_id, uslugi_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nazwa' => 'Nazwa',
			'adrrej_adres' => 'Adrrej Adres',
			'adrrej_kod' => 'Adrrej Kod',
			'adrrej_miasto' => 'Adrrej Miasto',
			'adrrej_kraj' => 'Adrrej Kraj',
			'nip' => 'Nip',
			'regon' => 'Regon',
			'krs' => 'Krs',
			'www' => 'Www',
			'email' => 'Email',
			'notatka' => 'Notatka',
			'rozmowa_konczaca' => 'Rozmowa Konczaca',
			'status_id' => 'Status',
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
		$criteria->compare('www',$this->www,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notatka',$this->notatka,true);
		$criteria->compare('rozmowa_konczaca',$this->rozmowa_konczaca);
		$criteria->compare('status_id',$this->status_id);

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
