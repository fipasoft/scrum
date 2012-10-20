
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Datos.</legend>
<input type="hidden" name="story_id" id="story_id" value="<?php echo $story->id; ?>" />
    <div class="row">
        <?php echo $form->label($model,'Resumen'); ?><span class="obligatorio">*</span><br />
        <?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>256)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'Descripci&oacute;n'); ?><br />
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'_opcional_')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'Tiempo estimado'); ?><br />
        <?php echo $form->textField($model,'estimated', array('size'=>'4', 'maxlength'=>'10', 'class'=>'_opcional_ entero')); ?>
    </div>


	<div class="row">
		<?php echo $form->label($model,'Estado'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->dropDownList($model,'stask_id',Stask::DropDownListElements()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tipo'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->dropDownList($model,'ttask_id',Ttask::DropDownListElements()); ?>
	</div>
	
    <div class="row">
        <?php $model->team_id = $model->assigneds[0]->team->id; ?>
        <?php echo $form->label($model,'Asignada'); ?><span class="obligatorio">*</span><br />
        <?php echo $form->dropDownList($model,'team_id', $project->TeamDropDownListElements()); ?>
    </div>

	
	<div class="row">
		<?php echo $form->label($model,'Inicia'); ?><br />
		<?php echo $form->textField($model,'starts', array('size'=>'16', 'maxlength'=>'16', 'class'=>'_opcional_ _fechahora_',
		                              'value'=>($model->starts != "" && $model->starts != "0000-00-00 00:00:00" ? Utils::convierteFecha(substr($model->starts, 0, 10)).substr($model->starts, 10, 6) : ""))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Termina'); ?><br />
		<?php echo $form->textField($model,'ends', array('size'=>'16', 'maxlength'=>'16', 'class'=>'_opcional_ _fechahora_',
                                      'value'=>($model->ends != "" && $model->ends != "0000-00-00 00:00:00" ? Utils::convierteFecha(substr($model->ends, 0, 10)).substr($model->ends, 10, 6) : ""))); ?>
	</div>

</fieldset>


    <div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelarV', 'class'=>'btnCancelar')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>
    </div><!-- form -->
<?php $this->endWidget(); ?>