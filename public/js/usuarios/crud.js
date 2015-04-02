

$(document).ready(function(){

    var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
			};
    wizard = $("#libros-wizard").wizard(options);
	
	$('#crearlibro').click(function(e) {
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
		var libroNuevo = this.serializeObject();
	    
	    $.ajax({
	        type: (!!libroNuevo[0].id) ? 'PUT'   : 'POST',
	        url:  (!!libroNuevo[0].id) ? '../libros/'+ libroNuevo[0].id   : '../libros',
	        dataType: 'json',
	        data: {"libroNuevo":JSON.stringify(libroNuevo)},
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
		$('#table-libros').bootstrapTable('refresh', {
	        url: '../libros'
	    });	
	});

	wizard.el.find(".wizard-success .create-another-server").click(function() {
		wizard.reset();
	});

	$(".chzn-select").chosen({allow_single_deselect: true});

	$('#anoedicion').spinedit({
			minimum: 1900,
			maximum: new Date().getFullYear(),
			step: 1
	 });


	$('#fechanacimiento').datepicker({
	    autoclose: true
	});

	$('.input-sm').css('font-size','15px')
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
};


    function operateFormatter(value, row, index) {
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
                    '<a class="remove" href="javascript:void(0)" title="Borrar">',
                        '<i class="glyphicon glyphicon-trash"></i> Borrar',
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

            $.each(row.autores, function(id, nombre){                    
              var sel = '.chzn-results li:contains("' +row.autores[id].nombres + ' ' + row.autores[id].apellidos + '")'
              $(sel).mouseup()
            });             
             
            $.each(wizard.el.find(".chzn-select:not([multiple=multiple])"), function(id, input){
               var valorseleccionado = 'option[value=' + row[input.name] + ']'              
               var sel = '.chzn-results li:contains("' + $(input).find(valorseleccionado).html() + '")'
              $(sel).mouseup() 
            });        
        
            wizard.show();

        },
        'click .remove': function (e, value, row, index) {
			bootbox.dialog({
			  message: "Se eliminará el libro <strong>" + row.titulo + "</strong> de <strong>" + row.NombresAutores +"</strong>",
			  title: "Está seguro que desea eliminar?",
			  buttons: {		    
			    danger: {
			      label: "Eliminar",
			      className: "btn-danger",
			      callback: function() {
					    $.ajax({
					        type: 'DELETE',
					        url:  '../libros/'+ row.id,
					        dataType: 'json',
					        data: {"libroEliminar":JSON.stringify(row)},
					        success: function (data) {
					        	$('#table-libros').bootstrapTable('refresh', {
							        url: '../libros'
							    });	
					          	mensajero.show('danger', 'Libro Eliminado')				            
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