(function($) {

	var methods = {
		cancelar : function() {
			cancelar = $("#cancelar");
			if(cancelar.exists()) {
				cancelar.click(function() {
					if(confirm('Al cancelar se perderan los cambios hechos en este formulario, ¿desea continuar?')) {
						document.location.href = $("#YIIbaseUrl").val() + $("#controller").val() + "/" + "index";
					}
				});
			}
		},

        tabs : function() {
            $(".auto-tabs").each(function(index) {
                $(this).tabs();
            });

        },
        		
		selectorCiclos : function() {
			if($('#cicloSel').exists() && $('#cicloBtn').exists()) {

				$('#cicloBtn').click(function() {
					$('#cicloSel').show();
					$('#cicloBtn').hide();
				});

				$('#cicloSel').change(function() {
					$('#frm_ciclo').submit();
				});
			}
		},
		
		busqueda : function() {
			if($('#btnBusqueda').exists()) {
				$('#btnBusqueda').attr("href", "javascript:;");
				$('#btnBusqueda').click(function() {
					$('#divBusqueda').slideToggle();
				});
			}

			if($('#btnQuitar').exists()) {
				$('#btnQuitar').attr("href", "javascript:;");
				$('#btnQuitar').click(function() {
					$("#formBusqueda input[type=text], #formBusqueda textarea, #formBusqueda select").val('');
					$("#formBusqueda").submit();
				});
			}

			if($('#btnLimpiar').exists()) {
				$('#btnLimpiar').attr("href", "javascript:;");
				$('#btnLimpiar').click(function() {
					$("#formBusqueda input[type=text], #formBusqueda textarea, #formBusqueda select").val('');
				});
			}
		},
		
		fecha : function() {
			$("input._fecha_").datepicker({
				dayNames : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				monthNames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				dayNamesMin : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
				dateFormat : 'dd/mm/yy'
			});
		},
		
		fechahora : function() {
			$("input._fechahora_").datetimepicker({
				dayNames : ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				monthNames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				dayNamesMin : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				dayNamesShort : ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
				timeOnlyTitle: 'Choose Time',
				timeText: 'Tiempo',
				hourText: 'Hora',
				minuteText: 'Мinutos',
				secondText: 'Segundos',
				currentText: 'Actual',
				closeText: 'Hecho',
				dateFormat : 'dd/mm/yy',
				timeFormat: 'hh:mm'
			});
		},
		
		colorbox: function(){
			$('.colorbox').colorbox({rel:'Imagen'});
		},
		
		fvalidator : function() {
			$(".fvalidator").fvalidator();
		},
		
		numeros : function(){
			$('input.real').blur(function(){

				   if(isNaN($(this).val()) || $(this).val().indexOf(".")<0){
					   $(this).effect("shake", { times:2 }, 150);
	                   $(this).val("");
				   } else {
				      if(!parseFloat($(this).val())) {
				    	  	 $(this).effect("shake", { times:2 }, 150);
		                     $(this).val("");
				          }
				   }
			});
			
			$('input.entero').blur(function(){
				 if(!($(this).val() % 1 == 0)){
                     $(this).effect("shake", { times:2 }, 150);
                     $(this).val("");
				 }
					
			});
		}
	};

	//Funciones

	$.fn.system = function(method) {

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

$(document).ready(function() {
    $(document.body).system('cancelar');
    $(document.body).system('selectorCiclos');
    $(document.body).system('busqueda');
    $(document.body).system('fecha');
    $(document.body).system('fechahora');
    $(document.body).system('fvalidator');
    $(document.body).system('colorbox');
    $(document.body).system('tabs');
    $(document.body).system('numeros');
    
    
    jQuery.extend({
       postJSON: function( url, data, callback) {
          return jQuery.post(url, data, callback, "json");
       }
    });
    
});


