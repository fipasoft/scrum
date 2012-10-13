<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Informaci&oacute;n del usuario</h1>
<h2><?php echo $model->login; ?></h2>
<div id = "dInfo">
<div class="menucrud">
	<a id="cpass">
		Cambiar contrase&ntilde;a
		<img src="/rh/app/themes/fipa/img/system/pass.png">
	</a>
</div>
<br/>
<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'login',
		'nombre',
		'ap',
		'am',
		'mail',
		'grupo',
	),
));
?>
</div>
<div id="dPass" style="display:none;">
<?php echo $this->renderPartial('_pform', array('model'=>$model)); ?>
</div>