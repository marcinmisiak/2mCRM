<?php

/**
 * This is the model class for table "klient_has_uslugi".
 *
 * The followings are the available columns in table 'klient_has_uslugi':
 * @property integer $klient_id
 * @property integer $uslugi_id
 * @property string $data_od
 * @property string $data_do
 * @property string $kwota
 * @property integer $zaplacone
 */
class KlientHasUslugi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'klient_has_uslugi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('klient_id, uslugi_id', 'required'),
			array('klient_id, uslugi_id, zaplacone', 'numerical', 'integerOnly'=>true),
			array('kwota', 'length', 'max'=>10),
			array('data_od, data_do', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('klient_id, uslugi_id, data_od, data_do, kwota, zaplacone', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'klient_id' => 'Klient',
			'uslugi_id' => 'Uslugi',
			'data_od' => 'Data Od',
			'data_do' => 'Data Do',
			'kwota' => 'Kwota',
			'zaplacone' => 'Zaplacone',
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

		$criteria->compare('klient_id',$this->klient_id);
		$criteria->compare('uslugi_id',$this->uslugi_id);
		$criteria->compare('data_od',$this->data_od,true);
		$criteria->compare('data_do',$this->data_do,true);
		$criteria->compare('kwota',$this->kwota,true);
		$criteria->compare('zaplacone',$this->zaplacone);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KlientHasUslugi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
