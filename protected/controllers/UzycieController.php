<?php
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
class UzycieController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
				
				array('allow',
						'actions'=>array('byUser'),
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

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Uzycie;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Uzycie']))
		{
			$model->attributes=$_POST['Uzycie'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Uzycie']))
		{
			$model->attributes=$_POST['Uzycie'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Uzycie');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Uzycie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Uzycie']))
			$model->attributes=$_GET['Uzycie'];
		
		$exportType=Yii::app()->request->getParam('exportType');
		if (isset($exportType)) {
				
			$dp=$model->search();
			$dp->pagination=false;
			$this->widget ( 'EExcelView', array (
					'dataProvider' => $dp,
					'grid_mode' => 'export',
					'title' => 'RPT',
					'filename' => 'RPT_' . date( "Y-m-d H:i" ),
					'stream'=>true,
					'autoWidth' => false,
					'exportType'=>$exportType,
					// 'template' => "{summary}\n{items}\n{exportbuttons}\n{pager}",
					'columns' => array ( 
							array('name' =>'users_id', 'header'=>'Pracownik', 'value'=>'$data->users->imie ." ". $data->users->nazwisko ." (".$data->users->email .")"', 'filter'=> CHtml::listData(Users::model()->findAll(array('condition'=>"roles is not null or roles !=''", 'order'=>'nazwisko')), 'id', 'nazwisko') )
							,
							'users.imie', 'users.nazwisko', 'users.email',
							array('name'=> 'od','type' => 'datetime'),
							array('name'=> 'do','type' => 'datetime'),
							
							array('header'=>'Czas otwartego przydzielenia', 'value'=>'$data->getCzasoddo()'  ),
							array('header'=>'Czas od przydzielenia', 'value'=>'$data->getCzasodPrzydzielenia()' ),
							'przydzielenie.domains.name',
							
							
							array( 'header'=>'Abonent nazwa', 'value'=>'$data->przydzielenie->domains->klients[0]->nazwa'),
							array( 'header'=>'Abonent telefon', 'value'=>'$data->przydzielenie->domains->klients[0]->telefon '),
							array( 'header'=>'Abonent email', 'value'=>' $data->przydzielenie->domains->klients[0]->email'),
							array('header'=>'Data końca','value'=>'$data->przydzielenie->domains->expiry_date' ),
							array('header'=>'Rejestrator','value'=>'$data->przydzielenie->domains->registrar' ),
							array('header'=>'Osoby kontaktowe','value'=>'$data->getOsoby()' ),
								
							array('name'=>'przydzielenie.wykonano',  'value'=>'($data->przydzielenie->wykonano) ? "Tak":"Nie"',
									'filter'=>CHtml::dropDownList('Uzycie[wykonano]','', array('0'=>'Nie', '1'=>'Tak'),array('empty'=>'', 'class'=>'form-control') )
							),
							array('name' =>'status_id', 'value'=>'$data->status->nazwa', 'filter'=> CHtml::listData(Status::model()->findAll(array('order'=>'nazwa')), 'id', 'nazwa') ),
							array('header'=>'Notatka', 'value'=>'$data->przydzielenie->domains->klients[0]->notatka'),
							array('header'=>'Zainteresowany', 'value'=>'$data->getZaineteresowany()', 'type'=>'html'),
							)
							)
					);
		}
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Uzycie the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Uzycie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Uzycie $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='uzycie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionByUser($id){
		$model=new Uzycie('search');
		$model->unsetAttributes();  // clear any default values
		$model->users_id = $id;
		//$model->wykonano="0";
		$model->od=date('Y-m-d');
		//$model->do=date("Y-m-d");
		if(isset($_GET['Uzycie']))
			$model->attributes=$_GET['Uzycie'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}