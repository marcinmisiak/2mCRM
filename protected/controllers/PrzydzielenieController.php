<?php
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
class PrzydzielenieController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
				'ajaxOnly + createProperty',
				);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * 
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array (
								'view' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'przydziel',
								'delete',
								'Masowo', 'masowoModal', 'szukajNieprzydzielonychAjax','PrzydzielMasowo'
						),
						'roles' => array (
								'koordynator' 
						) 
				),
				
				array (
						'deny', // deny all users
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 * Displays a particular model.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render ( 'view', array (
				'model' => $this->loadModel ( $id ) 
		) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Przydzielenie ();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset ( $_POST ['Przydzielenie'] )) {
			$model->attributes = $_POST ['Przydzielenie'];
			if ($model->save ())
				$this->redirect ( array (
						'view',
						'id' => $model->id 
				) );
		}
		
		$this->render ( 'create', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id );
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset ( $_POST ['Przydzielenie'] )) {
			$model->attributes = $_POST ['Przydzielenie'];
			if ($model->save ())
				$this->redirect ( array (
						'view',
						'id' => $model->id 
				) );
		}
		
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if (Yii::app ()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel ( $id )->delete ();
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			// if(!isset($_GET['ajax']))
			// $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			Yii::app ()->end ();
		} else
			throw new CHttpException ( 400, 'Invalid request. Please do not repeat this request again.' );
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'Przydzielenie' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Przydzielenie ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Przydzielenie'] ))
			$model->attributes = $_GET ['Przydzielenie'];
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return Przydzielenie the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Przydzielenie::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * 
	 * @param Przydzielenie $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'przydzielenie-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
	
	/**
	 * przydzielanie domeny na panelu koordynatora
	 * 
	 * @param unknown $id        	
	 * @param unknown $users_id        	
	 */
	public function actionPrzydziel($id, $users_id) {
		$model = new Przydzielenie ();
		$model->kiedy = date ( 'Y-m-d H:i:s', strtotime ( "+1 day" ) );
		$model->wykonano = 0;
		$model->users_id = $users_id;
		$model->domains_id = $id;
		
		if ($model->save ()) {
			echo BsHtml::alert ( BsHtml::ALERT_COLOR_SUCCESS, "Dodano do kolejki pracownika. Planowany czas wykonania kontaktu: " . $model->kiedy );
		}
		
		Yii::app ()->end ();
	}
	
	/**
	 * przydzielanie masowo domen
	 * 
	 * @param unknown $iser_id        	
	 */
	public function actionMasowo($id) {
		$user = Users::model ()->findByPk ( $id );
		$time = strtotime ( "+8 days" );
		$wykonaj = Yii::app ()->request->getParam ( 'wykonaj', false );
		
		if ($wykonaj) {
			// przydzielam
			$cmd = Yii::app ()->db->createCommand ();
			$cmd->select = "domains.id, domains.name";
			$cmd->from = "domains";
			$cmd->leftJoin ( 'przydzielenie', 'domains.id=przydzielenie.domains_id' );
			$cmd->join ( "klient_has_domains", 'domains.id = klient_has_domains.domains_id' );
			if (! empty ( $user->ilosc_domen )) {
				$cmd->limit ( $user->ilosc_domen );
			}
			$cmd->where ( "przydzielenie.domains_id is null and expiry_date = :expiry_date", array (
					":expiry_date" => date ( 'Y-m-d', $time ) 
			) );
			$domeny = $cmd->queryAll ();
			$przydzielenie_muliti = array ();
			foreach ( $domeny as $d ) {
				$przydzielenie_muliti [] = array (
						'kiedy' => date ( "Y-m-d" ),
						'domains_id' => $d ['id'],
						'users_id' => $id 
				);
			}
			if (!empty($przydzielenie_muliti)) {
			$builder = Yii::app ()->db->schema->commandBuilder;
			$command = $builder->createMultipleInsertCommand ( 'przydzielenie', $przydzielenie_muliti );
			$liczba_przydzielonych = $command->execute ();
			if ($liczba_przydzielonych) {
				echo BsHtml::alert ( BsHtml::ALERT_COLOR_INFO, "Przydzielono " . $liczba_przydzielonych . " domen do kolejki na " . date ( "Y-m-d" ) );
			} else {
				echo BsHtml::alert ( BsHtml::ALERT_COLOR_DANGER, "Nie przydzialono klientów" );
			}
			} else {
				echo BsHtml::alert ( BsHtml::ALERT_COLOR_DANGER, "Brak domen do przydizelenie (liczba domen: 0)" );
			}
			Yii::app ()->end ();
		}
		
		$txt = "<h3>Przydzelanie masowe</h3><P>Pracownik: $user->imie $user->nazwisko $user->email</p>";
		if (! empty ( $user->ilosc_domen )) {
			$txt .= "<P>Pracownik przydzielone będzie miał maksyalmie <strong>$user->ilosc_domen</strong> domen na dzień.</p>";
		} else {
			$txt .= "<P class='text-danger'>Pracownik nie ma oksreślonej maksymalnej ilości domen na dzień</P>";
		}
		
		/*
		 * $cmd = Yii::app()->db->createCommand();
		 * $cmd->select ="*";
		 * $cmd->from="domains";
		 * $cmd->leftJoin("klient_has_domains", 'domains.id = klient_has_domains.domains_id');
		 * if (!empty($user->ilosc_domen)) {
		 * $cmd->limit($user->ilosc_domen);
		 * }
		 * $cmd->where("klient_has_domains.domains_id is null and expiry_date = :expiry_date", array(":expiry_date"=>date('Y-m-d', $time)));
		 * $domeny = $cmd->queryAll();
		 */
		// tylko liczbe domen nieprzydzielonych
		
		$cmd = Yii::app ()->db->createCommand ( "SELECT count(*) as liczba FROM `domains` `t` 
LEFT OUTER JOIN `przydzielenie` `przydzielenies` ON
(`przydzielenies`.`domains_id`=`t`.`id`)
				 INNER JOIN `klient_has_domains`
`not_in_hasDomains` ON (`not_in_hasDomains`.`domains_id`=`t`.`id`) WHERE
((expiry_date = :expiry_date) AND (przydzielenies.domains_id is
null))" );
		$domeny = $cmd->queryRow ( true, array (
				":expiry_date" => date ( 'Y-m-d', $time ) 
		) );
		// var_dump($cmd->getText());exit;
		$txt .= "Domen przypisanych do klientów nieprzydzielonych pracownikom z datą wygaśnięcia " . date ( 'Y-m-d', $time ) . " jest <strong>" . $domeny ['liczba'] . "</strong><p>";
		
		// $txt .= BsHtml::ajaxLink("Przydziel masowo domeny pracownikowi",
		// Yii::app()->createAbsoluteUrl('przydzielenie/masowo/'.$id, array("wykonaj"=>1)),
		// array('update'=>'#ajaxUsers'));
		
		$txt .= BsHtml::linkButton ( 'Przydziel masowo domeny pracownikowi do wykonania na ' . date ( "Y-m-d" ), array (
				'url' => Yii::app ()->createAbsoluteUrl ( 'przydzielenie/masowo', array (
						"id" => $id,
						"wykonaj" => 1 
				) ),
				'ajax' => array (
						'type' => 'POST',
						'update' => '#ajaxUsers' 
				) 
		) );
		
		echo BsHtml::alert ( BsHtml::ALERT_COLOR_INFO, $txt );
	}
	public function actionMasowoModal() {
		$model = new PrzydzielanieModalForm();
		
		if(isset($_POST['PrzydzielanieModalForm'])) {
			$model->attributes = $_POST['PrzydzielanieModalForm'];
			$model->validate();
			$user = Users::model ()->findByPk ( $model->id );
			$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
					'id'=>'PrzydzielanieModal-form',
					'enableAjaxValidation'=>false,
					'action'=>Yii::app()->createAbsoluteUrl('przydzielenie/szukajNieprzydzielonychAjax/'. $model->id ),
					//'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
			
			));
			$txt = "<h3>Pracownik: $user->imie $user->nazwisko $user->email</h3>";
			$txt .= $form->errorSummary($model);
			$txt .= $form->textFieldControlGroup($model,'expiry_date',array('maxlength'=>10));
			$txt .= $form->textFieldControlGroup($model,'kiedy',array('maxlength'=>10));
			$txt .= $form->hiddenField($model,'id');
			if (! empty ( $user->ilosc_domen )) {
				$txt .= "<P>Pracownik przydzielone będzie miał maksyalmie <strong>$user->ilosc_domen</strong> domen na dzień.</p>";
			} else {
				$txt .= "<P class='text-danger'>Pracownik nie ma oksreślonej maksymalnej ilości domen na dzień</P>";
			}
			$cmd = Yii::app ()->db->createCommand ( "SELECT count(*) as liczba FROM `domains` `t` LEFT OUTER JOIN `przydzielenie` `przydzielenies` ON
				(`przydzielenies`.`domains_id`=`t`.`id`)
				 INNER JOIN `klient_has_domains`
				`not_in_hasDomains` ON (`not_in_hasDomains`.`domains_id`=`t`.`id`) WHERE
				((expiry_date = :expiry_date) AND (przydzielenies.domains_id is null))" );
			$domeny = $cmd->queryRow ( true, array (
					":expiry_date" => $model->expiry_date
			) );
			$txt .= "<div id='ajaxNieprzydzieloneInfo'>Domen przypisanych do klientów nieprzydzielonych pracownikom z datą wygaśnięcia " . $model->expiry_date . " jest <strong>" . $domeny ['liczba'] . "</strong><div>";
			
			echo $txt;
			
			Yii::app()->end();
		}
		
		$id = Yii::app()->request->getParam('id');
		$user = Users::model ()->findByPk ($id);
		
		
		$time = strtotime ( "+8 days" );
		
		$txt = "<h3>Pracownik: $user->imie $user->nazwisko $user->email</h3>";
		
		
		
		$model->expiry_date = date ( 'Y-m-d', $time );
		$model->kiedy = date ( 'Y-m-d' );
		$model->id = $id;
		$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'PrzydzielanieModal-form',
				'enableAjaxValidation'=>false,
				'action'=>Yii::app()->createAbsoluteUrl('przydzielenie/szukajNieprzydzielonychAjax/'. $id ),
				//'layout'=>BsHtml::FORM_LAYOUT_HORIZONTAL,
				
		)); 
		$txt .= $form->errorSummary($model);
		$txt .= $form->textFieldControlGroup($model,'expiry_date',array('maxlength'=>10));
		$txt .= $form->textFieldControlGroup($model,'kiedy',array('maxlength'=>10));
		$txt .= $form->hiddenField($model,'id');
		
		
		
		if (! empty ( $user->ilosc_domen )) {
			$txt .= "<P>Pracownik przydzielone będzie miał maksyalmie <strong>$user->ilosc_domen</strong> domen na dzień.</p>";
		} else {
			$txt .= "<P class='text-danger'>Pracownik nie ma oksreślonej maksymalnej ilości domen na dzień</P>";
		}
		$cmd = Yii::app ()->db->createCommand ( "SELECT count(*) as liczba FROM `domains` `t` LEFT OUTER JOIN `przydzielenie` `przydzielenies` ON
				(`przydzielenies`.`domains_id`=`t`.`id`)
				 INNER JOIN `klient_has_domains`
				`not_in_hasDomains` ON (`not_in_hasDomains`.`domains_id`=`t`.`id`) WHERE
				((expiry_date = :expiry_date) AND (przydzielenies.domains_id is null))" );
		$domeny = $cmd->queryRow ( true, array (
				":expiry_date" => date ( 'Y-m-d', $time ) 
		) );
		$txt .= "<div id='ajaxNieprzydzieloneInfo'>Domen przypisanych do klientów nieprzydzielonych pracownikom z datą wygaśnięcia " . date ( 'Y-m-d', $time ) . " jest <strong>" . $domeny ['liczba'] . "</strong><div>";
	
		echo $txt;
	}
	
	public function actionszukajNieprzydzielonychAjax() {
	 $dane = new PrzydzielanieModalForm();
	 $dane->attributes = $_GET['PrzydzielanieModalForm'];
	
	 $cmd = Yii::app ()->db->createCommand ( "SELECT count(*) as liczba FROM `domains` `t` LEFT OUTER JOIN `przydzielenie` `przydzielenies` ON
				(`przydzielenies`.`domains_id`=`t`.`id`)
				 INNER JOIN `klient_has_domains`
				`not_in_hasDomains` ON (`not_in_hasDomains`.`domains_id`=`t`.`id`) WHERE
				((expiry_date = :expiry_date) AND (przydzielenies.domains_id is null))" );
	 $domeny = $cmd->queryRow ( true, array (
	 		":expiry_date" => $dane->expiry_date
	 ) );
	 $txt = "<div id='ajaxNieprzydzieloneInfo'>Domen przypisanych do klientów nieprzydzielonych pracownikom z datą wygaśnięcia " . $dane->expiry_date . " jest <strong>" . $domeny ['liczba'] . "</strong><div>";
	 echo $txt;
	
	}
	
	public function actionPrzydzielMasowo() {
		$dane = new PrzydzielanieModalForm();
		
	 $dane->attributes = $_POST['PrzydzielanieModalForm'];
	 
	 if ($dane->validate()) {
	 	// przydzielam
	 	$user = Users::model ()->findByPk ( $dane->id );
	 	$cmd = Yii::app ()->db->createCommand ();
	 	$cmd->select = "domains.id, domains.name";
	 	$cmd->from = "domains";
	 	$cmd->leftJoin ( 'przydzielenie', 'domains.id=przydzielenie.domains_id' );
	 	$cmd->join ( "klient_has_domains", 'domains.id = klient_has_domains.domains_id' );
	 	if (! empty ( $user->ilosc_domen )) {
	 		$cmd->limit ( $user->ilosc_domen );
	 	}
	 	$cmd->where ( "przydzielenie.domains_id is null and expiry_date = :expiry_date", array (
	 			":expiry_date" => $dane->expiry_date
	 	) );
	 	$domeny = $cmd->queryAll ();
	 	$przydzielenie_muliti = array ();
	 	foreach ( $domeny as $d ) {
	 		$przydzielenie_muliti [] = array (
	 				'kiedy' => date ( "Y-m-d" ),
	 				'domains_id' => $d ['id'],
	 				'users_id' => $dane->id
	 		);
	 		
	 	}
	 	if (!empty($przydzielenie_muliti)) {
	 		$builder = Yii::app ()->db->schema->commandBuilder;
	 		$command = $builder->createMultipleInsertCommand ( 'przydzielenie', $przydzielenie_muliti );
	 		$liczba_przydzielonych = $command->execute ();
	 		if ($liczba_przydzielonych) {
	 			echo BsHtml::alert ( BsHtml::ALERT_COLOR_INFO, "Przydzielono " . $liczba_przydzielonych . " domen do kolejki na " . $dane->kiedy );
	 		} else {
	 			echo BsHtml::alert ( BsHtml::ALERT_COLOR_DANGER, "Nie przydzialono klientów" );
	 		}
	 	} else {
	 		echo BsHtml::alert ( BsHtml::ALERT_COLOR_DANGER, "Brak domen do przydzielenia (liczba domen: 0)" );
	 	}
	 } else {
	  
	 	foreach ($dane->getErrors() as $e) {
	 		echo BsHtml::alert(BsHtml::ALERT_COLOR_ERROR, $e[0]);
	 	}
	 	
	 }
	 
	}
	
}