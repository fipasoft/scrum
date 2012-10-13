<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

?>
<h1>Product Backlog</h1>
<h2><?php echo $model->key; ?></h2>
<h2><?php echo $model->name; ?></h2>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('index'));
 ?>
</div>
<br/>

<div>

</div>