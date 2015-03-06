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
				'actions'=>array('create','update','createAddDomain'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
				$this->redirect(array('view','id'=>$model->id));
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
}