<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Editar tarea</h1>
<h2><?php echo $project->key; ?></h2>
<h2><?php echo $project->name; ?></h2>
<h2><?php echo $story->number . " - " . $story->description; ?></h2>

<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('story/tasks/'.$story->id));
 ?>
</div>
 
<?php echo $this->renderPartial('_form', array('model'=>$model,'project'=>$project,'story'=>$story)); ?>