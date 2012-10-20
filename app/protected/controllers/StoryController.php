<?php
Yii::import('application.extensions.*');
require_once ('utilerias/main.php');

class StoryController extends Controller
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		try{
		
			$project = Project::model()->findByPk($id);
			if($project->id == ""){
				throw new Exception("No tiene permiso para ver el contenido.");
			}
			
			$model=new Story;
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Story']))
			{
			    $transaccion = Yii::app() -> db -> beginTransaction();
			    	
				if(Project::existsStory($project->id, $_POST['Story']['number'])){
					throw new Exception("La historia con el número ".$_POST['Story']['number']. " ya existe.");
				}
				
				$sstory = Sstory::model()->find("`key` = 'C'");
				$model->size_id = $_POST['Story']['size_id'];
                $model->weight = $_POST['Story']['weight'];
                $model->number = $_POST['Story']['number'];
                $model->cstory_id = $_POST['Story']['cstory_id'];
                $model->sstory_id = $sstory->id;
                $model->description = $_POST['Story']['description'];
                $model->saved_at = new CDbExpression('NOW()');
				if(!$model->save()){
                    $transaccion->rollback();
                    throw new Exception("Error al guardar la historia.".var_dump($model->errors));
				}
				
				$pbacklog = new Pbacklog();
				$pbacklog->project_id = $project->id;
				$pbacklog->story_id = $model->id;
				$pbacklog->saved_at = new CDbExpression('NOW()');
				if(!$pbacklog->save()){
                    $transaccion->rollback();
					throw new Exception("Error al guardar el product backlog.");
				}
				
				Historical::record("Se agregó la historia número ".$model->number." - ".$model->description." - al proyecto ".$project->key." - ".$project->name.".", "Story", $model->id);
				$transaccion->commit();
                $this->redirect(array('project/productbacklog/'.$project->id));
			}
	
			$this->render('create',array(
				'model'=>$model,
			     'project'=>$project
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
	
			if(isset($_POST['Story']))
			{
	                $model->size_id = $_POST['Story']['size_id'];
	                $model->weight = $_POST['Story']['weight'];
	                $model->number = $_POST['Story']['number'];
	                $model->cstory_id = $_POST['Story']['cstory_id'];
	                $model->description = $_POST['Story']['description'];
	                $model->modified_in = new CDbExpression('NOW()');
	                if(!$model->save()){
	                    $transaccion->rollback();
	                    throw new Exception("Error al guardar la historia.".var_dump($model->errors));
	                }
	                
	                $project = $model->pbacklogs[0]->project;
	                Historical::record("Se editó la historia número ".$model->number." - ".$model->description." - al proyecto ".$project->key." - ".$project->name.".", "Story", $model->id);
	                $this->redirect(array('project/productbacklog/'.$project->id));
			}
	
			$this->render('update',array(
				'model'=>$model,
			    'project'=>$model->pbacklogs[0]->project
			));
		}catch(Exception $e){
            throw new CHttpException("de sistema ", $e -> getMessage());
        }
	}
	
   /**
     * Muestra las tareas ligadas a la historia
     * @param integer $id el ID de la historia
     */
    public function actionTasks($id)
    {
        try{
        	 //Verifica si hay algo cargado en la cache del paginador,
	        //si es asi redirecciona a la pagina indicada
            $task = new Task();
	        Utils::cargaCache($this -> operacion);
        
        
        
            $model=$this->loadModel($id);
            $this->render('tasks',array(
                'model'=>$model,
                'project'=>$model->pbacklogs[0]->project,
                'task'=>$task,
                'tasks'=>$task->tasksPerStory($model->id)
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else{
            $model = $this->loadModel($id);
            
            $project = $model->pbacklogs[0]->project;
            
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(array('project/productbacklog/'.$project->id));		
		}
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
		$model=Story::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='story-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
