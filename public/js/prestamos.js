$(document).ready(function() {
  articulosPrestamo = [];


  $('#adicionararticulo').on( 'click', function () {         
    $.ajax({
        type: 'post',
        url: '../prestamos/buscarArticulo',
        data: {id: $("#codigo").val()},
        success: function (data) {

            CantidadPrestamo = jQuery.grep(articulosPrestamo, function(value) {
                return value == data.Libro.id;
            });

            if (CantidadPrestamo.length == 0){
                
                articulosPrestamo.push(data.Libro.id);

                $('#articulosprestamo tr').last().after(
                  '<tr id="row_'+ data.Libro.id +'">'+
                    '<td>'+ data.Libro.id +'</td>'+
                    '<td>'+ data.Libro.titulo +'</td>'+
                    '<td>'+ data.Libro.NombresAutores +'</td>'+
                    '<td><a class="elimPrestamo" id="'+ data.Libro.id +'"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                    '</tr>');
            }else{


                $('#alertaslibro .alert').html('Ya se agregó el Libro: ' + data.Libro.titulo );
                $('#alertaslibro .alert').addClass('alert-info');

                 setTimeout(function() {
                     $('#alertaslibro .alert').html('&nbsp;');
                     $('#alertaslibro .alert').removeClass('alert-info');
                 }, 3000);
            }

            $(".elimPrestamo").on('click', function () { 
                var thisId = $(this).attr('id');
                $("#row_" + thisId).remove();

                articulosPrestamo = jQuery.grep(articulosPrestamo, function(value) {                    
                            return value != thisId;
                        });

                $("#totalArticulos").text(articulosPrestamo.length);
            });

            $("#codigo").val("")
            $("#totalArticulos").text(articulosPrestamo.length)
            
        },

        error: function(errors){
            console.log(errors)
        }
    });     
  });
});