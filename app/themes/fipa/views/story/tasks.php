<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	'Create',
);

?>

<h1>Tareas</h1>
<h2><?php echo $project->key; ?></h2>
<h2><?php echo $project->name; ?></h2>
<h2><?php echo $model->number . " - " . $model->description; ?></h2>
<div class="menucrud">
<?php
    echo CHtml::link('Volver <img src="'.Yii::app()->theme->baseUrl.'/img/system/volver.png"/>', 
                        array('project/productbacklog/'.$project->id));
 ?> /
  <?php
    echo CHtml::link(
        'Buscar <img src="'.Yii::app()->theme->baseUrl.'/img/system/buscar.png" alt="buscar"/>',
        array('#'),
        array('id'=>'btnBusqueda')
    );
 ?> / 
 <?php
    echo 
        CHtml::link(
            'Agregar Tarea <img src="'.Yii::app()->theme->baseUrl.'/img/system/nuevo.png" alt="nuevo"/>',
            array('task/create/'.$model->id)
        );
 ?>
</div>



<div class="search-form" id="divBusqueda" <?php if(!$task->filters){ echo 'style="display:none;"'; } ?>>
    
    <?php $this->renderPartial('_tsearch',array(
        'model'=>$task,
        'project'=>$project,
        'story'=>$model
    )); ?>
</div>

<br/>
<?php if(count($tasks)>0){ ?>
<div class="grid-view">
    <table class="items">
        <tr>
            <th class="centrar">ID</th>
            <th class="centrar">Resumen</th>
            <th class="centrar">Estado</th>
            <th class="centrar">Tipo</th>
            <th class="centrar">Asignada</th>
            <th></th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach($tasks as $task){ ?>
        <tr class="<?php echo ($i%2 == 0 ? "odd" : "even"); ?>">
            <td class="centrar"><?php echo $task->id; ?></td>
            <td class="centrar"><?php echo $task->summary; ?></td>
            <td class="centrar"><?php echo $task->stask->name; ?></td>
            <td class="centrar"><?php echo $task->ttask->name; ?></td>
            <td class="centrar"><?php echo $task->assigneds[0]->team->users->login; ?></td>
            <td class="centrar">
            
            <a href="<?php echo Yii::app()->baseUrl ?>/task/view/<?php echo $task->id; ?>">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/system/ver.png" />
            </a>
            
            <a href="<?php echo Yii::app()->baseUrl ?>/task/update/<?php echo $task->id; ?>">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/system/editar.png" />
            </a>
            
            <a class="deleteTask" href="<?php echo Yii::app()->baseUrl ?>/task/delete/<?php echo $task->id; ?>">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/system/eliminar.png" />
            </a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php } ?>
    </table>
</div>
<?php }else{?>
<div class="info">
<br/>
No se encontr&oacute; ningun registro para las condiciones establecidas.
<br/>
</div>
<?php } ?>