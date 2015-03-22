$(document).ready(function(){

	var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
			};
    wizard = $("#prestamos-wizard").wizard(options);

    wizard.show();


	wizard.on("submit", function(wizard) {
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


});