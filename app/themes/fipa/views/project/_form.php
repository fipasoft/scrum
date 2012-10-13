
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Datos.</legend>

	<div class="row">
		<?php echo $form->label($model,'Estado'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->dropDownList($model,'sproject_id',Sproject::DropDownListElements()); ?>
	</div>

	<div class="row">
        <div class="revisa noExiste Project key">
		<?php echo $form->label($model,'Clave'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->textField($model,'key',array('size'=>12,'maxlength'=>12, 'class'=>'elemento')); ?>
		<?php if(!$model->isNewRecord){ ?>
            <input type="hidden" value="<?php echo $model->key; ?>" class="valido"/>
        <?php } ?>
        <div class="recipiente">
        </div>
        
        </div>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Inicia'); ?><br/>
		<?php echo $form->textField($model,'starts', array('class'=>'_fecha_ _opcional_','size'=>'10','maxlength'=>'10',
		      'value'=>($model->starts !="" && $model->starts!="0000-00-00" ? Utils::convierteFecha($model->starts) : ""))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Finaliza'); ?><br/>
		<?php echo $form->textField($model,'ends', array('class'=>'_fecha_ _opcional_','size'=>'10','maxlength'=>'10',
              'value'=>($model->ends !="" && $model->ends!="0000-00-00" ? Utils::convierteFecha($model->ends) : "")))?>
	</div>
</fieldset>


    <div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelar', 'class'=>'btnCancelar')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>
    </div><!-- form -->
<?php $this->endWidget(); ?>
