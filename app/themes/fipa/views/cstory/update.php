<?php
$this->breadcrumbs=array(
	'Cstories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Editar categor&iacute;a</h1>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('index'));
 ?>
</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>