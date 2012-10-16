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
                        array('project/view/'.$model->id));
 ?> /
 <?php
    echo 
        CHtml::link(
            'Agregar historia <img src="'.Yii::app()->theme->baseUrl.'/img/system/nuevo.png" alt="nuevo"/>',
            array('story/create/'.$model->id)
        );
 ?>
</div>
<br/>



<?php if(count($model->pbacklogs)>0){ ?>
<?php $stories = $model->stories(); ?>
<div class="grid-view">
    <table class="items">
        <tr>
            <th class="centrar">N&uacute;mero</th>
            <th class="centrar">Descripci&oacute;n</th>
            <th class="centrar">Tama&ntilde;o</th>
            <th class="centrar">Peso</th>
            <th class="centrar">Estado</th>
            <th class="centrar">Categor&iacute;a</th>
            <th></th>
        </tr>
        <?php $i = 0; ?>
        <?php foreach($stories as $story){ ?>
        <tr class="<?php echo ($i%2 == 0 ? "odd" : "even"); ?>">
            <td class="centrar"><?php echo $story->number; ?></td>
            <td class="centrar"><?php echo $story->description; ?></td>
            <td class="centrar"><?php echo $story->size->name; ?></td>
            <td class="centrar"><?php echo ($story->weight != ""? $story->weight : "-"); ?></td>
            <td class="centrar"><?php echo $story->sstory->name; ?></td>
            <td class="centrar"><?php echo $story->cstory->name; ?></td>
            <td class="centrar">
            <a href="<?php echo Yii::app()->baseUrl ?>/story/update/<?php echo $story->id; ?>">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/system/editar.png" />
            </a>
            
            <a href="<?php echo Yii::app()->baseUrl ?>/story/delete/<?php echo $story->id; ?>">
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