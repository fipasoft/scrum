<?php
$this->breadcrumbs=array(
	'Stories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Story', 'url'=>array('index')),
	array('label'=>'Create Story', 'url'=>array('create')),
	array('label'=>'Update Story', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Story', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Story', 'url'=>array('admin')),
);
?>

<h1>View Story #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'size_id',
		'sstory_id',
		'cstory_id',
		'numer',
		'description',
		'weight',
		'saved_at',
		'modified_in',
	),
)); ?>
