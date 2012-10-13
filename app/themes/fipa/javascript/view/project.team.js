function getElementos(table){
    var rowCount = $('#'+table.attr('id') + ' tr').length;
    
    var elementos = new Array();
    
    var cad = '<select class="l' + rowCount + ' user" id="user_l' + rowCount + '" name="user[]">'+$("#user_l1").html()+'</select>';
    elementos[0] = cad;
    
    var cad = '<select class="l' + rowCount + ' role" id="role_l' + rowCount + '" name="role[]">'+$("#role_l1").html()+'</select>';
    elementos[1] = cad;

    return elementos;
}

function addTableRow(table){
    // Number of td's in the last table row
    var n = $('tr:last td', table).length;
    var tds = '<tr>';
    var elementos = getElementos(table);
    for(var i = 0; i < n; i++){
        elemento = elementos[i];
        tds += '<td class="centrar">' + elemento + '</td>';
    }
    tds += '</tr>';
    if($('tbody', table).length > 0){
        $('tbody', table).append(tds);
    }else {
        $(table).append(tds);
    }
    
}

function delRow(){
    if($("#delRow").exists()){
        $("#delRow").attr("href","javascript:;");
            $("#delRow").bind('click', function(){
                var rowCount = $('#tabla tr').length;
               if(rowCount > 2){
                   if($('tbody', $(this)).length > 0){
                        $('#tabla tbody tr:last').remove();
                    }else {
                        $('#tabla tr:last').remove();
                    }
                }
            });
    }
}

function addRow(){
    if($("#addRow").exists()){
        $("#addRow").attr("href","javascript:;");
            $("#addRow").bind('click', function(){
               addTableRow($("#tabla"));
            });
    }
}



$(document).ready(function() {
    addRow();
    delRow();
});
