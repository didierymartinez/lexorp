$(document).ready(function() {
 
     prestamo = [];

    $('#adicionarlibro').on( 'click', function () {    

        

        $.ajax({
        type: 'get',
        url: '../libros/get',
        data: {id: $("#codigo").val()},
        complete: function(data){
            
        },
        success: function (data) {
            
            yaexiste = jQuery.grep(prestamo, function(value) {
                return value.id == data.libro.id;
            });

            if (yaexiste.length == 0){
                prestamo.push(data.libro);
                $('#librosprestamo tr').last().after('<tr><td>'+ $('#librosprestamo tr').length +'</td><td>'+ data.libro.id +'</td><td>'+ data.libro.nombre +'</td><td>'+ data.autor.nombres + ' ' +data.autor.apellidos +'</td><td><a data-toggle="tab" href="#settings"><span class="glyphicon glyphicon-trash"></span></a></td></tr>');
            }else{
                $('.container .alert').alert('close');

                $('.container').prepend(
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
        },

        error: function(errors){
            console.log(errors)
        }
    });
    
         
    } );
 
    
} );