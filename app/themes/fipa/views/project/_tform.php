
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=> array('class' => 'validar')
)); ?>
<div class="form fvalidator">
<fieldset>
<legend>Datos.</legend>
<div class="grid-view">
<table id="tabla" class = "items">
    <tr>
        <th>Persona</th>
        <th>Rol</th>
    </tr>
    <?php if( count($model->teams) > 0 ){ ?>
        <?php foreach($model->teams as $member){ ?>
	        <tr>
	        <td class="centrar">
	            <select name="user[]" id="user_l1" class="l1 user">
	                <?php $users = Users::DropDownListElements(); ?>
	                <?php foreach($users as $id=>$user){ ?>
	                    <?php if($user != "root" && $user != "Guest"){?>
	                        <option value="<?php echo $id; ?>"
	                        <?php if($member->users_id == $id){?> selected="selected" <?php } ?>
	                        >
	                            <?php echo $user; ?>
	                        </option>
	                    <?php } ?>
	                <?php } ?>
	            </select>
	        </td>
	        <td class="centrar">
	            <select name="role[]" id="role_l1" class="l1 role">
	                <?php $roles = Role::DropDownListElements(); ?>
	                <?php foreach($roles as $id=>$rol){ ?>
	                    <option value="<?php echo $id; ?>"
                            <?php if($member->role_id == $id){?> selected="selected" <?php } ?>
                            >
	                        <?php echo $rol; ?>
	                    </option>
	                <?php } ?>
	            </select>
	        
	        </td>
	    </tr>
    <?php } ?>
    <?php }else{ ?>
	    <tr>
	        <td class="centrar">
	            <select name="user[]" id="user_l1" class="l1 user">
	                <?php $users = Users::DropDownListElements(); ?>
	                <?php foreach($users as $id=>$user){ ?>
		                <?php if($user != "root" && $user != "Guest"){?>
		                    <option value="<?php echo $id; ?>">
		                        <?php echo $user; ?>
		                    </option>
		                <?php } ?>
	                <?php } ?>
	            </select>
	        </td>
	        <td class="centrar">
	            <select name="role[]" id="role_l1" class="l1 role">
	                <?php $roles = Role::DropDownListElements(); ?>
	                <?php foreach($roles as $id=>$rol){ ?>
	                    <option value="<?php echo $id; ?>">
	                        <?php echo $rol; ?>
	                    </option>
	                <?php } ?>
	            </select>
	        
	        </td>
	    </tr>
    <?php } ?>
</table>
    <div class="espacio"></div>
    <div class="derecha">
        <a id="addRow">
            <img src="<?php echo Yii::app()->theme->baseUrl.'/img/system/mas.png'?>" />
        </a> 
        <a id="delRow">
            <img src="<?php echo Yii::app()->theme->baseUrl.'/img/system/menos.png'?>" />
        </a>
    </div>
</div>
</fieldset>


    <div class="rowform buttons derecha">
        <?php echo CHtml::Button('Cancelar',array('id'=>'cancelar', 'class'=>'btnCancelar')); ?>
        <?php echo CHtml::Button($model->isNewRecord ? 'Agregar' : 'Guardar',array('id'=>'aceptar')); ?>
    </div>
    </div><!-- form -->
<?php $this->endWidget(); ?>
