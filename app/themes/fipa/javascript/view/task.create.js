$(document).ready(function() {
	var cancelar = $("#cancelarV");
	if(cancelar.exists()) {
		cancelar.click(function() {
			if(confirm('Al cancelar se perderan los cambios hechos en este formulario, desea continuar?')) {
				document.location.href = $("#YIIbaseUrl").val() + "story/tasks/" + $("#story_id").val();
			}
		});
	}
});