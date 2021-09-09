$(function(){
    $('#list-projects').on('change', seleccionarProyecto);
});

function seleccionarProyecto(){
    var project_id = $(this).val();
    location.href ='/seleccionar/proyecto/'+project_id;
}