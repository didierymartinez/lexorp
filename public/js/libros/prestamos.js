$(document).ready(function(){

	var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
			};
	articulosPrestamo = [];
	 		
    wizard = $("#prestamos-wizard").wizard(options);

    wizard.show();


	wizard.on("submit", function(wizard) {
		$.ajax({
	        type: 'post',
	        url: '../prestamos',
	        dataType: 'json',
	        data: {"articulosprestamo":JSON.stringify(articulosPrestamo),"usuario":$('#idusuario').val()},
	        success: function (data) {
		        wizard.submitSuccess(); 
	            wizard.hideButtons(); 
	            wizard.updateProgressBar(0);
	        }
	    });	
	});


	wizard.el.find(".wizard-success .im-done").click(function() {
		wizard.hide();
		setTimeout(function() {
			wizard.reset();	
		}, 250);
		history.go(-1);
	});

	$('#adicionararticulo').on( 'click', function () {         
    $.ajax({
        type: 'post',
        url: '../prestamos/buscarArticulo',
        data: {id: $("#codigo").val()},
        success: function (data) {

            if(data.exito == 0){
              wizard.mensajes.show('danger',data.mensaje);
            }else{
                CantidadPrestamo = jQuery.grep(articulosPrestamo, function(value) {
                    return value == data.Libro.id;
                });

                if (CantidadPrestamo.length == 0){                  
                    var articulo = [data.Libro.id, data.Libro.fechadevolucion]                    
                    articulosPrestamo.push(articulo);

                    $('#articulosprestamo tr').last().after(
                      '<tr id="row_'+ data.Libro.id +'">'+
                        '<td>'+ data.Item.placa +'</td>'+
                        '<td>'+ data.Libro.titulo +'</td>'+
                        '<td>'+ data.Libro.fechadevolucion +'</td>'+
                        '<td><a class="elimPrestamo" id="'+ data.Libro.id +'"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                        '</tr>');

                    wizard.mensajes.show('success','Libro agregado: ' + data.Libro.titulo);
                     wizard.cards.seleccion.validate();
                }else{

                    wizard.mensajes.show('danger','Ya se agregó el Libro: ' + data.Libro.titulo);

                }

                $(".elimPrestamo").on('click', function () { 
                    var thisId = $(this).attr('id');
                    $("#row_" + thisId).remove();

                    articulosPrestamo = jQuery.grep(articulosPrestamo, function(value) {                    
                                return value[0] != thisId;
                            });

                    $("#totalArticulos").text(articulosPrestamo.length);
                    wizard.cards.seleccion.validate();
                });

                $("#codigo").val("")
                $("#totalArticulos").text(articulosPrestamo.length)
            }
        },

        error: function(errors){
            console.log(errors)
        }
    });     
  });

   $('#codigo').on('keyup', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#adicionararticulo').click();
        }
    });

   wizard.mensajes = (function() {
        var that = {};        
        that.show = function(type, text) {
            $('.alertaswizard .alert').html(text);
            $('.alertaswizard .alert').addClass('alert-' + type);
            setTimeout(function() {
                $('.alertaswizard .alert').html('&nbsp;');
                $('.alertaswizard .alert').removeClass('alert-' + type);
            }, 3000);
        };

        return that;
    }());

});

function tienelibros(el){	
	var retValue = {};
	retValue.msg = "Seleccionar libros";

	retValue.status = (!!articulosPrestamo.length);
	return retValue;
}
