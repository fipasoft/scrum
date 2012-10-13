<?php

class SiteController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF, ),
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array('class' => 'CViewAction', ), );
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
		$this -> redirect('site/login');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app() -> errorHandler -> error) {
			if (Yii::app() -> request -> isAjaxRequest)
				echo $error['message'];
			else
				$this -> render('error', $error);
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		if (Yii::app() -> user -> name != 'Guest') {
			$this -> redirect(Yii::app() -> request -> baseUrl . '/project/index');
		}

		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app() -> end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model -> attributes = $_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid

			if ($model -> validate() && $model -> login()) {

				//Establece las variables de session
				$session = new CHttpSession;
				$session -> open();
				$session['usr.login'] = Yii::app()->user->name;
                $session['usr.id'] = Yii::app()->user->id;

				$this -> redirect(Yii::app() -> request -> baseUrl . '/project/index');

			}
		}
		// display the login form
		$this -> render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app() -> user -> logout();
		$session = new CHttpSession;
		$session -> open();
		$session -> destroy();

		$this -> redirect(Yii::app() -> homeUrl);
	}
	
	public function actionUsuario()
	{
		try{
			$session = new CHttpSession;
			$session -> open();
			$id = $session['usr.id'];
			
			$model = Usuario::model()->findByPk($id);
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			
			if(isset($_POST['Usuario']))
			{
				if($_POST['Usuario']['pass'] != $_POST['Usuario']['repetir']){
					throw new Exception("No coinciden las contraseñas.");	
				}
				$model->pass = sha1($_POST['Usuario']['pass']);
				$model->nombre = ($model->nombre!="" ? $model->nombre : '_');
				$model->ap = ($model->ap!="" ? $model->ap : '_');
				$model->am = ($model->am!="" ? $model->am : '_');
				if($model->save()){
					Historial::entrada("El usuario ".$model->login." cambio su contraseña.", "Site", $model->id);
					$this->redirect(array('usuario'));
				}
			}
	
			$this->render('usuario',array(
				'model'=>$model,
			));
		}catch(Exception $e){
			throw new CHttpException("de sistema ", $e -> getMessage());
		}
	}

}
