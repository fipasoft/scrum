<?php

class RevisaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    
    public function actionNoExiste($tabla, $campo, $valor)
    {
        try{
	            $model = new $tabla();
	            $model = $model->find("`".$campo."`='".$valor."'");
	            $v = false;
	            if($model->id == ""){
	            	$v = true;
	            }
	            
	             $this->renderPartial('_noExiste',array(
				'model'=>$model,
	            'bandera'=>$v
				));
        	
			
         }catch (Exception $e){
            throw new CHttpException("de sistema",$e->getMessage());
        }
        
    }
    
    public function actionNoStory($tabla, $campo, $valor, $project_id)
    {
        try{
        	    $v = false;
        	    $project = Project::model()->findByPk($project_id);
                if($tabla == "Story" && $campo = "number" && $project->id != ""){
                	$v = !Project::existsStory($project->id, $valor);
                }
                
                 $this->renderPartial('_noStory',array(
                'bandera'=>$v
                ));
                
            
            
         }catch (Exception $e){
            throw new CHttpException("de sistema",$e->getMessage());
        }
        
    }

}
