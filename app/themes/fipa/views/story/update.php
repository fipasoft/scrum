<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Editar historia</h1>
<h2><?php echo $project->key; ?></h2>
<h2><?php echo $project->name; ?></h2>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('project/productbacklog/'.$project->id));
 ?>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model,'project'=>$project)); ?>