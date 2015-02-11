$(document).ready(function() {
  articulosPrestamo = [];



  $('#pretamoGuardar').on( 'click', function () {  
    $.ajax({
        type: 'post',
        url: '../prestamos',
        dataType: 'json',
        data: {librosprestamo:JSON.stringify(articulosPrestamo)},
        success: function (data) {
          console.log('ready');
        }
    });
  });

  $('#adicionarlibro').on( 'click', function () {         
    $.ajax({
        type: 'get',
        url: '../libros/get',
        data: {id: $("#codigo").val()},
        success: function (data) {
            
            CantidadPrestamo = jQuery.grep(articulosPrestamo, function(value) {
                return value.id == data.libro.id;
            });

            if (CantidadPrestamo.length == 0){
                articulosPrestamo.push(data.libro);
                $('#librosprestamo tr').last().after(
                  '<tr id="row_'+ data.libro.id +'">'+
                    '<td>'+ data.libro.id +'</td>'+
                    '<td>'+ data.libro.nombre +'</td>'+
                    '<td>'+ data.autor.nombres + ' ' +data.autor.apellidos +'</td>'+
                    '<td><a class="elimPrestamo" id="'+ data.libro.id +'"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                    '</tr>');
            }else{
                $('.container .alert').alert('close');

                $('#alertas').prepend(
                    '<div class="alert alert-warning alert-dismissable">'+
                    '<button type="button" class="close" ' + 
                    'data-dismiss="alert" aria-hidden="true">' + 
                    '&times;' + 
                    '</button>' + 
                    'Ya se agregó el libro: ' + data.libro.nombre + 
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
                $("#totalLibros").text(articulosPrestamo.length);
            });

            $("#codigo").val("")
            $("#totalLibros").text(articulosPrestamo.length)
            
        },

        error: function(errors){
            console.log(errors)
        }
    });     
  });
});