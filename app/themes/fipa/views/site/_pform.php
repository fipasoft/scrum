

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Cambio de contrase&ntilde;a</legend>
	<div class="row">
		<?php echo $form->label($model,'contrase&ntilde;a'); ?><span class="obligatorio">*</span><br/>
		<?php echo $form->passwordField($model,'pass',array('size'=>15,'maxlength'=>15,'value'=>'','class'=>'cmp1')); ?><br/>
		<?php echo $form->error($model,'pass'); ?>
	</div>
	
	
	<div class="row">
		<label for="Usuario_repetir">Repetir contrase&ntilde;a</label>
		<span class="obligatorio">*</span>
		<br>
		<input id="Usuario_repetir" type="password" name="Usuario[repetir]" value="" maxlength="15" size="15" class="cmp2">
		<br>
		<input id="comparacion" type="hidden" name="Usuario[comparacion]" value="">
		<span id="mcontra" class="false">
		
		</span>
	</div>


</fieldset>
	<div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelarv')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>
    
</div><!-- form -->

<?php $this->endWidget(); ?>