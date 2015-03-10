<?php
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
class PrzydzielanieController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	// public $layout='//layouts/column2';

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
				'actions'=>array('view'),
				'users'=>array('@'),
			),
				
				array('allow',
						'actions'=>array('przydziel'),
						'roles'=>array('administrator','koordynator'),
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


	
	public function actionAdmin()
	{
		$model=new Domains('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Domains']))
			$model->attributes=$_GET['Domains'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Domains the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Przydzielenie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Domains $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='domains-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionPrzydziel($id,$users_id) {
		
			$model = new Przydzielenie();
			$model->kiedy = date('Y-m-d H:i:s',time());
			$model->wykonano=0;
			$model->users_id=$users_id;
			$model->domains_id =$id;
			$model->save();
		
	
		Yii::app()->end();
		
		
		
		
		//$this->renderPartial('/users/viewKlient',array(
		//		'model'=>Users::model()->findByPk($model->users_id),  'przydzielenie'=>$przydzielenie
		//));
		
	}
}