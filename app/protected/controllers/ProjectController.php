<?php
Yii::import('application.extensions.*');
require_once ('utilerias/main.php');

class ProjectController extends Controller
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
		try{
			$model=new Project;
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Project']))
			{
			
                if(Project::model()->exists("`key` = '".trim($_POST['Project']['key'])."'")){
                    throw new Exception("Error indique otra clave.");
                }
                        
				$model->sproject_id = $_POST['Project']['sproject_id'];
				$model->name =  $_POST['Project']['name'];
				$model->key =  $_POST['Project']['key'];
				$model->starts =   Utils::convierteFechaMySql($_POST['Project']['starts']);
				$model->ends =   Utils::convierteFechaMySql($_POST['Project']['ends']);
				$model->saved_at = new CDbExpression('NOW()');
				if(!$model->save()){
	                throw new Exception("Error al guardar el proyecto.");
				}
				
	            Historical::record("Se agregó el proyecto ".$model->key." - ".$model->name.".", "Project", $model->id);
				$this->redirect(array('view','id'=>$model->id));
			}
	
			$this->render('create',array(
				'model'=>$model,
			));
		}catch(Exception $e){
            throw new CHttpException("de sistema ", $e -> getMessage());
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		try{
				$model=$this->loadModel($id);
		
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);
		
				if(isset($_POST['Project']))
				{
					    if($model->key != trim($_POST['Project']['key']) && Project::model()->exists("`key` = '".trim($_POST['Project']['key'])."'")){
                            throw new Exception("Error indique otra clave.");
					    }
					
		                $model->sproject_id = $_POST['Project']['sproject_id'];
		                $model->name =  $_POST['Project']['name'];
		                $model->key =  trim($_POST['Project']['key']);
		                $model->starts =   Utils::convierteFechaMySql($_POST['Project']['starts']);
		                $model->ends =   Utils::convierteFechaMySql($_POST['Project']['ends']);
		                $model->modified_in = new CDbExpression('NOW()');
		                if(!$model->save()){
		                    throw new Exception("Error al guardar el proyecto.");
		                }
		                
		                Historical::record("Se editó el proyecto ".$model->key." - ".$model->name.".", "Project", $model->id);
		                $this->redirect(array('view','id'=>$model->id));
				}
		
				$this->render('update',array(
					'model'=>$model,
				));
	      }catch(Exception $e){
            throw new CHttpException("de sistema ", $e -> getMessage());
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		try{
			if(Yii::app()->request->isPostRequest)
			{
				// we only allow deletion via POST request
				$model = $this->loadModel($id);
				if(!$model->delete()){
					throw new Exception("Error al eliminar el proyecto.");
				}
				
	            Historical::record("Se eliminó el proyecto ".$model->key." - ".$model->name.".", "Project", $model->id);
	
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
			else
				throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}catch(Exception $e){
            throw new CHttpException("de sistema ", $e -> getMessage());
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//Verifica si hay algo cargado en la cache del paginador,
        //si es asi redirecciona a la pagina indicada
        Utils::cargaCache($this -> operacion);
        
        
        $model=new Project('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Project']))
            $model->attributes=$_GET['Project'];
		
        $this -> render('index', array('model' => $model, 'dataProvider' => $model -> search(), ));
	}
	
   /**
     * Define el equipo del proyecto y sus roles.
     */
    public function actionTeam($id)
    {
        try{
            $model=$this->loadModel($id);
    
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
    
            if(isset($_POST['user']) && isset($_POST['role']))
            {
            	$transaccion = Yii::app() -> db -> beginTransaction();
            	$tb = Team::model()->findAll("project_id = '".$model->id."'");
            	$ta = array();
            	foreach ($_POST['user'] as $k => $uid){
            	   $rid = $_POST['role'][$k];
            	   if(!Team::model()->exists("project_id = '".$model->id."' AND ".
            	                    "users_id = '".$uid."' AND role_id = '".$rid."'")){
	            	   $team = new Team();
	            	   $team->project_id = $model->id;	
	            	   $team->users_id = $uid;
	            	   $team->role_id = $rid;
	            	   $team->saved_at = new CDbExpression('NOW()');
	            	   
	            	   if(!$team->save()){
	            	   	   $transaccion->rollback();
	            	   	   throw new Exception("Error al guardar el team");
	            	   }
	            	   
	                   Historical::record("Se agregó al equipo del proyecto ".$model->key." - ".$model->name." al usuario ".$team->users->login." como ".$team->role->name.".", "Team", $team->id);
            	   }
            	   
            	   $ta[] = $uid.$rid;
            	}
            	foreach($tb as $member){
            		if(!in_array($member->users_id.$member->role_id, $ta)){
            			if(!$member->delete()){
                           $transaccion->rollback();
                           throw new Exception("Error al eliminar el team");
            				
            			}
                       Historical::record("Se eliminó del equipo del proyecto ".$model->key." - ".$model->name." al usuario ".$member->users->login." como ".$member->role->name.".", "Team", $member->id);
            		}
            	}
            	
                $transaccion->commit();
                $this->redirect(array('view','id'=>$model->id));
            }
    
            $this->render('team',array(
                'model'=>$model,
            ));
            
        }catch(Exception $e){
            throw new CHttpException("de sistema ", $e -> getMessage());
        }
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
