

$(document).ready(function(){



    var options = {
				keyboard : false,
				contentHeight : 400,
				contentWidth : 700,
				backdrop: 'static'
			};
    var wizard = $("#libros-wizard").wizard(options);
	
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
	        type: 'post',
	        url: '../libros',
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

