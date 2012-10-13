<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sproject_id'); ?>
		<?php echo $form->textField($model,'sproject_id'); ?>
		<?php echo $form->error($model,'sproject_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'starts'); ?>
		<?php echo $form->textField($model,'starts'); ?>
		<?php echo $form->error($model,'starts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ends'); ?>
		<?php echo $form->textField($model,'ends'); ?>
		<?php echo $form->error($model,'ends'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saved_at'); ?>
		<?php echo $form->textField($model,'saved_at'); ?>
		<?php echo $form->error($model,'saved_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_in'); ?>
		<?php echo $form->textField($model,'modified_in'); ?>
		<?php echo $form->error($model,'modified_in'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->