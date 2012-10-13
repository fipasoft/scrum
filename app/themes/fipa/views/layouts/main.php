<?php
$yiiPath = Yii::app()->baseUrl . '/'; 
$path = Yii::app()->theme->baseUrl . '/';
$basepath = Yii::app()->theme->basePath . '/';
$css_path = $path . 'css/';
$js_path = $path . 'javascript/';
$year = date('Y');

$controlador = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;

$vista = ($action == '' ? 'index' : $action);

?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <link href="<?php echo $css_path ?>system/tripoli.base.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo $css_path ?>system/tripoli.type.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo $css_path ?>system/tripoli.visual.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo $css_path ?>system/tripoli.layout.css" type="text/css" rel="stylesheet" />
  <!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo $css_path ?>system/tripoli.base.ie.css" /><![endif]-->

  <title>SCRUM <?php echo ucfirst($controlador); ?></title>
  
 <link href="<?php echo $js_path ?>system/jquery-ui-1.8.16/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo $js_path ?>system/jquery-ui-1.8.16/js/jquery-ui-1.8.16.custom.min.js"></script>
 <link href="<?php echo $css_path ?>system/nav.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo $css_path ?>system/style.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo $css_path ?>system/print.css" type="text/css" rel="stylesheet" media="print" />
  
<?php if(file_exists($basepath . 'css/view/' . $controlador . '.css')){?>
  <link href="<?php echo $css_path . 'view/' . $controlador ?>.css" type="text/css" rel="stylesheet" />
<?php }?>
<?php  if(file_exists($basepath . 'css/view/' . $controlador . '.' . $vista . '.css')){?>
  <link href="<?php echo $css_path . 'view/' . $controlador . '.' . $vista ?>.css" type="text/css" rel="stylesheet" />
<?php }?>
<?php if(file_exists($basepath . 'css/view/' . $controlador . '.' . $vista . '.print.css')){?>
  <link href="<?php echo $css_path . 'view/' . $controlador . '.' . $vista ?>.print.css" type="text/css" rel="stylesheet" media="print" />
<?php }?>
  <script type="text/javascript" src="<?php echo $js_path ?>system/event/adddomloadevent.js"></script>
  
  <script type="text/javascript" src="<?php echo $js_path ?>plugins/class.jquery.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>system/sys.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>system/cssclass.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>system/form.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>system/funciones.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>plugins/fvalidator.jquery.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>plugins/localizacion.jquery.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>plugins/revisa.jquery.js"></script>
  <script type="text/javascript" src="<?php echo $js_path ?>plugins/jquery-ui-timepicker-addon.js"></script>
  
  
<?php if(file_exists($basepath . 'javascript/view/' . $controlador . '.js')){?>
  <script type="text/javascript" src="<?php echo $js_path . 'view/' . $controlador ?>.js"></script>
<?php }?>
<?php if(file_exists($basepath . 'javascript/view/' . $controlador . '.' . $vista . '.js')){?>
  <script type="text/javascript" src="<?php echo $js_path . 'view/' . $controlador . '.' . $vista?>.js"></script>
<?php }?>

		<?php 
		$jqueryslidemenupath = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/jqueryslidemenu/');
 
		//Register jQuery, JS and CSS files
		Yii::app()->clientScript->registerCssFile($jqueryslidemenupath.'/jqueryslidemenu.css');
		 
		Yii::app()->clientScript->registerCoreScript('jquery');
		 
		Yii::app()->clientScript->registerScriptFile($jqueryslidemenupath.'/jqueryslidemenu.js');
		
		$jcolorbox = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/colorbox/');
 
		//Register jQuery, JS and CSS files
		Yii::app()->clientScript->registerCssFile($jcolorbox.'/colorbox.css');
		 
		Yii::app()->clientScript->registerScriptFile($jcolorbox.'/jquery.colorbox.js');
		?>

</head>
<body class="l10 wide">
<div id="container">
	<div id="header">
	<div class="content">
		<?php if(Yii::app()->user->name != 'Guest'){ ?>
		
		<div id="banner"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/system/banner.png" /></div>
			<div id="menu_container">

		
	<div id="myslidemenu" class="jqueryslidemenu">

				<?php 
					$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
                            array('label'=>'Proyectos', 'url'=>array('project/index'),
                                )
                            ,
                            array('label'=>'Catalogos', 'url'=>array('#'),'items'=>array(
                                array('label'=>'Historias', 'url'=>array('#'), 'items' => array(
                                    array('label'=>'Categorías', 'url'=>array('cstory/index'))
                                )),
                                )
                                )
                            ,
                            array('label'=>'Sistema', 'url'=>array('#'), 'items'=>array(
                                array('label'=>'Historial', 'url'=>array('/historial/index'), 'tag'=>'Historial','visible'=>Yii::app()->user->checkAccess('historialIndex')),
                                array('label'=>'Usuarios', 'url'=>array('/usuario/index'),'visible'=>Yii::app()->user->checkAccess('usuarioIndex')),
                                array('label'=>'RBAC', 'url'=>array('/rbac/rbac'), 'visible'=>Yii::app()->user->name == 'root'),
                                array('label'=>'Crear permisos', 'url'=>array('/permisos/crea'), 'visible'=>Yii::app()->user->name == 'root')
                                ),'visible'=>true
							)))
						);
			?>
			</div><!-- myslidemenu-->
			</div>
			<?php }else{ ?>
				<div id="loginBan"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/system/login.png" /></div>
			<?php }?>
	</div>
	
	</div>
	<br/>
	<br/>
		<input type="hidden" name="YIIbaseUrl" id="YIIbaseUrl" value="<?php echo $yiiPath; ?>" />
        <input type="hidden" name="YIIthemeUrl" id="YIIthemeUrl" value="<?php echo $path; ?>" />
		<input type="hidden" name="controller" id="controller" value="<?php echo $controlador; ?>" />
		<input type="hidden" name="action" id="action" value="<?php echo $vista; ?>" />
	<?php echo $content; ?>
	<div id="footer">
		<div class="content">
				<div id="pie"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/system/udg_pie.png" /></div>
				<span class="sub2" id="piemenu">
				FiPa Software <?php echo $year ?> 
				<a class="config" href="<?php echo $yiiPath; ?>site/usuario/">
				<img title="Configuración" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/system/applications-system.png" />
				</a> 
				<a target="_blank" href="http://soporte.fipasoft.mx/">
				<img title="Soporte" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/system/help-browser.png" />
				</a>
				
				</span>
		</div>
	</div>
</div>
</body>
</html>