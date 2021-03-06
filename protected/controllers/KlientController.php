<?php
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
class KlientController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createAddDomain','createDeleteDomain','updateDeleteDomain','updateAddDomain','createByDomain','CreateDomain'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				// 'users'=>array('admin'),
				'roles'=>array('administrator', 'koordynator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$domains = new Domains('searchWolne');
		$domains->unsetAttributes();
		if(isset($_GET['Domains']))
			$domains->attributes=$_GET['Domains'];
		
		
		
		
		$model=new Klient;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Klient']))
		{
			$model->attributes=$_POST['Klient'];
			if($model->save())
			{
				$session = Yii::app()->session;
				$domaindID = array();
				if (!empty($session['domainsID'])) {
					$domaindID = $session['domainsID'];
					$domaindID = array_unique($domaindID);
				foreach ($domaindID as $domains_id){
					$klienHasDomains = new KlientHasDomains();
					$klienHasDomains->domains_id = $domains_id;
					$klienHasDomains->klient_id = $model->id;
					
					$klienHasDomains->save();
				}
				
				unset($session['domainsID']);
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		if (Yii::app()->user->checkAccess("koordynator")) {
			$model->scenario ="administrator";
		} else {
			$model->users_id = Yii::app()->user->id;
		}
		
		$this->render('create',array(
		'model'=>$model, 'domains'=>$domains
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		
		$domains = new Domains('searchWolne');
		$domains->unsetAttributes();
		if(isset($_GET['Domains']))
			$domains->attributes=$_GET['Domains'];
		
		
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Klient']))
		{
			$model->attributes=$_POST['Klient'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,'domains'=>$domains
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Klient');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Klient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Klient']))
			$model->attributes=$_GET['Klient'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Klient the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Klient::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Klient $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='klient-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * przy dodawaniu nowego uzytkownika zapisujemy wybran domeny w sessji
	 * @param unknown $id
	 */
	public function actioncreateAddDomain($id) {
		$session = Yii::app()->session;
		$domaindID = array();
		if (!empty($session['domainsID']))
			$domaindID = $session['domainsID'];
		
		array_push($domaindID, $id);
		$session['domainsID']=$domaindID;
		
		
		$criteria= new CDbCriteria;
		$criteria->addInCondition('id', $domaindID);
		 
		$domenyWybrane = Domains::model()->findAll($criteria);
		$dataProvider=new CArrayDataProvider($domenyWybrane,
				array(
						'id'=>'id',
						 
						'pagination'=>array(
								'pageSize'=>100,
						),
				));
		$this->renderPartial("_domainsWybrane",array('dataProvider'=>$dataProvider));
	}
	
	public function actioncreateDeleteDomain($id) {
		$session = Yii::app()->session;
		$domaindID = array();
		if (!empty($session['domainsID']))
			$domaindID = $session['domainsID'];
	
		$domaindID = array_diff($domaindID, [$id]);
		$session['domainsID']=$domaindID;
	
	
		$criteria= new CDbCriteria;
		$criteria->addInCondition('id', $domaindID);
			
		$domenyWybrane = Domains::model()->findAll($criteria);
		$dataProvider=new CArrayDataProvider($domenyWybrane,
				array(
						'id'=>'id',
							
						'pagination'=>array(
								'pageSize'=>100,
						),
				));
		$this->renderPartial("_domainsWybrane",array('dataProvider'=>$dataProvider));
	}
	
	
	public function actionupdateAddDomain($id,$klient_id) {
		$klientHasDomains = new KlientHasDomains;
		$klientHasDomains->klient_id = $klient_id;
		$klientHasDomains->domains_id = $id;
		return $klientHasDomains->save();
	}
	
	public function actionupdateDeleteDomain($id,$klient_id) {
		$row = KlientHasDomains::model()->deleteAllByAttributes(array('klient_id'=>$klient_id, 'domains_id'=>$id));
		return $row;
	}
	
	/**
	 * Tworzy klient na podstawie domains
	 * @param int $id domains_id
	 */
	public function actioncreateByDomain($id) {
		$domain = Domains::model()->findByPk($id);
		if (empty($domain->id)) {
			echo BsHtml::alert(BsHtml::ALERT_COLOR_ERROR, "Nie utworzyłem klienta na podstawie domeny ". $domain->name);
			Yii::app()->end();
		}
		
		$klientHasDomains = KlientHasDomains::model()->findByAttributes(array("domains_id"=>$id));
		
		if (!empty($klientHasDomains)) {
			$klient = Klient::model()->findByPk($klientHasDomains->klient_id);
			echo BsHtml::alert(BsHtml::ALERT_COLOR_WARNING, "Istnieje klient z domęną: ". $domain->name ."<P>". BsHtml::linkButton("Aktualizuj klienta $klient->nazwa",
					  array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'url'=>Yii::app()->createAbsoluteUrl('klient/update/'.$klient->id),)));
			Yii::app()->end();
		}
		
		$klient = new Klient();
		$klient->nazwa = $domain->client;
		$klient->telefon = $domain->phone;
		$klient->email = $domain->email;
		$klient->status_id = 2;
		$klient->users_id = Yii::app()->user->id;
		$klient_id = $klient->save();
		
		if ($klient_id) {
			$klientHasDomains = new KlientHasDomains();
			$klientHasDomains->klient_id = $klient->id;
			$klientHasDomains->domains_id = $domain->id;
			$kd = $klientHasDomains->save();
			if ($kd) {
			
				echo BsHtml::alert(BsHtml::ALERT_COLOR_INFO, "Utworzono klienta na podstawie domeny ". $domain->name."<P>". BsHtml::linkButton("Aktualizuj klienta $klient->nazwa",
					  array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'url'=>Yii::app()->createAbsoluteUrl('klient/update/'.$klient->id),)));
			} else {
				//var_dump($klientHasDomains->errors);
				echo BsHtml::alert(BsHtml::ALERT_COLOR_ERROR, "Nie przypisałem klientowi $klient->nazwa domeny ". $domain->name);
			}
			
		} else {
			$txt = "";
			foreach($klient->errors as $e) {
				$txt.= $e[0]; 
			}
			echo BsHtml::alert(BsHtml::ALERT_COLOR_ERROR, "Nie utworzyłem klienta na podstawie domeny ". $domain->name. "<P>$txt");
			Yii::app()->end();
		}
		
	}
	
	function actionCreateDomain(){
		$session = Yii::app()->session;
		$domaindID = array();
		$domena = new Domains();
		$domena->unsetAttributes();
		
		if(isset($_POST['Domains'])) {
			$domena->attributes=$_POST['Domains'];
			
			if($domena->save()) {
				if (!empty($session['domainsID']))
					$domaindID = $session['domainsID'];
				
				array_push($domaindID, $domena->id);
				$session['domainsID']=$domaindID;
				echo BsHtml::alert(BsHtml::ALERT_COLOR_SUCCESS, "Dodano nową domenę");
			} else {
				$txt="";
				foreach ($domena->getErrors() as $e) {
					$txt.=$e[0]."<br>";
				}
				echo BsHtml::alert(BsHtml::ALERT_COLOR_ERROR, "Nie dodano domeny. <P>$txt");
			}
		}
		
		
	}
}