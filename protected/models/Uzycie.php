<?php

/**
 * This is the model class for table "uzycie".
 *
 * The followings are the available columns in table 'uzycie':
 * @property integer $id
 * @property string $od
 * @property string $do
 * @property integer $przydzielenie_id
 * @property integer $status_id
 * @property string $users_id
 *
 * The followings are the available model relations:
 * @property Przydzielenie $przydzielenie
 * @property Status $status
 * @property Users $users
 */
class Uzycie extends CActiveRecord
{
	public $wykonano;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uzycie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('od, do, przydzielenie_id, status_id, users_id', 'required'),
			array('przydzielenie_id, status_id, wykonano', 'numerical', 'integerOnly'=>true),
			array('users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, od, do, przydzielenie_id, status_id, users_id, wykonano', 'safe', 'on'=>'search'),
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
			'przydzielenie' => array(self::BELONGS_TO, 'Przydzielenie', 'przydzielenie_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
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
			'od' => 'Od',
			'do' => 'Do',
			'przydzielenie_id' => 'Przydzielenie',
			'status_id' => 'Status',
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
		// $criteria->together=true;
		 $criteria->with=array('przydzielenie' );
		$criteria->compare('id',$this->id);
		$criteria->compare('od',$this->od,true);
		$criteria->compare('do',$this->do,true);
		$criteria->compare('przydzielenie_id',$this->przydzielenie_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('t.users_id',$this->users_id);
		
		$criteria->compare('przydzielenie.wykonano',$this->wykonano);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Uzycie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getOsoby() {
		$przydzielenie = Przydzielenie::model()->findByPk($this->przydzielenie_id);
		$klientHD = KlientHasDomains::model()->find("domains_id=:domains_id", array(':domains_id'=>"$przydzielenie->domains_id"));
		$klient = Klient::model()->findByPk($klientHD->klient_id);
		// var_dump($klient);exit;
		$osoby = Osoba::model()->findAll('klient_id=:klient_id and aktywny=1', array(':klient_id'=>$klient->id));
		foreach ($osoby as $o) {
			echo $o->imie ." ".$o->nazwisko . "<br>" . $o->telefon."<P>";
		}
	}
	
	public function getZaineteresowany() {
		
		$przydzielenie = Przydzielenie::model()->findByPk($this->przydzielenie_id);
		$klientHD = KlientHasDomains::model()->find("domains_id=:domains_id", array(':domains_id'=>"$przydzielenie->domains_id"));
		$klient = Klient::model()->findByPk( $klientHD->klient_id);
		
		foreach ($klient->uslugisZaint as $z) {
			echo  $z->nazwa ."<br>";
		}
		
	}
	
	public function getCzasoddo(){
		$od = new DateTime($this->od);
		$do = new DateTime($this->do);
		$czas_otwartego_zgloszenia = $od->diff($do);
		return $czas_otwartego_zgloszenia->format('%H:%I:%S');
	}
	
	public function getCzasodPrzydzielenia(){
		$do = new DateTime($this->do);
		$kiedy_przydzielono = new DateTime($this->przydzielenie->kiedy);
		$czas_odprzydzialenia = $kiedy_przydzielono->diff($do);
		return $czas_odprzydzialenia->format('%H:%I:%S');
	}
}
