<div id='buscar_div' class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route)."/".$story->id,
	'method'=>'get',
    'id'=>'formBusqueda'
)); ?>

	<div class="row derecha">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>

		<?php echo $form->label($model,'Estado'); ?>
        <?php echo $form->dropDownList($model,'stask_id',Stask::DropDownListElements()); ?>

		<?php echo $form->label($model,'Tipo'); ?>
        <?php echo $form->dropDownList($model,'ttask_id',Ttask::DropDownListElements()); ?>
	</div>

	<div class="row derecha">
		<?php echo $form->label($model,'Resumen'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>256)); ?>
    </div>
    
	<div class="row derecha">
    	<?php echo $form->label($model,'Descripci&oacute;n'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

    <div class="row derecha">
        <?php echo $form->label($model,'Asignada'); ?>
        <?php echo $form->dropDownList($model,'team_id', $project->TeamDropDownListElements()); ?>
    </div>
    	
    <div class="row derecha">           
        <?php echo CHtml::submitButton('Buscar'); ?>
        <?php echo CHtml::Button('Limpiar',array('id'=>'btnLimpiar')); ?>       
        <?php echo CHtml::Button('Quitar filtros',array('id'=>'btnQuitar')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->