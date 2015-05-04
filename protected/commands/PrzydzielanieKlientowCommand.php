<?php
/**
 * 
 * C:\xampp\htdocs\2mCRM\protected>C:\xampp\php\php.exe c:\xampp\htdocs\2mCRM\cron.php przydzielanieklientow automat 
* utworzenie WSZYSTKICH klientow z nieprzydzielonych domen
 * przydzielanieklientow utworzKlientow

 * @author marcin
 *
 */
class PrzydzielanieKlientowCommand extends CConsoleCommand 
{
	public $kiedy;
	public $expiry;
	/**
	 * przydziala klientow na podstawie konfikuracja
	 */
	public function actionAutomat() {
		$konf  = Konfiguracja::model()->findByPk(1);
		
		$this->kiedy = date ('Y-m-d', strtotime($konf->automat_kiedy)) ;
		$this->expiry = date ('Y-m-d',strtotime($konf->automat_expiry));
		
		$this->ustawKiedy();
		
		$users = Users::model ()->findAllByAttributes(array('automat_domen'=>1));
		
		$mail = new YiiMailer ();
		$mail->setFrom ( Yii::app ()->params ['adminEmail'], Yii::app ()->params ['tytulstrony'] );
		
		$txt_admin = "Liczba pracownikow do przydzialania autoamtycznego: ". count($users) ."\n";
		$txt_admin.= "Przydzielamy na (kiedy): ". $this->kiedy ."\n";
	
		$txt_admin.= "Data wygasniecia domany klienta: ". $this->expiry ."\n";
		echo $txt_admin;
		$txt = "";
		foreach ($users as $u) {
			
			$cmd = Yii::app ()->db->createCommand ();
			$cmd->select = "domains.id, domains.name";
			$cmd->from = "domains";
			$cmd->leftJoin ( 'przydzielenie', 'domains.id=przydzielenie.domains_id' );
			$cmd->join ( "klient_has_domains", 'domains.id = klient_has_domains.domains_id' );
			if (! empty ( $u->ilosc_domen )) {
				$cmd->limit ( $u->ilosc_domen );
			} else {
				$cmd->limit (100); //100 najwiecej?
			}
			$cmd->where ( "przydzielenie.domains_id is null and expiry_date = :expiry_date", array (
					":expiry_date" =>  $this->expiry
			) );
			$domeny = $cmd->queryAll ();
			
			$przydzielenie_muliti = array ();
			foreach ( $domeny as $d ) {
				$przydzielenie_muliti [] = array (
						'kiedy' =>$this->kiedy,
						'domains_id' => $d ['id'],
						'users_id' => $u->id
				);
			}
			if (!empty($przydzielenie_muliti)) {
				$builder = Yii::app ()->db->schema->commandBuilder;
				$command = $builder->createMultipleInsertCommand ( 'przydzielenie', $przydzielenie_muliti );
				$liczba_przydzielonych = $command->execute ();
				if ($liczba_przydzielonych) {
					$txt.=  "Przydzielono " . $liczba_przydzielonych . " domen do kolejki: ". $u->imie . " " . $u->nazwisko ." ". $u->email .", na: " . $this->kiedy ."\n";
				} else {
					$txt.=  "BŁAD: Nie przydzialono klientów \n" ;
				}
			} else {
				$txt.=  "Brak domen do przydzielenia (liczba domen: 0) \n" ;
			}
			
			echo $txt;
			
			$mail->setTo ( $u->email );
			$mail->setSubject ( 'Przydzielenia automatyczne z dnia: '. date('Y-m-d') );
			$mail->setBody (nl2br($txt) );
			if ($mail->send ()) {
				echo "email wyslany poprawnie do: ". $u->email;
			} else {
				echo 'Error while sending email: ' . $mail->getError ();
			}
			echo PHP_EOL;
			
			$txt_admin.=$txt;
			$txt="";
		}
		
		if ($konf->automat_email_do_admina) {
			$mail->setTo (Yii::app()->params['adminEmail'] );
			$mail->setSubject ( 'Przydzielenia automatyczne z dnia: '. date('Y-m-d') );
			$mail->setBody (nl2br($txt_admin));
			$mail->send ();
		}
		
		
	}
	
	private function ustawKiedy() {
		$model = new PrzydzielanieModalForm();
		$model->id=1; //valid
		$model->expiry_date = $this->expiry;
		$model->kiedy = $this->kiedy;
		if(! $model->validate()) {
				$this->kiedy = date('Y-m-d', strtotime( $model->kiedy. " +1 day"));
				echo "Wolny dzień wyznaczam nową datę: ". $this->kiedy ."\n";
				
				$this->ustawKiedy();
		} 
		return true;
	}
	
	public function actionUtworzKlientow() {

	$user = Users::model()->find("roles='administrator'");
	$domains = new Domains('searchBezKlienta');
	$domains->unsetAttributes();
	$date_od = strtotime("-1 day");
	$domains->expiry_date_od = date('Y-m-d', $date_od);
	$date_do = strtotime("+12 month"); //+100 years nie dziala???
	$domains->expiry_date_do = date('Y-m-d', $date_do);
	$doprzydzielenia = $domains->searchBezKlienow();
	$doprzydzielenia->pagination=false;
	$d = $doprzydzielenia->getData() ;
	echo "Liczba domen bez klientów domen: " . count ($d) . "\n";
	foreach ( $d as $domain ) {
	    echo "\n Tworze klienta: " .$domain->client; 
	    $klient = new Klient();
	    $klient->nazwa = $domain->client; 
	    $klient->telefon = $domain->phone;
	    $klient->email = $domain->email;
	    $klient->status_id = 2;
	     $klient->users_id = $user->id;
	    
	    $klient_id = $klient->save();
	    
	    if ($klient_id) {
		$klientHasDomains = new KlientHasDomains();
		$klientHasDomains->klient_id = $klient->id;
		$klientHasDomains->domains_id = $domain->id;
		$kd = $klientHasDomains->save();
		if ($kd) {
			
		    echo " Utworzono klienta na podstawie domeny";
		} else {
		    echo "\n Nie przypisałem klientowi $klient->nazwa domeny ". $domain->name ;
		}
		    
	    } else {
		 "\n Nie utworzyłem klienta na podstawie domeny ". $domain->name;
	    //	Yii::app()->end();
	    }
	    
	}
    }
}