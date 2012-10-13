<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sproject_id'); ?>
		<?php echo $form->textField($model,'sproject_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'starts'); ?>
		<?php echo $form->textField($model,'starts'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ends'); ?>
		<?php echo $form->textField($model,'ends'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'saved_at'); ?>
		<?php echo $form->textField($model,'saved_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_in'); ?>
		<?php echo $form->textField($model,'modified_in'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->