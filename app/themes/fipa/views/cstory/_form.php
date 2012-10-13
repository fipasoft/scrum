
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cstory-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Datos.</legend>


    <div class="row">
        <div class="revisa noExiste Cstory key">
		<?php echo $form->label($model,'Clave'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->textField($model,'key',array('size'=>3,'maxlength'=>3, 'class'=>'elemento')); ?>
        <?php if(!$model->isNewRecord){ ?>
            <input type="hidden" value="<?php echo $model->key; ?>" class="valido"/>
        <?php } ?>
        <div class="recipiente">
        </div>
        
        </div>
    </div>

	<div class="row">
		<?php echo $form->label($model,'Nombre'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>
</fieldset>


    <div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelar', 'class'=>'btnCancelar')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->