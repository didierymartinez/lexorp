new function() {
	ws = null;
	var leyendo = false;

	var connectionStatus;
	var serverUrl;

	var iniciarLectura;
	var tagsLeidos = new Array();


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
			connectionStatus.text('Cerrando...');
			ws.close();
		}
	}


	var onOpen = function() {
		leyendo = true;
		connectionStatus.text('Conectado');
		ws.send('iniciarLectura');
		iniciarLectura.attr("src" , "../images/stop.jpg");
	};

	var onClose = function() {
		ws = null;
		connectionStatus.text('Cerrado');
		leyendo = false;
		iniciarLectura.attr("src" , "../images/play.jpg");

	};

	var onMessage = function(event) {
		var data = event.data;
		if(data == "ingreseComando"){
			connectionStatus.text('Lector listo...');
		}else if(data == "leyendoTags"){
					connectionStatus.text('Leyendo...');
					$(".progress-bar-striped").toggleClass("active");
				}
				else{
					lecturaTag(data);
				}
	};
	
	var onError = function(event) {
		alert(event.data);
	}
		
	var lecturaTag = function(data, type) {
		var tabla = $('#tagsLeidos');
		
		var buscarTag = tagsLeidos.find(function(tag){ return tag.epc == data});
			
		if(!!buscarTag){			
			++buscarTag.cant;
			$('#cant'+data).text(buscarTag.cant);
		}else{
			var tagNuevo = tagsLeidos.push({epc : data, cant : 1});
					
			var tr = $('<tr>');
			tr.append($('<td>').text(tagsLeidos.length));
			tr.append($('<td>').text(data));
			tr.append($('<td id=cant'+data+'>').text(tagNuevo.cant));
			
			tabla.append(tr);	
		}
		
		
		
		
	}

	WebSocketClient = {
		init: function() {

			serverUrl = 'ws://192.168.0.123:5555';
			connectionStatus = $('#connectionStatus');

			iniciarLectura = $('#inventarioetiquetas');

			iniciarLectura.click(function(e) {
				if(!leyendo){
					close();
					open();
				}else{
					ws.send('detenerLectura');
					close();
					$(".progress-bar-striped").toggleClass("active");
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