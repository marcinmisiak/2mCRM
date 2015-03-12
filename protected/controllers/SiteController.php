<?php

class SiteController extends Controller
{
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','error','login','logout'),
						'users'=>array('*'),
				),
					
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'roles'=>array('administrator'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'roles'=>array('administrator'),
				),
				array('allow','actions'=>array('PanelKoordynatora'), 'roles'=>array('koordynator')),
				array('allow','actions'=>array('PanelTelemarketera'), 'roles'=>array('telemarketer')),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	
	public function actionPanelKoordynatora() {
		$pracownicy = new Users('search');
		$pracownicy->unsetAttributes();
		$pracownicy->maRole =true;
		
		if (isset($_GET['Users']))
			$pracownicy->attributes=$_GET['Users'];
		
		
		$klienci = new Klient("search");
		$klienci->unsetAttributes();
		$klienci->bez_telefonu=1;
		
		if (isset($_GET['Klient']))
			$klienci->attributes=$_GET['Klient'];
		
		
		$domains = new Domains('searchBezKlienta');
		$domains->unsetAttributes();
		
		$date_od = strtotime("-1 day");
		$domains->expiry_date_od = date('Y-m-d', $date_od);
		
		$date_do = strtotime("+12 mouth"); //+100 years nie dziala???
		$domains->expiry_date_do = date('Y-m-d', $date_do);
		//var_dump($domains);exit;
		// $domains->klients = array('id'=>NULL);
		if(isset($_GET['Domains']))
			$domains->attributes=$_GET['Domains'];
		
		//	$domains = new Domains();
		//$domains->unsetAttributes();
		//$domains->user_id = $id;
		if(isset($_GET['Domains']) && $_GET['ajax'] == 'domains-grid') {
			$domains->attributes=$_GET['Domains'];
		}
		
		$domains_dostepne = new Domains('search');
		$domains_dostepne->unsetAttributes();
		$date_dostepne_od = strtotime("-1 day");
		$domains_dostepne->expiry_date_od = date('Y-m-d', $date_dostepne_od);
		$date_dostepne_do = strtotime("+1 month");
		$domains_dostepne->expiry_date_do = date('Y-m-d', $date_dostepne_do);
		if(isset($_GET['Domains']) && $_GET['ajax'] == 'domenyDostepne-grid' ) {
			$domains_dostepne->attributes = $_GET['Domains'];
		}
		
		
		
		$przydzielenie = new Przydzielenie('search');
		$przydzielenie->unsetAttributes();
		$przydzielenie->wykonano=0;
		if(isset($_GET['user_id'])) {			
		$przydzielenie->users_id =$_GET['user_id'];
		} else {
			$przydzielenie->users_id=0; //oj brzydko
		}
		if(isset($_GET['Przydzielenie'])) {
			$przydzielenie->attributes=$_GET['Przydzielenie'];
		}
		
		$this->render('_panelKoordynatora',array('przydzielenie'=>$przydzielenie, 'pracownicy'=>$pracownicy,  'klienci'=>$klienci,'domains'=>$domains,'expiry_data_od'=>$date_od, 'domains_dostepne'=>$domains_dostepne));
		
	}
	
	/**
	 * 
	 * @param string $id domains_id
	 */
	public function actionPanelTelemarketera($id=null, $przydzielanie_id =null){
		$przydzielanie = new Przydzielenie();
		$przydzielanie->users_id = Yii::app()->user->id;
		$przydzielanie->wykonano=0;
	
		$domains = null;
		$klient=null;
	if (!empty($id)) {
		$domains = Domains::model()->findByPk($id);
	//	var_dump($domains);
		$klientHasDomain = KlientHasDomains::model()->findByAttributes(array('domains_id'=>$id));
	//	var_dump($klientHasDomain['domains_id']);
		$klient = Klient::model()->with(array('domains','uslugisZaint'))->findByAttributes(array('id'=>$klientHasDomain['klient_id']));
	//	var_dump($klient);
	
		//kliknal dalej
		if(isset($_POST['Klient']) && !empty($klient)) {
			
			
			$klient->attributes = $_POST['Klient'];
			if ($klient->status->zamkniety==0) {
				$klient->scenario = 'niezamnkienty';
			}
			 $klient->validate();
			if (!empty($klient->errors)) {
				$this->render('_panelTeleparketera',array('domains'=>$domains,'przydzielanie'=>$przydzielanie, 'klient'=>$klient));
				Yii::app()->end();
			}
		//	$klient->uslugisZaint =  $_POST['Klient']['uslugisZaint'];
			$klient->save();
			
			
			if (empty($klient->uslugisZaint)) {
				$uz =  KlientZainteresowanyUslugi::model()->findAll("klient_id=:klient_id",array(':klient_id'=>$klient->id));
				foreach ($uz as $uzs){
					$uzs->delete();
				}
			} 
			foreach ($klient->uslugisZaint as $usluga_id) {
				$uz =  KlientZainteresowanyUslugi::model()->find("klient_id=:klient_id and uslugi_id=:uslugi_id",array(':klient_id'=>$klient->id, ':uslugi_id'=>$usluga_id ));
				if (!empty($uz)) {
						$uz->delete();
				}
				$uz = new KlientZainteresowanyUslugi();
				$uz->klient_id = $klient->id;
				$uz->uslugi_id = $usluga_id;
				//var_dump($uz);
				$uz->save();
			}
			
// 			Klient[notatka]	qwe
// 			Klient[rozmowa_konczaca]	0
// 			Klient[rozmowa_konczaca]	1
// 			Klient[status_id]	1
// 			Klient[uslugis]
// 			Klient[uslugis][]	1
// 			Przydzielenie[kiedy]	2015-03-27 10:24
			
			
			
			$klient = Klient::model()->with(array('domains','uslugisZaint'))->findByAttributes(array('id'=>$klientHasDomain['klient_id']));
			$przydzielenie = Przydzielenie::model()->findByPk($przydzielanie_id);
			if ($klient->status->zamkniety == 1) {
				// $przydzielenie->kiedy = $_POST['Przydzielenie']['kiedy'];
				$przydzielenie->wykonano=1;
				$zapis_przydzielanie =	$przydzielenie->save();
				
			} else {
				$przydzielenie->scenario = "niezamnkienty";
				$przydzielenie->kiedy = $klient->przydzielanie_kiedy;
				$przydzielenie->wykonano=0;
			$zapis_przydzielanie =	$przydzielenie->save();
			}
			if($zapis_przydzielanie) {
			//	$this->redirect($url);
			}
		}
		
	}
	
	
			$this->render('_panelTeleparketera',array('domains'=>$domains,'przydzielanie'=>$przydzielanie, 'klient'=>$klient));
		
		
	}
}