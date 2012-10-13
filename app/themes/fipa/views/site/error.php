<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h1>Error <?php echo $code; ?></h1>
<br/>
<p class="error-box">
<?php echo CHtml::encode($message); ?>
<br/>
<br/>
<?php 
		$auth = Yii::app() -> authManager;
		$roles = $auth -> getRoles(Yii::app() -> user -> getId());
		if (!array_key_exists('trabajador', $roles)) {
			?>
		<a href="<?php echo Yii::app()->request->baseUrl; ?>" title="volver">Volver</a>
		<?php 
		} else {
			$session = new CHttpSession;
			$session -> open();
			?>
			<a href="<?php echo Yii::app() -> request -> baseUrl . '/empleado/'.$session['emp.id']; ?>" title="volver">Volver</a>
			<?php 
		}
?>
</p>