$(document).ready(function(){

	var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
	};

	articulosDevolucion = [];
	 		
    wizard = $("#devoluciones-wizard").wizard(options);

    wizard.show();

	wizard.on("submit", function(wizard) {
		$.ajax({
	        type: 'post',
	        url: '../devoluciones',
	        dataType: 'json',
	        data: {"articulosdevolucion":JSON.stringify(articulosDevolucion)},
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

    $('#buscar1TagLibro').on( 'click', function () {
        leerTags();
    });

	$('#adicionararticulo').on( 'click', function () {
    $.ajax({
        type: 'post',
        url: '../devoluciones/buscarArticulo',
        data: {id: $("#codigo").val()},
        success: function (data) {

            if(data.exito == 0){

              wizard.mensajes.show('danger',data.mensaje);

            }else{

                CantidadPrestamo = jQuery.grep(articulosDevolucion, function(value) {
                    return value == data.Item.id;
                });

                if (CantidadPrestamo.length == 0){
                    
                    articulosDevolucion.push(data.Item.id);

                    $('#articulosDevolucion tr').last().after(
                      '<tr id="row_'+ data.Item.id +'">'+
                        '<td>'+ data.Item.placa +'</td>'+
                        '<td>'+ data.Libro.titulo +'</td>'+
                        '<td>'+ data.Libro.fechadevolucion +'</td>'+
                        '<td><a class="elimPrestamo" id="'+ data.Item.id +'"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                        '</tr>');

                    wizard.mensajes.show('success','Libro agregado: ' + data.Libro.titulo);
                     wizard.cards.seleccion.validate();
                }else{

                    wizard.mensajes.show('danger','Ya se agregó el Libro: ' + data.Libro.titulo);

                }

                $(".elimPrestamo").on('click', function () { 
                    var thisId = $(this).attr('id');
                    $("#row_" + thisId).remove();

                    articulosDevolucion = jQuery.grep(articulosDevolucion, function(value) {                    
                                return value != thisId;
                            });

                    $("#totalArticulos").text(articulosDevolucion.length);
                    wizard.cards.seleccion.validate();
                });

                $("#codigo").val("")
                $("#totalArticulos").text(articulosDevolucion.length)
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
          $('#alertaslibro .alert').html(text);
          $('#alertaslibro .alert').addClass('alert-' + type);

          setTimeout(function() {
           $('#alertaslibro .alert').html('&nbsp;');
           $('#alertaslibro .alert').removeClass('alert-' + type);
          }, 3000);
        };

        return that;
    }());

});

function tienelibros(el){	
	var retValue = {};
	retValue.msg = "Seleccionar libros";

	retValue.status = (!!articulosDevolucion.length);
	return retValue;
}



var leerTags = function(){
    ws = null;
    var leyendo = false;
    var connectionStatus;
    var serverUrl;
    var iniciarLectura;
    var imagenEstado;
    var tagsLeidos = new Array();
    var xhr;
    var usuarioEncontrado;

    serverUrl = 'ws://192.168.0.123:5555';
    connectionStatus = $('#connectionStatus');
    iniciarLectura = $('#buscarTagUsuario');
    imagenEstado = $('#imagenEstado');

    function checkAvailability(arr, val) {
        return arr.some(function(arrVal) {
            return val === arrVal;
        });
    }

    var open = function() {
        ws = new WebSocket(serverUrl);
        ws.onopen = onOpen;
        ws.onclose = onClose;
        ws.onmessage = onMessage;
        ws.onerror = onError;

        connectionStatus.text('Abriendo...');


    }

    var close = function() {
        if (!!ws) {
            connectionStatus.text('Leer Tag');
            leyendo = false;
            imagenEstado.attr("class" , "glyphicon glyphicon-play");
            ws.close();
        }
    }


    var onOpen = function() {
        leyendo = true;
        connectionStatus.text('Conectado');
        ws.send('iniciarLectura');
        imagenEstado.attr("class" , "glyphicon glyphicon-stop");
    };

    var onClose = function() {
        ws = null;
    };

    var onMessage = function(event) {
        var data = event.data;
        if(data == "ingreseComando"){
            connectionStatus.text('Lector listo...');
        }else if(data == "leyendoTags"){
            connectionStatus.text('Acerque el Tag al lector...');
            $(".progress-bar-striped").toggleClass("active");
        }
        else{
            if(!tagsLeidos.find(function(tag){ return tag.epc == data})){
                tagsLeidos.push({epc : data});
                if(ws.readyState == 1){
                    ws.send('detenerLectura');
                    lecturaTag(data);
                }
            }
        }
    };

    var onError = function(event) {
        alert("Error al intentar conectar el lector");
    }

    var lecturaTag = function(data, type) {

        if(!xhr){

            xhr = $.ajax({
                type: 'GET',
                url:  '../tags/'+ data,
                dataType: 'json',
                success: function (data) {
                    close();
                    if(!!data.placa){
                        usuarioEncontrado = data;
                        ws = null;
                        connectionStatus.text('Leer Tag');
                        leyendo = false;
                        imagenEstado.attr("class" , "glyphicon glyphicon-play");
                        $('#codigo').val(usuarioEncontrado.placa);
                        $('#adicionararticulo').click();

                    }else{
                        alert('Libro no encontrado');
                    }
                    xhr = false;
                    tagsLeidos = [];

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    ws.close();
                    alert(xhr.responseText);
                    xhr = false;
                }
            });
        }

    }

    if(!leyendo){
        close();
        open();
    }else{
        ws.send('detenerLectura');
        close();
    }
}

