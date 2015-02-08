$(document).ready(function() {
 


    $('#adicionarlibro').on( 'click', function () {    

        $.ajax({
        type: 'get',
        url: '../libros/get',
        data: {id: $("#codigo").val()},
        complete: function(data){
            
        },
        success: function (data) {
            console.log(data)
            //debugger;
            $('#librosprestamo tr').last().after('<tr><td>#</td><td>'+ data.user.nombre +'</td><td>----------</td><td>----------</td></tr>');
        },
        error: function(errors){
            console.log(errors)
        }
    });
    
         
    } );
 
    
} );