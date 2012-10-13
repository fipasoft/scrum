<br/>
<?php if( count($municipios) > 0){ ?>
<label for="<?php echo $idElement; ?>">Municipio</label><br/>
<select id="<?php echo $idElement; ?>" class="lmunicipio _opcional_" name="<?php echo $prefijo; ?>[<?php echo $idElement; ?>]">
    <option></option>
    <?php foreach($municipios as $m){ ?>
        <option value="<?php echo $m->id; ?>"><?php echo $m->nombre; ?></option>
    <?php } ?>
</select>
<?php }else{ ?>
    <p><span class="false">No hay municipios ligados al estado</span></p>
<?php } ?>