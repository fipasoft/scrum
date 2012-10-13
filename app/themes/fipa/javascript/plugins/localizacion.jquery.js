(function($) {
    // person class
    var Localizacion = $.Class.create({
        // constructor
        initialize : function(recipiente,tipo) {
            this.recipiente = recipiente;
            this.tipo = tipo;
            this.register();
        },
        // methods
        ClassName : function() {
            return 'Localizacion';
        },
        register: function(){
        var obj = this;
        if( obj.recipiente != null ){
            if(obj.tipo == 'pais'){
                var lpais = obj.recipiente.find("select.lpais");
                
                lpais.change( function() {
                    if(lpais.val()!=""){
                    	var prf = $(obj.recipiente).cssClass('getByIndex',1);
                    	var idElem = $(obj.recipiente).cssClass('getByIndex',2);
                        $(obj.recipiente).find('div.localizacion_estado').html('<img src="' + $('#YIIthemeUrl').val() + 'img/system/spin.gif" />');
                        $.get($('#YIIbaseUrl').val() + 'localizacion/estados', { id: $(this).val(), prefijo: prf, idElement: idElem},
                           function(data) {
                             obj.recipiente.find('div.localizacion_estado').html(data);
                                if($('div.localizacion_estado #estado_id').exists()){
                                    $('div.localizacion_estado #estado_id').change (function (){
                                    	obj.municipios();      
                                    });
                                }
                        });
                 
                }else{
                    obj.recipiente.find('div.localizacion_estado').html("");
                    obj.recipiente.find('div.loc_municipios').html("");
                }
                });
            }else if(this.tipo == 'editar'){
            	        
            	var prf = $(obj.recipiente).cssClass('getByIndex',1);
            	var idElem = $(obj.recipiente).cssClass('getByIndex',2);
            	
            	$.get($('#YIIbaseUrl').val() + 'localizacion/editar', { id: $('#'+idElem).val(), prefijo: prf, idElement: idElem},
                        function(data) {
            			$(obj.recipiente).html(data);
            				if($(obj.recipiente).find('div.localizacion_estado #estado_id') && $(obj.recipiente).find("div.loc_municipios")){
            					$(obj.recipiente).find('div.localizacion_estado #estado_id').change(function (){
            					obj.municipios();
                                  
                              });
            				}
            				

                        	var lpais = $(obj.recipiente).find("select.lpais");
                            
                            lpais.change( function() {
                                if(lpais.val()!=""){
                                	var prf = $(obj.recipiente).cssClass('getByIndex',1);
                                	var idElem = $(obj.recipiente).cssClass('getByIndex',2);
                                    $(obj.recipiente).find('div.localizacion_estado').html('<img src="' + $('#YIIthemeUrl').val() + 'img/system/spin.gif" />');
                                    $.get($('#YIIbaseUrl').val() + 'localizacion/estados', { id: $(this).val(), prefijo: prf, idElement: idElem},
                                       function(data) {
                                         obj.recipiente.find('div.localizacion_estado').html(data);
                                            if($('div.localizacion_estado #estado_id').exists()){
                                                $('div.localizacion_estado #estado_id').change (function (){
                                                	obj.municipios();      
                                                });
                                            }
                                    });
                                }else{
                                    obj.recipiente.find('div.localizacion_estado').html("");
                                }
                            });
                        	
                     });
            	
            }else if(this.tipo == 'estado'){
            /*
            var prf = $(obj.recipiente).find('div.localizacion_estado').cssClass('getByIndex',1);
            var idElem = $(obj.recipiente).cssClass('getByIndex',2);
            new Ajax.Request(
                    $('KUMBIA_PATH').value + 'localizacion/estados',
                    {
                        method : 'post',
                        parameters : {
                            id : this.tipo,
                            prefijo: prf,
                            idElement: idElem
                        },
                        onLoading : function() {
                            $(this.recipiente).innerHTML = '<img src="' + $('KUMBIA_PATH').value + 'img/system/spin.gif" />';
                        }.bind(this),
                        onSuccess : function(transport) {
                            $(this.recipiente).innerHTML = transport.responseText;
                            if($('div.localizacion_estado #estado_id') && $("loc_municipios")){
                                $('div.localizacion_estado #estado_id').onchange = function (){
                                    this.municipios();      
                                }.bind(this);
                            }
                        }.bind(this)
                    }).bind(this);
                    */
            }
        }
    },
    
    municipios: function(){
        var obj = this;
        var lestado = obj.recipiente.find("div.localizacion_estado select.lestado");
        
        if(lestado.val()!=""){
        	var prf = $(obj.recipiente).find('div.localizacion_estado').cssClass('getByIndex',1);
        	var idElem = $(obj.recipiente).find('div.localizacion_estado').cssClass('getByIndex',2);
            $(obj.recipiente).find('div.localizacion_estado div.loc_municipios').html('<img src="' + $('#YIIthemeUrl').val() + 'img/system/spin.gif" />');
            $.get($('#YIIbaseUrl').val() + 'localizacion/municipios', { id: lestado.val(), prefijo: prf, idElement: idElem},
               function(data) {
                 obj.recipiente.find('div.localizacion_estado div.loc_municipios').html(data);
            });
     
	    }else{
            obj.recipiente.find('div.localizacion_estado div.loc_municipios').html("");
        }
        
    },
    

    estados: function(){
        var obj = this;
        var lestado = obj.recipiente.find("select.lpais");
        
        if(lestado.val()!=""){
        	var prf = $(obj.recipiente).find('div.localizacion_pais').cssClass('getByIndex',1);
        	var idElem = $(obj.recipiente).find('div.localizacion_pais').cssClass('getByIndex',2);
            $(obj.recipiente).find('div.localizacion_estado').html('<img src="' + $('#YIIthemeUrl').val() + 'img/system/spin.gif" />');
            $.get($('#YIIbaseUrl').val() + 'localizacion/estados', { id: lestado.val(), prefijo: prf, idElement: idElem},
               function(data) {
                 obj.recipiente.find('div.localizacion_estado').html(data);
            });
     
	    }
        
    }

    }, {
        // properties
        getset : [],
        recipiente: null,
        tipo:null
    });
    
    var methods = {
        init : function(tipo, options) {
            
        },
        pais : function(options) {
            return this.each(function() {
                var localizacion = new Localizacion($(this),'pais');
            });
        },
        editar : function(options) {
            return this.each(function() {
                var localizacion = new Localizacion($(this),'editar');
            });
        }
    };

    //Funciones

    $.fn.localizacion = function(method) {

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
    $( 'div.localizacion_pais' ).localizacion('pais');
    $( 'div.localizacion_editar' ).localizacion('editar')
    
});