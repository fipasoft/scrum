<br/>
<?php if( count($estados) > 0){ ?>
<label for="<?php echo $prefijo; ?>_Estado">Estado</label><br/>
<select id="estado_id" class="lestado _opcional_" name="<?php echo $prefijo; ?>[estado_id]">
    <option></option>
    <?php foreach($estados as $e){ ?>
        <option value="<?php echo $e->id; ?>"><?php echo $e->nombre; ?></option>
    <?php } ?>
</select>
<div class="loc_municipios <?php echo $idElement; ?> row"></div>
<?php }else{ ?>
    <p><span class="false">No hay estados ligados al pa&iacute;s</span></p>
<?php } ?>