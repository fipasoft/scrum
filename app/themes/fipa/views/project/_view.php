<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sproject_id')); ?>:</b>
	<?php echo CHtml::encode($data->sproject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key')); ?>:</b>
	<?php echo CHtml::encode($data->key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('starts')); ?>:</b>
	<?php echo CHtml::encode($data->starts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ends')); ?>:</b>
	<?php echo CHtml::encode($data->ends); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saved_at')); ?>:</b>
	<?php echo CHtml::encode($data->saved_at); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_in')); ?>:</b>
	<?php echo CHtml::encode($data->modified_in); ?>
	<br />

	*/ ?>

</div>