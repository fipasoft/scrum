<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);


?>
<h1>Crear proyecto</h1>

<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('index'));
 ?>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>