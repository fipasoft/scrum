<div id='buscar_div' class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'id'=>'formBusqueda'
)); ?>

	<div class="row derecha">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id', array('class'=>'fecha','size'=>'10','maxlength'=>'10')); ?>

		<?php echo $form->label($model,'Estado'); ?>
        <?php echo $form->dropDownList($model,'sproject_id',Sproject::DropDownListElements()); ?>
	</div>
	
    <div class="row derecha">
		<?php echo $form->label($model,'Clave'); ?>
		<?php echo $form->textField($model,'key',array('size'=>12,'maxlength'=>12)); ?>
	
		<?php echo $form->label($model,'Nombre'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>
	
    <div class="row derecha">
		<?php echo $form->label($model,'Inicia'); ?>
		<?php echo $form->textField($model,'starts', array('class'=>'_fecha_','size'=>'10','maxlength'=>'10')); ?>

		<?php echo $form->label($model,'Finaliza'); ?>
		<?php echo $form->textField($model,'ends', array('class'=>'_fecha_','size'=>'10','maxlength'=>'10')); ?>
		
        <?php echo $form->label($model,'A&ntilde;o'); ?>
        <?php echo $form->textField($model,'year', array('class'=>'entero','size'=>'4','maxlength'=>'4')); ?>
		
	</div>
	
    <div class="row derecha">           
        <?php echo CHtml::submitButton('Buscar'); ?>
        <?php echo CHtml::Button('Limpiar',array('id'=>'btnLimpiar')); ?>       
        <?php echo CHtml::Button('Quitar filtros',array('id'=>'btnQuitar')); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->