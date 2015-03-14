<?php

/**
 * This is the model class for table "przydzielenie".
 *
 * The followings are the available columns in table 'przydzielenie':
 * @property integer $id
 * @property string $kiedy
 * @property integer $wykonano
 * @property string $domains_id
 * @property string $users_id
 *
 * The followings are the available model relations:
 * @property Domains $domains
 * @property Users $users
 */
class Przydzielenie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'przydzielenie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domains_id, users_id', 'required'),
			array('wykonano', 'numerical', 'integerOnly'=>true),
			array('domains_id', 'length', 'max'=>10),
			array('users_id', 'length', 'max'=>11),
			//array('kiedy', 'safe'),
			array('kiedy', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kiedy, wykonano, domains_id, users_id', 'safe', 'on'=>'search'),
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
			'domains' => array(self::BELONGS_TO, 'Domains', 'domains_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kiedy' => 'Kiedy',
			'wykonano' => 'Wykonano',
			'domains_id' => 'Domains',
			'users_id' => 'Users',
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
		//$criteria->with=array('domains');
		//$criteria->together=true;
		$criteria->compare('id',$this->id);
		$criteria->compare('kiedy',$this->kiedy,true);
		$criteria->compare('wykonano',$this->wykonano,true);
		$criteria->compare('domains_id',$this->domains_id);
		$criteria->compare('users_id',$this->users_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 
				'sort'=>array(
						'defaultOrder'=>array(
								'kiedy'=>false,
								//'domains.expiry_date'=>false
						)
				),
				'pagination'=>array(
						'pageSize'=>5,
				),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Przydzielenie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
}
