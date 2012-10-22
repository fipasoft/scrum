
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'story-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Datos.</legend>
<input type="hidden" name="project_id" id="project_id" value="<?php echo $project->id; ?>" />
    <div class="row">
        <?php echo $form->label($model,'Categor&iacute;a'); ?><span class="obligatorio">*</span><br />
        <?php echo $form->dropDownList($model,'cstory_id',Cstory::DropDownListElements()); ?>
    </div>
    
    <div class="row">
        <?php echo $form->label($model,'Estado'); ?><span class="obligatorio">*</span><br />
        <?php echo $form->dropDownList($model,'sstory_id',Sstory::DropDownListElements()); ?>
    </div>

    <div class="row">
         <div class="revisa noStory Story number <?php echo $project->id;?>">
	        <?php echo $form->label($model,'n&uacute;mero'); ?><span class="obligatorio">*</span><br />
	        <?php echo $form->textField($model,'number',array('size'=>'5','maxlength'=>'10','class'=>'entero elemento')); ?>
		    <?php if(!$model->isNewRecord){ ?>
	            <input type="hidden" value="<?php echo $model->number; ?>" class="valido"/>
	        <?php } ?>
	        <div class="recipiente">
	        </div>
	        
	        </div>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'descripci&oacute;n'); ?><span class="obligatorio">*</span><br />
        <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>768)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'Tama&ntilde;o'); ?><span class="obligatorio">*</span><br />
		<?php echo $form->dropDownList($model,'size_id',Size::DropDownListElements()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'peso'); ?><br/>
		<?php echo $form->textField($model,'weight',array('size'=>'5','maxlength'=>'10','class'=>'entero _opcional_')); ?>
	</div>

</fieldset>


    <div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelarV', 'class'=>'btnCancelar')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>
    </div><!-- form -->
<?php $this->endWidget(); ?>