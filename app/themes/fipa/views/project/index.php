<?php
$this->breadcrumbs=array(
	'Projects',
);

?>

<h1>Proyectos</h1>

<div class="menucrud">
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
            'Agregar <img src="'.Yii::app()->theme->baseUrl.'/img/system/nuevo.png" alt="nuevo"/>',
            array('create')
        );
 ?>
</div>


<div class="search-form" id="divBusqueda" <?php if(!$model->filters){ echo 'style="display:none;"'; } ?>>
    
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div>


<?php if($dataProvider->totalItemCount>0){ ?>
    <?php
    $cols = array(
                'id',
	            array(
	                'name'=>'Estado',
	                'value'=>'$data->sproject->name'
	            ),
	            
	            array(
	                'name'=>'Clave',
	                'value'=>'$data->key'
	            ),
                
                array(
                    'name'=>'Nombre',
                    'value'=>'$data->name'
                ),
                
                array(
                    'name'=>'Inicia',
                    'value'=>'($data->starts !="" && $data->starts!="0000-00-00" ? Utils::convierteFechaReducido($data->starts) : "-")'
                ),
                
                array(
                    'name'=>'Finaliza',
                    'value'=>'($data->ends !="" && $data->ends!="0000-00-00" ? Utils::convierteFechaReducido($data->ends) : "-")'
                ),
                
            
            );
            
    $cols[] = array(// display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
            'template'=>'{view} {team} {productbacklog} {update} {delete}',
            'viewButtonImageUrl' => Yii::app()->theme->baseUrl.'/img/system/ver.png',
            'updateButtonImageUrl' => Yii::app()->theme->baseUrl.'/img/system/editar.png',
            'deleteButtonImageUrl' => Yii::app()->theme->baseUrl.'/img/system/eliminar.png',
            'buttons'=>array
                (
                    'team' => array
                    (
                        'label'=>'Equipo',
                        'imageUrl'=>Yii::app()->theme->baseUrl.'/img/system/habilidades.png',
                        'url'=>'Yii::app()->createUrl("project/team", array("id"=>$data->id))',
                    ),
                    'productbacklog' => array
                    (
                        'label'=>'Product Backlog',
                        'imageUrl'=>Yii::app()->theme->baseUrl.'/img/system/marcador.png',
                        'url'=>'Yii::app()->createUrl("project/productbacklog", array("id"=>$data->id))',
                    )
                ),
            );

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=> $cols,
));
?>
<?php }else{?>
<div class="info">
<br/>
No se encontr&oacute; ningun registro para las condiciones establecidas.
<br/>
</div>
<?php } ?>