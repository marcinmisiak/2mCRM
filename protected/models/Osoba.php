<?php

/**
 * This is the model class for table "osoba".
 *
 * The followings are the available columns in table 'osoba':
 * @property integer $id
 * @property string $imie
 * @property string $nazwisko
 * @property string $telefon
 * @property string $telefon_kom
 * @property string $email
 * @property string $email_pryw
 * @property string $email_sl
 * @property integer $aktywny
 *
 * The followings are the available model relations:
 * @property Klient[] $klients
 * @property KontaktHistoria[] $kontaktHistorias
 */
class Osoba extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'osoba';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aktywny', 'numerical', 'integerOnly'=>true),
			array('imie', 'length', 'max'=>24),
			array('nazwisko', 'length', 'max'=>30),
			array('telefon, telefon_kom', 'length', 'max'=>15),
			array('email, email_pryw, email_sl', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, imie, nazwisko, telefon, telefon_kom, email, email_pryw, email_sl, aktywny', 'safe', 'on'=>'search'),
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
			'klients' => array(self::MANY_MANY, 'Klient', 'klient_has_osoba(osoba_id, klient_id)'),
			'kontaktHistorias' => array(self::HAS_MANY, 'KontaktHistoria', 'osoba_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'imie' => 'Imie',
			'nazwisko' => 'Nazwisko',
			'telefon' => 'Telefon',
			'telefon_kom' => 'Telefon Kom',
			'email' => 'Email',
			'email_pryw' => 'Email Pryw',
			'email_sl' => 'Email Sl',
			'aktywny' => 'Aktywny',
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
		$criteria->compare('imie',$this->imie,true);
		$criteria->compare('nazwisko',$this->nazwisko,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('telefon_kom',$this->telefon_kom,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_pryw',$this->email_pryw,true);
		$criteria->compare('email_sl',$this->email_sl,true);
		$criteria->compare('aktywny',$this->aktywny);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Osoba the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
