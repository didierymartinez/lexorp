$(document).ready(function() {
  articulosPrestamo = [];

  $('#prestamoGuardar').on( 'click', function () {  
    $.ajax({
        type: 'post',
        url: '../prestamos',
        dataType: 'json',
        data: {"articulosprestamo":JSON.stringify(articulosPrestamo),"usuario":$('#idusuario').val()},
        success: function (data) {
          console.log('ready');
        }
    });
  });


  $('#adicionararticulo').on( 'click', function () {         
    $.ajax({
        type: 'post',
        url: '../prestamos/buscarArticulo',
        data: {id: $("#codigo").val()},
        success: function (data) {

            
            CantidadPrestamo = jQuery.grep(articulosPrestamo, function(value) {
                return value.id == data.Libro.id;
            });

            if (CantidadPrestamo.length == 0){
                articulosPrestamo.push(data.Libro);
                $('#articulosprestamo tr').last().after(
                  '<tr id="row_'+ data.Libro.id +'">'+
                    '<td>'+ data.Libro.id +'</td>'+
                    '<td>'+ data.Libro.nombre +'</td>'+
                    '<td>'+ data.autor.nombres + ' ' +data.autor.apellidos +'</td>'+
                    '<td><a class="elimPrestamo" id="'+ data.Libro.id +'"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                    '</tr>');
            }else{
                $('.container .alert').alert('close');

                $('#alertas').prepend(
                    '<div class="alert alert-warning alert-dismissable">'+
                    '<button type="button" class="close" ' + 
                    'data-dismiss="alert" aria-hidden="true">' + 
                    '&times;' + 
                    '</button>' + 
                    'Ya se agregó el Libro: ' + data.Libro.nombre + 
                    '</div>'
                );

                 setTimeout(function() {
                     $('.container .alert').alert('close');
                 }, 3000);
            }

            $(".elimPrestamo").on('click', function () { 
                var thisId = $(this).attr('id');
                $("#row_" + thisId).remove();

                articulosPrestamo = jQuery.grep(articulosPrestamo, function(value) {
                            return value.id != thisId;
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