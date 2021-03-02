/* Inicializamos la función */
$(filtrar_producto());

$(document).on('click', '#order', function(){
    if ($('#general').children("option:selected").val()) 
    {
        var select_producto = $('#general').children("option:selected").val();
    }

    if ($('#precios').children("option:selected").val()) 
    {
        var select_producto = $('#precios').children("option:selected").val();
    }
    filtrar_producto(select_producto);
});
/* Ajax */
function filtrar_producto(producto) {
    $.ajax({
        url: 'orden.php',
        type: 'POST',
        dataType: 'html',
        data: {producto: producto},
    })

    .done(function(respuesta){
        $("#orden").html(respuesta);
    });
   }

/* Con esta función al pasar el raton por encima de la imagen se mostrará un cuadro con la información del producto */
$(function(){
  $('[data-toggle="popover"]').popover()
});