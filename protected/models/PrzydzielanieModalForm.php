<?php
class PrzydzielanieModalForm extends CFormModel
{
	public $id; //users_id id uzytkownika ktorem przydzielamy
	public $expiry_date; //data końca domeny
	public $kiedy; //na kiedy przydzielić

	public function rules()
	{
		return array(
			array('expiry_date, kiedy, id', 'required'),
			array('expiry_date, kiedy', 'type', 'type' => 'date', 'message' => '{attribute}: nie jest poprawinie wprowadzoną datą!', 'dateFormat' => 'yyyy-MM-dd'),
			array('kiedy', 'valid_kiedy'),
		
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'expiry_date'=>'Data wygaśniecia domeny klienta',
				'kiedy'=>'Przydziel na'
		);
	}
	
	/**
	 * czy data to nie wolny dzień
	 * @param unknown $attribute
	 * @param unknown $params
	 */
	public function valid_kiedy(){
		$data = $this->kiedy;
		$konf = Konfiguracja::model()->findByPk(1); 
		
		$wolne_dni_tygodnia = unserialize($konf->wolne_dni_tygodnia);
		if (!empty($wolne_dni_tygodnia)) {
		foreach ($wolne_dni_tygodnia as $wdt) {
			if($wdt == date('w',strtotime($data))) {
				$this->addError('kiedy', 'Data: <b>'. Yii::app()->dateFormatter->format('yyyy-MM-dd EEEE', strtotime( $data) ) . '</b> jest dniem wolnym');
			}
		}
		}
		
		$wolne_dni_daty = explode("," ,$konf->wolne_dni_daty);
			if (!empty($wolne_dni_daty)) {
				foreach ($wolne_dni_daty as $wdt) {
					if($wdt == $data) {
						$this->addError('kiedy', 'Data: <b>'. Yii::app()->dateFormatter->format('yyyy-MM-dd', strtotime( $data) ) . '</b> jest datą wolnego dnia');
					}
				}
			}
		
	}

}
