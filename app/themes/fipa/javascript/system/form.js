(function($) {
var methods = {

    limpiar: function(){ //JQuery
        var $inputs = $('#' + $(this).attr('id')+ ' :input');
        $inputs.each(function() {
            if($(this).attr('type') != 'submit' && $(this).attr('type') != 'reset' && $(this).attr('type') != 'button'){
                $(this).val('');
                $(this).selectedIndex = 0;
            }
        });
    },

    verificar: function(){
        var pass = true;
       
        if( !$(this).forma('verificarCampos') ||
            !$(this).forma('verificarGrupos') ||
            !$(this).forma('verificarBloques')||
            !$(this).forma('verificarPeriodos')
        ){
            pass = false;
        }

        return pass;
    },
    
    
    verificarCampos: function(){ //JQuery
        var pass = true;
        // get all the inputs into an array.
        var $inputs = $('#' + $(this).attr('id')+ ' :input');
    
        $inputs.each(function() {
            if( $(this).val() == '' && !$(this).is(':disabled')  && !$(this).hasClass( '_opcional_' ) ){
                pass = false;
                try{
                    $(this).focus();
                    if( $(this).attr('type') == 'hidden' || !($(this).is(':visible') && $(this).parents(':hidden').length == 0)){
                        alert('Hay campos requeridos-ocultos por llenar');  
                    }else{
                        $(this).effect("shake", { times:2 }, 150);
                    }
                }catch(err){
                    alert('Faltan campos por llenar' + err);
                }
                return false;
            }
        });
        
        return pass;
    }
    
};

    //Funciones

    $.fn.forma = function(method) {
        if(($(this).get(0).tagName).toUpperCase() == "FORM"){
            // Method calling logic
            if(methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if( typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.tblSincro');
            }
        }

    };
})(jQuery);

$(document).ready(function() {
    if($("form.validar #aceptar").exists()){
        $("form.validar #aceptar").bind('click', function() {
            if( $('form.validar').forma('verificarCampos')){
            	$('form.validar').submit();
            }
        });
    }
});
