<?php

/**
 * This is the model class for table "domains".
 *
 * The followings are the available columns in table 'domains':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $expiry_date
 * @property string $registrar
 * @property string $added_date
 * @property string $client
 * @property string $phone
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Klient[] $klients
 */
class Domains extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domains';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, expiry_date, registrar, added_date, client, phone, email', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('name, registrar, client, phone, email', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, expiry_date, registrar, added_date, client, phone, email', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'klients' => array(self::MANY_MANY, 'Klient', 'klient_has_domains(domains_id, klient_id)'),
			'not_in_hasDomains'=>array(self::HAS_MANY,'KlientHasDomains', 'domains_id', 'condition'=>'not_in_hasDomains.domains_id is null' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'expiry_date' => 'Expiry Date',
			'registrar' => 'Registrar',
			'added_date' => 'Added Date',
			'client' => 'Client',
			'phone' => 'Phone',
			'email' => 'Email',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('registrar',$this->registrar,true);
		$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('client',$this->client,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * szukanie dla palelu telemarketera
	 * @return CActiveDataProvider
	 */
	public function searchPanel()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->order="expiry_date ASC";
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('registrar',$this->registrar,true);
		$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('client',$this->client,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	/**
	 * szukaj nie powiazanych z klientami
	 * @return CActiveDataProvider
	 */
	public function searchWolne()
	{
		$criteria= new CDbCriteria;
		$criteria->addNotInCondition('id', $this->id);
		$klienthasdomais = KlientHasDomains::model()->findAll($criteria);
		$domeny_zajente = array();
		foreach ($klienthasdomais as $khd){
			array_push($domeny_zajente, $khd['domains_id']);
		}
	
		$criteria=new CDbCriteria;
		//$criteria->with = array('not_in_hasDomains');
		//$criteria->addNotInCondition('kl', $values)
	
		$criteria->addNotInCondition('id',$domeny_zajente);
		//$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name);
		//$criteria->compare('expiry_date',$this->expiry_date,true);
		//$criteria->compare('registrar',$this->registrar,true);
		//$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('client',$this->client,true);
		//$criteria->compare('phone',$this->phone,true);
	//	$criteria->compare('email',$this->email,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Domains the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getButtons() {
		
		//$but=  CHtml::link(BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT), Yii::app()->createAbsoluteUrl('klient/createAddDomain/'.$this->id), 
		//		array('method'=>'POST', 'data'=>array('idaaa'=>$this->id), 'update'=>'#domeny_obecne'));
		//return $but;
		
		return BsHtml::ajaxButton(
				BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT),
				Yii::app()->createUrl('klient/createAddDomain/', array('id'=>$this->id)),
				array('method'=>'POST', 'data'=>array('idaaa'=>$this->name), 'update'=>'#domeny_obecne'),
				array('color' => BsHtml::BUTTON_COLOR_INFO, 'size' => BsHtml::BUTTON_SIZE_SMALL,)
				);
		
	return	CHtml::link(BsHtml::icon(BsHtml::GLYPHICON_ARROW_LEFT), Yii::app()->createUrl('klient/createAddDomain/', array('id'=>$this->id)));
	}
}
