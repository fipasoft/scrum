$(document).ready(function() {
	if($("a.deleteStory").exists()) {
		$("a.deleteStory").each(function(){
			$(this).click(function() {
				if(!confirm('¿Seguro que desea eliminar la historia?')) {
					return false;
					
				}
			});
		}
		);
	}
});