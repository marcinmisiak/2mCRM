<?php

/**
 * This is the model class for table "konfiguracja".
 *
 * The followings are the available columns in table 'konfiguracja':
 * @property integer $id
 * @property string $wolne_dni_tygodnia
 * @property string $wolne_dni_daty
 */
class Konfiguracja extends CActiveRecord
{
	public $dni_tygodnia = array( 'Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota' );
	public $data_wolne_dni;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'konfiguracja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('automat_kiedy, automat_expiry, wolne_dni_tygodnia, wolne_dni_daty', 'required'),
			array('wolne_dni_tygodnia, wolne_dni_daty', 'safe'),
			array('automat_kiedy, automat_expiry','length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, wolne_dni_tygodnia, wolne_dni_daty', 'safe', 'on'=>'search'),
			array('automat_email_do_admina', 'numerical', 'integerOnly'=>true),
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
			'id' => 'ID',
			'wolne_dni_tygodnia' => 'Wolne Dni Tygodnia',
			'wolne_dni_daty' => 'Wolne Dni Daty',
			'automat_kiedy' =>'Na kiedy przydzielamy klienta (+1 day)',
			'automat_expiry' =>'Za ile domena wygasa (+9 days)',
			'automat_email_do_admina' => 'Wysyłaj email z podsumowaniem automatu przydzielania klientow',
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
		$criteria->compare('wolne_dni_tygodnia',$this->wolne_dni_tygodnia,true);
		$criteria->compare('wolne_dni_daty',$this->wolne_dni_daty,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Konfiguracja the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getDniTygodnia() {
		foreach ($this->dni_tygodnia as $d){
			echo "<input type=$d";
		}
	}
}
