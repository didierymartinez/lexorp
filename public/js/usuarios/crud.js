$(document).ready(function(){

    var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
			};

    wizard = $("#usuarios-wizard").wizard(options);
	
	$('#crearusuario').click(function(e) {
						e.preventDefault();
						wizard.show();
	});	

	wizard.on('closed', function() {
		wizard.reset();
	});

	wizard.on("reset", function(wizard) {		
	    $.each(wizard.cards, function(name, card) {
	        card.el.find("input").val('');
	        $.each($(".search-choice-close"), function(idx, elementdelete) {	
			  	$(elementdelete).click()
		    });
	        $(".search-choice-close").mouseup();
	    });
	});

	wizard.on("submit", function(wizard) {
		var usuarioNuevo = this.serializeObject();
	    
	    $.ajax({
	        type: (!!usuarioNuevo[0].id) ? 'PUT'   : 'POST',
	        url:  (!!usuarioNuevo[0].id) ? '../usuariosbiblioteca/'+ usuarioNuevo[0].id   : '../usuariosbiblioteca',
	        dataType: 'json',
	        data: {"usuarioNuevo":JSON.stringify(usuarioNuevo)},
	        success: function (data) {
	          		setTimeout(function() {
						wizard.trigger("success");
						wizard.hideButtons();
						wizard._submitting = false;
						wizard.showSubmitCard("success");
						wizard.updateProgressBar(0);
					}, 20);            
	        }
	    });

	});

	wizard.el.find(".wizard-success .im-done").click(function() {
		wizard.hide();
		setTimeout(function() {
			wizard.reset();	
		}, 250);
		$('#table-usuarios').bootstrapTable('refresh', {
	        url: '../usuariosbiblioteca'
	    });	
	});

	wizard.el.find(".wizard-success .create-another-server").click(function() {
		wizard.reset();
	});

	$(".chzn-select").chosen({allow_single_deselect: true});

	$('#fecha_nacimiento').datepicker({autoclose: true});

	$('.input-sm').css('font-size','15px');

	$('#identificacion').on('blur', function(){		
		var id = $('#id').val();

			$.ajax({
		        type: 'GET',
		        url:  '../usuariosbiblioteca/'+ this.value,
		        dataType: 'json',
		        data: {"idUsuario": JSON.stringify(id)},
		        success: function (data) {
		        	if(data.error == '1'){
			        	wizard.mensajes.show('danger', data.mensaje);
			        	$('#identificacion').focus(); 

							var retValue = {};
								retValue.status = false;
								retValue.msg = "Dato Requerido";

							return retValue;           
		      		}
		        },
		        error: function (xhr, ajaxOptions, thrownError) {
			        alert(xhr.responseText);
			    }
		    });	
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


function Requerido(el) {
	var name = el.val();
	var retValue = {};

	name = name || "";

	if (name == "" || (name == "0")) {
		retValue.status = false;
		retValue.msg = "Dato Requerido";
	} else {
		retValue.status = true;
	}

	return retValue;
}

	function rowStyle(row, index) {
        
        if (row.activo=='No') {
            return {
                classes: 'danger'
            };
        }
        return {};
    }

    function operateFormatter(value, row, index) {

    	var estado = {};
    	estado.mensaje = (row.activo=='Si') ? 'Inactivar' : 'Activar';
    	estado.icono = (row.activo=='Si') ? 'close' : 'open';

        return [
            '<div class="btn-group btn-group-xs" role="group">',
                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">',
                  '<i class="glyphicon glyphicon-cog"></i>',          
                '</button>',
                '<ul class="dropdown-menu" role="menu">',
                  '<li>',
                    '<a class="edit" href="javascript:void(0)" title="Editar">',
                        '<i class="glyphicon glyphicon-pencil"></i> Editar',
                    '</a>',
                 ' </li>',
                 '<li>',
                    '<a class="remove" href="javascript:void(0)" title="Inactivar">',
                        '<i class="glyphicon glyphicon-eye-'+ estado.icono +'"></i> '+ estado.mensaje ,
                    '</a>',
                 ' </li>',
                '</ul>',
            '</div>'
        ].join('');
    }

    window.operateEvents = {

        'click .edit': function (e, value, row, index) {
                                  
            $.each(wizard.el.find("input"), function(id, input){
              $(input).val(row[input.id])
            });
  			
            $.each(wizard.el.find(".chzn-select:not([multiple=multiple])"), function(id, input){
               var valorseleccionado = 'option[value=' + row[input.name] + ']'              
               var sel = '.chzn-results li:contains("' + $(input).find(valorseleccionado).html() + '")'
              $(sel).mouseup() 
            });  

            
        
            wizard.show();

        },
        'click .remove': function (e, value, row, index) {
        	var estado = {};
	    	estado.mensaje = (row.activo=='Si') ? 'Usuario Inactivo' : 'Usuario Activo';
	    	estado.label = (row.activo=='Si') ? 'Inactivar' : 'Activar';
	    	estado.icono = (row.activo=='Si') ? 'danger' : 'success';

			bootbox.dialog({
			  message: 'Se va a '+ estado.label +' el usuario <strong>' + row.NombreCompleto + '</strong>',
			  title: 'Está seguro que desea ' + estado.label + '?',
			  buttons: {		    
			    danger: {
			      label: estado.label,
			      className: "btn-"+estado.icono,
			      callback: function() {
					    $.ajax({
					        type: 'DELETE',
					        url:  '../usuariosbiblioteca/'+ row.id,
					        dataType: 'json',					        
					        success: function (data) {
					        	$('#table-usuarios').bootstrapTable('refresh', {
							        url: '../usuariosbiblioteca'
							    });	
					          	mensajero.show(estado.icono, estado.mensaje)				            
					        }
					    });			      				        
			      }
			    },
			    main: {
			      label: "Cancelar",
			      className: "btn-default",
			      callback: function() {
			        return;
			      }
			    }
			  }
			});
            
        }
    };