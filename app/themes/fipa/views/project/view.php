<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

?>
<h1>Ver proyecto</h1>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('index'));
 ?> /
 <?php
    echo 
        CHtml::link(
            'Agregar <img src="'.Yii::app()->theme->baseUrl.'/img/system/nuevo.png" alt="nuevo"/>',
            array('create')
        );
 ?> / 
 <?php
    echo CHtml::link('Editar <img src="'.Yii::app()->theme->baseUrl.'/img/system/editar.png"/>', 
                        array('project/update/'.$model->id));
 ?>
</div>
<br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array(
            'label'=>'Estado',
            'value'=>$model->sproject->name
        ),
        array(
            'label'=>'Clave',
            'value'=>$model->key
        ),
        array(
            'label'=>'Nombre',
            'value'=>$model->name
        ),
        array(
            'label'=>'Inicia',
            'value'=>($model->starts !="" && $model->starts!="0000-00-00" ? Utils::convierteFecha($model->starts) : "-")
        ),
        array(
            'label'=>'Finaliza',
            'value'=>($model->ends !="" && $model->ends!="0000-00-00" ? Utils::convierteFecha($model->ends) : "-")
        )
	),
)); ?>
