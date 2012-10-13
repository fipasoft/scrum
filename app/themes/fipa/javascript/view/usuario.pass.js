function comparar(){
	if($('input.cmp1').exists()){
		var fld1 = $('input.cmp1')[0];
		var fld2 = $('input.cmp2')[0];
		if(fld1.value == '')
			return false;
		
		return fld1.value == fld2.value;
	}
	
	return false;

}

$(document).ready(function() {

	if($("#aceptar").exists()){
		$("#aceptar").unbind('click');
		
	    $("#aceptar").bind('click', function() {
	    	if(comparar()){
	    		$('#mcontra').attr('class','true');
	    		$('#mcontra').html("Contraseña correcta.");
	    		$('#comparacion').val('1');
		        if( $('#usuario-form').forma('verificarCampos')){
		    		
		            $('#usuario-form').submit();
		        }
	    	}else{
	    		$('#comparacion').val('');
	    		$('#mcontra').attr('class','false');
	    		$('#mcontra').html("La contraseña no coincide.");
	    	}
	    });
	}
});