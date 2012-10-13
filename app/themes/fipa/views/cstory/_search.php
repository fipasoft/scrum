<div id='buscar_div' class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'id'=>'formBusqueda'
)); ?>

	<div class="row derecha">
		<?php echo $form->label($model,'Clave'); ?>
		<?php echo $form->textField($model,'key',array('size'=>3,'maxlength'=>3)); ?>

		<?php echo $form->label($model,'Nombre'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>
    
    <div class="row derecha">           
        <?php echo CHtml::submitButton('Buscar'); ?>
        <?php echo CHtml::Button('Limpiar',array('id'=>'btnLimpiar')); ?>       
        <?php echo CHtml::Button('Quitar filtros',array('id'=>'btnQuitar')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->