new function() {
	ws = null;
	var leyendo = false;

	var connectionStatus;
	var serverUrl;
	
	var iniciarLectura;
	var imagenEstado;
	var tagsLeidos = new Array();
	var xhr;
	var usuarioEncontrado;
		

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
                        if(!!data.identificacion){
							usuarioEncontrado = data;
                            ws = null;
                            connectionStatus.text('Leer Tag');
                            leyendo = false;
                            imagenEstado.attr("class" , "glyphicon glyphicon-play");
                            $('#txtIdentificacion').val(usuarioEncontrado.identificacion);
                            $('#btnBuscar').click();

                        }else{
							alert('Usuario no encontrado');
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

	WebSocketClient = {
		init: function() {
	
			serverUrl = 'ws://192.168.0.123:5555';
			connectionStatus = $('#connectionStatus');			
			iniciarLectura = $('#buscarTagUsuario');
			imagenEstado = $('#imagenEstado');

			iniciarLectura.click(function(e) {
				if(!leyendo){
					close();
					open();
				}else{
					ws.send('detenerLectura');
					close();					
				}
			});

		}
	};
}

$(function() {
	WebSocketClient.init();
});

$(window).unload(function() {
    if(!!ws){
        ws.send('detenerLectura');
        close();
    }
    return "Bye now!";
});