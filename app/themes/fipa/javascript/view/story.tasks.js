$(document).ready(function() {
	if($("a.deleteTask").exists()) {
		$("a.deleteTask").each(function(){
			$(this).click(function() {
				if(!confirm('¿Seguro que desea eliminar la tarea?')) {
					return false;
					
				}
			});
		}
		);
	}
});