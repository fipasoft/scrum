(function($) {
    // person class
    var Revisa = $.Class.create({
        // constructor
        initialize : function(recipiente,tipo) {
            this.recipiente = recipiente;
            this.tipo = tipo;
            this.register();
        },
        // methods
        ClassName : function() {
            return 'Revisa';
        },
        
        register: function(){
        	var obj = this;
        	obj.llamada();
        	var txt = $(this.recipiente).find('input.elemento');
        	txt.keyup( function() {
                obj.llamada();
            });
        },
    
	    llamada: function(){
        	var obj = this;
        	var txt = $(this.recipiente).find('input.elemento');

        	if( txt.val()!='' ){
        		if($(this.recipiente).find('input.valido').val() != txt.val()){
		        	var vista = $(this.recipiente).cssClass('getByIndex',1);
		        	var tbl = $(this.recipiente).cssClass('getByIndex',2);
		        	var cmp = $(this.recipiente).cssClass('getByIndex',3);
		        	$(obj.recipiente).find('div.recipiente').html('<img src="' + $('#YIIthemeUrl').val() + 'img/system/spin.gif" />');
		        	$.get($('#YIIbaseUrl').val() + 'revisa/' + vista, { tabla: tbl, campo: cmp, valor: txt.val()},
	                function(data) {
	                  $(obj.recipiente).find('div.recipiente').html(data); 
		        	});
        		}else{
	                  $(obj.recipiente).find('div.recipiente').html('<input type="hidden" id="disponible" name="disponible" value="1" /><span class="true">Disponible</span>');
        		}
        	}else{
                $(obj.recipiente).find('div.recipiente').html("");
        		
        	}
	    },

    }, {
        // properties
        getset : [],
        recipiente: null,
        tipo:null
    });
    
    var methods = {
        init : function(tipo, options) {
            
        },
        revisa : function(options) {
            return this.each(function() {
                var revisa = new Revisa($(this),'revisa');
            });
        }
    };

    //Funciones

    $.fn.revisa = function(method) {

        // Method calling logic
        if(methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if( typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.localizacion');
        }

    };
})(jQuery);

$(document).ready(function() {
    $( 'div.revisa' ).revisa('revisa');
    
});