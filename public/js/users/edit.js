$(function(){
    $('#select-project').on('change', seleccionProyecto);
});

function seleccionProyecto(){
    var project_id = $(this).val();
    // alert(project_id);

    if(! project_id)
        {
            $('#select-level').html('<option value="">Seleccionar nivel</option>');
            return;
        }
    //Usando AJAX, podemos mostrar los niveles de un proyecto:
    $.get('/api/proyecto/'+project_id+'/niveles', function(datos){
        // console.log(datos);
        var seleccionar_html ='<option value="">Seleccionar nivel</option>';
        for(var i=0; i<datos.length; i++)
            //console.log(datos[i]);
            seleccionar_html += '<option value="'+datos[i].id+'">'+datos[i].nombre+'</option>';
            //console.log(seleccionar_html);
            $('#select-level').html(seleccionar_html);
    }); 
}