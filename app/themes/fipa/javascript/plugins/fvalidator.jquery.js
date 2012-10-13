(function($) {
	// person class
	var Validations = $.Class.create({
		// constructor
		initialize : function() {
		},
		// methods
		ClassName : function() {
			return 'Validations';
		},
		esEntero : function(s) {	
			for(var i = 0; i < s.length; i++) {
				var c = s.charAt(i);
				if(!((c >= "0") && (c <= "9"))) {
					return false;
				}
			}
			return true;
		},
		validarEntero : function(campo) {
			if(!this.esEntero(campo.val())) {
				campo.effect("shake", {
					times : 3
				}, 300);
				campo.val('');
				campo.focus();
			}
		},
		esHora : function(s) {	
			return /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(s);
		},
		validarHora : function(campo) {
			if(!this.esHora(campo.val())) {
				campo.effect("shake", {
					times : 3
				}, 300);
				campo.val('');
				campo.focus();
			}
		},
		// Validar cantidad
		esReal : function(campo) {
			decimales = 2;  // cantidad de decimales
			pass = true;
			if(campo.val() != ''){
				campo.val(campo.val().replace(/,/gi,""));
				if (isNaN(campo.val())){
					//alert("El formato valido para cantidades solo acepta numeros sin comas y dos decimales delimitados por un punto\n123456.78");
					campo.select();
					campo.focus();
					campo.val('');
					pass = false;
				}else{
					if (campo.val().indexOf('.') == -1) campo.val(campo.val() + ".");
						dectext = campo.val().substring(campo.val().indexOf('.')+1, campo.val().length);
					if (dectext.length > decimales){
						//alert ("La cantidad debe tener un maximo de 2 decimales.");
						campo.select();
						campo.value='';
						campo.focus();
						pass = false;
					}else{
						var j = 0;
						for(j=dectext.length; j<2; j++)
							campo.val(campo.val() + "0" );
						//campo.val() = campo.val();
					}

					var numeros = campo.val().split(".");
					var numero = numeros[0];
					numero = trim(numero); 
					var c = 1;
					var nnumero="";
					for (i=numero.length-1;i>=0;i--) {
						nnumero = numero.charAt(i) + nnumero;
						if(c==3){
					    	c = 0;
					    	if(i>0){
					    		nnumero = "," + nnumero;
					    	}
					    }
						c++;
					} 
					
					campo.val(nnumero + "." + numeros[1]);
					
				}
			}
			return pass;
		},
		validarReal : function(campo) {
			if(!this.esReal(campo)) {
				campo.effect("shake", {
					times : 3
				}, 300);
				campo.val('');
				campo.focus();
			}
		}
	}, {
		// properties
		getset : []
	});

	var methods = {
		init : function(options) {
			var validations = new Validations();
			return this.each(function() {
				var $this = $(this);
				$this.find("input.entero").each(function() {
					
					$(this).blur(function() {
						validations.validarEntero($(this));	
					})
				});
				
				$this.find("input.hora").each(function() {
					
					$(this).blur(function() {
						validations.validarHora($(this));	
					})
				});
				
				$this.find("input.real").each(function() {
					$(this).blur(function() {
						validations.validarReal($(this));	
					})
				});
			});
		}
	};

	//Funciones

	$.fn.fvalidator = function(method) {

		// Method calling logic
		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if( typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.tblSincro');
		}

	};
})(jQuery);
