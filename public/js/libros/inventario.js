

$(document).ready(function(){

    var options = {
				keyboard : false,
				contentHeight : 600,
				contentWidth : 900,
				backdrop: 'static'
			};

    wizard = $("#libros-wizard").wizard(options);
	
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
		var adquisicion = wizard.cards["Adquisición"].serializeObject();
		var items = $('#table-ejemplares').bootstrapTable('getData');
	    

	    
	    $.ajax({
	        type:  'POST',
	        url:  '../inventario',
	        dataType: 'json',
	        data: {"adquisicion":JSON.stringify(adquisicion),"items":JSON.stringify(items)},
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
	        url: '../inventario'
	    });	
	});

	wizard.el.find(".wizard-success .create-another-server").click(function() {
		wizard.reset();
	});

	wizard.cards["Adquisición"].on("validate", function(card) {
	    var cantidad = $('#Cantidad').val();
	    var idArticulo = $('#idArticulo').val();
	
            getRows = function () {
                var id = 1,
                  rows = [];

                for (var i = 1; i <= cantidad; i++) {
                    rows.push({
                    	id: id,
                    	articulo_id: idArticulo,  
                    	estado_id: 1,
                        tomo: 1,
                        observaciones: ''
                    });
                    id++;
                }
                return rows;
            },        
            $table = $('#table-ejemplares').bootstrapTable({
                data: []
            });


            $table.bootstrapTable('load', getRows());

	    if ($table) {       
	    	$('#totalArticulosNuevos').text(cantidad);

			$('input[id^="observaciones"]').on('blur', function(e){
				$table.bootstrapTable('getData')[$(this).attr('idEjemplarObs') - 1].observaciones = this.value; 
			})

			$('.spinerTomo').spinedit({
				minimum: 1,
				step: 1
		 	})
		 	.css('border-color', 'white')
		 	.on("valueChanged", function(e) {			  
				$table.bootstrapTable('getData')[$(this).attr('idEjemplar') - 1].tomo = e.value; 
			});



	    	return true;
	    }
	    

	});

	$(".chzn-select").chosen({allow_single_deselect: true});

	$('#Cantidad').spinedit({
			minimum: 1,
			step: 1
	 });

	$('#Fecha').datepicker({autoclose: true});



;
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




 function disponiblesFormatter(value, row, index) {
        return  formatoCantidadArticulos('totalArticulosDisponibles', 'Disponibles', 'disponibles', 'info', value)
    }

 function enprestamoFormatter(value, row, index) {
        return  formatoCantidadArticulos('totalArticulosenPrestamo', 'En Prestamo', 'enprestamo', 'danger', value) 
    }

 function totalFormatter(value, row, index) {
		return  formatoCantidadArticulos('totalArticulos', 'Total Ejemplares', 'total', 'success', value)       
    }


function formatoCantidadArticulos(id, titulo, estado, estilo, value){
	return [
            '<a class="like" href="javascript:void(0)" title="'+ value +'" >',
                '<span id="'+ id +'" titulo="'+ titulo +'" estado="'+ estado +'" class="badge progress-bar-'+ estilo +'">'+ value +'</span>',
            '</a>'
        ].join('');
	}
 

 function tomoFormatter(value, row, index) {

    return '<input type="text" id="tomo'+ row.id +'" idEjemplar="'+ row.id +'"  name="tomo'+ row.id +'" class="form-control spinerTomo"  data-serialize="1">';
}

 function observacionesFormatter(value, row, index) {

    return '<input type="text" id="observaciones'+ row.id +'" name="observaciones'+ row.id +'" idEjemplarObs="'+ row.id +'" class="form-control"  data-serialize="1">';
}

    window.totalEvents = {
        'click .like': function (e, value, row, index) {
            console.log(e, value, row, index);
            
            $('#myModalLabel').html( '<span class="'+ $(e.toElement).attr("class") +' "><h5>' + $(e.toElement).attr("titulo") + '</h5></span>' + ' ' +row.titulo);
            

            $('#myModal').modal('toggle');

            $('#table-javascript').bootstrapTable('destroy');

            $('#table-javascript').bootstrapTable({
                method: 'POST',
                url: '/inventario/buscarXestado?idLibro=' + row.id + '&idEstado=' + $(e.toElement).attr("estado") + '',
                cache: false,
                height: 400,
                striped: true,
                pagination: true,
                pageSize: 50,
                pageList: [10, 25, 50, 100, 200],
                search: true,
                showColumns: true,
                showRefresh: true,
                minimumCountColumns: 2,
                clickToSelect: true,
                columns: [
                {
                    field: 'id',
                    title: 'ID',
                    sortable: true
                }, {
                    field: 'placa',
                    title: 'Placa',
                    sortable: true
                }, {
                    field: 'tomo',
                    title: 'Tomo',
                    sortable: true
                }, {
                    field: 'observaciones',
                    title: 'Observaciones',
                    sortable: true
                }]
            });
        }
    };

    function operateFormatter(value, row, index) {

        return [
            '<div class="btn-group btn-group-xs" role="group">',
                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">',
                  '<i class="glyphicon glyphicon-cog"></i>',          
                '</button>',
                '<ul class="dropdown-menu" role="menu">',
                  '<li>',
                    '<a class="insertarejemplares" href="javascript:void(0)" title="Crear Ejemplares">',
                        '<i class="glyphicon glyphicon-plus"></i> Crear Ejemplares',
                    '</a>',
                 ' </li>',                 	
                '</ul>',
            '</div>'
        ].join('');
    }

    window.operateEvents = {
        'click .insertarejemplares': function (e, value, row, index) {
        	wizard.setTitle('Adicionar Ejemplares de: ' + row.titulo);
        	$('#idArticulo').val(row.id);
            wizard.show();
        }       
    };