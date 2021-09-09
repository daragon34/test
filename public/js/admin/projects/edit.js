$(function(){
    $('[data-category]').on('click',editarCategoriaModal);
    $('[data-level]').on('click',editarNivelModal);
});

function editarCategoriaModal(){
    //Para el id de la categoría:
    var category_id = $(this).data('category');   //alert(category_id);  
    $('#category_id').val(category_id);

    //Para el nombre de la catagoría:
    var category_nombre = $(this).parent().prev().prev().text();
    //alert(category_nombre);
    $('#category_nombre').val(category_nombre);
    
    //Para la descripción de la catagoría:
    var category_descripcion = $(this).parent().prev().text();
    //alert(category_descripcion);
    $('#category_descripcion').val(category_descripcion);

    //Para mostrar el modal:
    $('#editarCategoria').modal('show');
}

function editarNivelModal(){
    //Para el id
    var level_id = $(this).data('level');   //alert(level_id);  
    $('#level_id').val(level_id);

    //Para el nombre de la catagoría:
    var level_nombre = $(this).parent().prev().text();
    //alert(level_nombre);
    $('#level_nombre').val(level_nombre);

    //Para mostrar el modal:
    $('#editarNivel').modal('show');
}