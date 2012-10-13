<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Team',
);


?>
<h1>Definir equipo</h1>

<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('index'));
 ?>
</div>
<?php echo $this->renderPartial('_tform', array('model'=>$model)); ?>