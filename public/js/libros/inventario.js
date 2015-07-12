

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

	wizard.cards["Adquisición"].on("validate", function(card) {
	    var cantidad = card.el.find("input")[2].value;
	
            
            getRows = function () {
                var id = 1,
                  rows = [];

                for (var i = 1; i <= cantidad; i++) {
                    rows.push({
                    	id: id,
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

	$('#cantidad').spinedit({
			minimum: 1,
			step: 1
	 });

	$('#fecha').datepicker({autoclose: true});

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
        return  formatoCantidadArticulos('totalArticulosDisponibles', 'info', value)
    }

 function enprestamoFormatter(value, row, index) {
        return  formatoCantidadArticulos('totalArticulosenPrestamo', 'danger', value) 
    }

 function totalFormatter(value, row, index) {
		return  formatoCantidadArticulos('totalArticulos', 'success', value)       
    }


function formatoCantidadArticulos(id, estilo, value){
	return [
            '<a class="like" href="javascript:void(0)" title="'+ value +'">',
                '<span id="'+ id +'" class="badge progress-bar-'+ estilo +'">'+ value +'</span>',
            '</a>'
        ].join('');
	}
 

 function tomoFormatter(value, row, index) {

    return '<input type="text" id="tomo'+ row.id +'" idEjemplar="'+ row.id +'"  name="tomo'+ row.id +'" class="form-control spinerTomo">';
}

    window.totalEvents = {
        'click .like': function (e, value, row, index) {
            alert('You click like icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);
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
                    '<a class="insertarejemplares" href="javascript:void(0)" title="Crear Ejemplar">',
                        '<i class="glyphicon glyphicon-plus"></i> Crear Ejemplar',
                    '</a>',
                 ' </li>',
                 	(row.ejemplares==0)?'<li><a class="remove" href="javascript:void(0)" title="Borrar"><i class="glyphicon glyphicon-trash"></i> Borrar</a></li>':' ',
                '</ul>',
            '</div>'
        ].join('');
    }

    window.operateEvents = {
        'click .insertarejemplares': function (e, value, row, index) {
        	wizard.setTitle('Adicionar Ejemplares de: ' + row.titulo);

            wizard.show();
        }       
    };