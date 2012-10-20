<?php
Yii::import('application.extensions.*');
require_once ('utilerias/main.php');

class TaskController extends Controller
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
		$model = $this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
		    'story'=>$model->story,
		    'project'=>$model->story->pbacklogs[0]->project
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
			try{
				$model=new Task;
	
				$story = Story::model()->findByPk($id);
				if($story->id == ""){
					throw new Exception("No tiene permiso para ver el contenido.");
				}
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);
	
				if(isset($_POST['Task']))
				{
                    $transaccion = Yii::app() -> db -> beginTransaction();
                
					$model->stask_id = $_POST['Task']['stask_id'];
                    $model->ttask_id = $_POST['Task']['ttask_id'];
                    $model->story_id = $story->id;
                    $model->summary = $_POST['Task']['summary'];
                    $model->description = $_POST['Task']['description'];
                    $model->estimated = $_POST['Task']['estimated'];
                    $model->starts = ($_POST['Task']['starts'] != "" ?Utils::convierteFechaMySql(substr($_POST['Task']['starts'], 0, 10)).substr($_POST['Task']['starts'],10) : "");
                    $model->ends = ($_POST['Task']['ends'] != "" ? Utils::convierteFechaMySql(substr($_POST['Task']['ends'], 0, 10)).substr($_POST['Task']['ends'],10) : "");
                    $model->saved_at = new CDbExpression('NOW()');
					if(!$model->save()){
                        $transaccion->rollback();
						throw new Exception("Error al guardar la tarea.");
					}
					
                    $project = $story->pbacklogs[0]->project;
                    
					$assigned = new Assigned();
					$assigned->team_id = $_POST['Task']['team_id'];
					$assigned->task_id = $model->id;
					$assigned->saved_at = new CDbExpression('NOW()');
				    if(!$assigned->save()){
                        $transaccion->rollback();
                        throw new Exception("Error al guardar la asignacion.");
                    }
                    
                    Historical::record("Se agregó la tarea ".$model->summary." a la historia número ".$story->number." - ".$story->description." - del proyecto ".$project->key." - ".$project->name.".", "Task", $model->id);
                    $transaccion->commit();
                    $this->redirect(array('task/view/'.$model->id));
				}
	
				$this->render('create',array(
				'model'=>$model,
				'story' => $story,
				'project'=> $story->pbacklogs[0]->project
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
	
				if(isset($_POST['Task']))
				{
                    $transaccion = Yii::app() -> db -> beginTransaction();
                
                    $model->stask_id = $_POST['Task']['stask_id'];
                    $model->ttask_id = $_POST['Task']['ttask_id'];
                    $model->summary = $_POST['Task']['summary'];
                    $model->description = $_POST['Task']['description'];
                    $model->estimated = $_POST['Task']['estimated'];
                    $model->starts = ($_POST['Task']['starts'] != "" ?Utils::convierteFechaMySql(substr($_POST['Task']['starts'], 0, 10)).substr($_POST['Task']['starts'],10) : "");
                    $model->ends = ($_POST['Task']['ends'] != "" ? Utils::convierteFechaMySql(substr($_POST['Task']['ends'], 0, 10)).substr($_POST['Task']['ends'],10) : "");
                    $model->modified_in = new CDbExpression('NOW()');
                    if(!$model->save()){
                        $transaccion->rollback();
                        throw new Exception("Error al guardar la tarea.");
                    }
                    
                    $story = $model->story;
                    $project = $story->pbacklogs[0]->project;
                    
                    $assigned = $model->assigneds[0];
                    if($assigned->id == ""){
                        $assigned = new Assigned();
                    }
                    
                    $assigned->team_id = $_POST['Task']['team_id'];
                    $assigned->task_id = $model->id;
                    $assigned->saved_at = new CDbExpression('NOW()');
                    if(!$assigned->save()){
                        $transaccion->rollback();
                        throw new Exception("Error al guardar la asignacion.");
                    }
                    
                    Historical::record("Se editó la tarea ".$model->summary." de la historia número ".$story->number." - ".$story->description." - del proyecto ".$project->key." - ".$project->name.".", "Task", $model->id);
                    $transaccion->commit();
                    $this->redirect(array('task/view/'.$model->id));
				}
	
				$this->render('update',array(
				'model'=>$model,
				'story'=>$model->story,
				'project'=>$model->story->pbacklogs[0]->project
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
				$this->loadModel($id)->delete();

				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
			else{
                $model = $this->loadModel($id);
                if(!$model->delete()){
                	throw new Exception("Error al eliminar la tarea.");
                }

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                $story = $model->story;
                $project = $story->pbacklogs[0]->project;
                Historical::record("Se eliminó la tarea ".$model->summary." de la historia número ".$story->number." - ".$story->description." - del proyecto ".$project->key." - ".$project->name.".", "Task", $model->id);
                $this->redirect(array('story/tasks/'.$model->story->id));				
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
			$model=Task::model()->findByPk($id);
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
			if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
	}
