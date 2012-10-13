
<div id="loc_pais" class="localizacion_pais <?php echo $prefijo; ?> <?php echo $idElement; ?> row">
<label for="<?php echo $prefijo; ?>_Pais">Pa&iacute;s</label><br>
<select id="pais_id" class="lpais _opcional_" name="<?php echo $prefijo; ?>[pais_id]">
<option></option>
 			<?php foreach($paises as $p){ ?>
 				<option value="<?php echo $p->id ?>"
 				<?php if($p->id == $pais->id){ ?>
 					selected = "selected"
 				<?php } ?>
 				><?php echo $p->nombre; ?></option>
 			<?php } ?>
</select>
<div class="localizacion_estado <?php echo $prefijo; ?> <?php echo $idElement; ?> row"><br>

 		<label for="estado_id">Estado</label>
 		<br/>
 		<select id="estado_id" name="<?php echo $prefijo; ?>[estado_id]" class="lestado _opcional_">
 			<option></option>
 			<?php foreach($estados as $e){ ?>
 				<option value="<?php echo $e->id ?>"
 				<?php if($e->id == $edo->id){ ?>
 					selected = "selected"
 				<?php } ?>
 				><?php echo $e->nombre; ?></option>
 			<?php } ?>
 		</select>
 		<div class="loc_municipios <?php echo $prefijo; ?> <?php echo $idElement; ?> row">
 		<br/>
 		<label for="<?php echo $idElement; ?>">Municipio</label>
 		<br/>
 		<select id="<?php echo $idElement; ?>" name="<?php echo $prefijo; ?>[<?php echo $idElement; ?>]" class="lmunicipio _opcional_">
 			<option></option>
 			<?php foreach($municipios as $mun){ ?>
 				<option value="<?php echo $mun->id ?>"
 				<?php if($mun->id == $municipio->id){ ?>
 					selected = "selected"
 				<?php } ?>><?php echo $mun->nombre; ?></option>
 			<?php } ?>
 		</select>
 		</div>
 </div>
 </div>
 	