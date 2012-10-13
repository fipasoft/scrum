(function($) {

    var methods = {
        getAll : function() {
            var classes = $(this).attr('class');
            classes = classes.split(" ");
            if($.isArray(classes))
                return classes;
            else
                return new Array();
        },
        
        first : function(){
            var classes = $(this).attr('class');
            classes = classes.split(" ");
            if($.isArray(classes) && classes.length > 0)
                return classes[0];
            else
                return "";
        },
        
        getByIndex : function(index){
            var classes = $(this).attr('class');
            classes = classes.split(" ");
            if($.isArray(classes) && classes.length > 0)
                return classes[index];
            else
                return "";
        }
    };

    //Funciones

    $.fn.cssClass = function(method) {

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
