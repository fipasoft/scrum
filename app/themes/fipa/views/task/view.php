<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->id,
);

?>
<h1>Ver tarea</h1>
<h2><?php echo $project->key; ?></h2>
<h2><?php echo $project->name; ?></h2>
<h2><?php echo $story->number . " - " . $story->description; ?></h2>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('story/tasks/'.$model->story_id));
 ?> /
 <?php
    echo 
        CHtml::link(
            'Agregar <img src="'.Yii::app()->theme->baseUrl.'/img/system/nuevo.png" alt="nuevo"/>',
            array('task/create/'.$model->story_id)
        );
 ?> / 
 <?php
    echo CHtml::link('Editar <img src="'.Yii::app()->theme->baseUrl.'/img/system/editar.png"/>', 
                        array('task/update/'.$model->id));
 ?>
</div>
<br/>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array(
            'label'=>'Resumen',
            'value'=>$model->summary
        ),
        array(
            'label'=>'Descripci&oacute;n',
            'value'=>($model->description != "" ? $model->description : "-")
        ),
        array(
            'label'=>'Asignada',
            'value'=>$model->assigneds[0]->team->users->login
        ),
        array(
            'label'=>'Tipo',
            'value'=>$model->ttask->name
        ),
        array(
            'label'=>'Estado',
            'value'=>$model->stask->name
        ),
        array(
            'label'=>'Tiempo estimado',
            'value'=>($model->estimated != "" ? $model->estimated. 
                        ($model->estimated != 1 ? " horas" : " hora")
                        : "-")
        ),
        array(
            'label'=>'Inici&oacute;',
            'value'=>Utils::convierteFechaReducido(substr($model->starts, 0, 10)).substr($model->starts, 10, 6)
        ),
        array(
            'label'=>'Finaliz&oacute;',
            'value'=>Utils::convierteFechaReducido(substr($model->ends, 0, 10)).substr($model->ends, 10, 6)
        )
	),
)); ?>
