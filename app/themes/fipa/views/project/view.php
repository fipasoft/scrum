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
<?php if(count($model->teams) > 0){ ?>
<br/>
<h3>Equipo</h3>
<div class="menucrud">
 <?php
    echo CHtml::link('Equipo <img src="'.Yii::app()->theme->baseUrl.'/img/system/habilidades.png"/>', 
                        array('project/team/'.$model->id));
 ?>
</div>
<div class="grid-view">
    <table class="items">
        <tr>
	        <th class="centrar">Persona</th>
	        <th class="centrar">Rol</th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach($model->teams as $member){ ?>
            <tr class="<?php echo($i%2 == 0 ? "odd" : "even") ?>">
                <td class="centrar"><?php echo $member->users->login; ?></td>
                <td class="centrar"><?php echo $member->role->name; ?></td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </table>
</div>
<?php } ?>