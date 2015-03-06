<?php

/**
 * This is the model class for table "kontakt_historia".
 *
 * The followings are the available columns in table 'kontakt_historia':
 * @property integer $id
 * @property string $dataczas
 * @property string $opis
 * @property string $dalsze_dzialanie
 * @property integer $kontakt_sposob_id
 * @property integer $kontakt_status_id
 * @property integer $osoba_id
 *
 * The followings are the available model relations:
 * @property KontaktSposob $kontaktSposob
 * @property KontaktStatus $kontaktStatus
 * @property Osoba $osoba
 */
class KontaktHistoria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kontakt_historia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dataczas, kontakt_sposob_id, kontakt_status_id, osoba_id', 'required'),
			array('kontakt_sposob_id, kontakt_status_id, osoba_id', 'numerical', 'integerOnly'=>true),
			array('dalsze_dzialanie', 'length', 'max'=>100),
			array('opis', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dataczas, opis, dalsze_dzialanie, kontakt_sposob_id, kontakt_status_id, osoba_id', 'safe', 'on'=>'search'),
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
			'kontaktSposob' => array(self::BELONGS_TO, 'KontaktSposob', 'kontakt_sposob_id'),
			'kontaktStatus' => array(self::BELONGS_TO, 'KontaktStatus', 'kontakt_status_id'),
			'osoba' => array(self::BELONGS_TO, 'Osoba', 'osoba_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dataczas' => 'Dataczas',
			'opis' => 'Opis',
			'dalsze_dzialanie' => 'Dalsze Dzialanie',
			'kontakt_sposob_id' => 'Kontakt Sposob',
			'kontakt_status_id' => 'Kontakt Status',
			'osoba_id' => 'Osoba',
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
		$criteria->compare('dataczas',$this->dataczas,true);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('dalsze_dzialanie',$this->dalsze_dzialanie,true);
		$criteria->compare('kontakt_sposob_id',$this->kontakt_sposob_id);
		$criteria->compare('kontakt_status_id',$this->kontakt_status_id);
		$criteria->compare('osoba_id',$this->osoba_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KontaktHistoria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
