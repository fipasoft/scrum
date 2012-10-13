<?php
$this->breadcrumbs=array(
	'Cstories'=>array('index'),
	$model->name,
);

?>

<h1>Ver categor&iacute;a</h1>
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
                        array('cstory/update/'.$model->id));
 ?>
</div>
<br/>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key',
		'name',
	),
)); ?>
