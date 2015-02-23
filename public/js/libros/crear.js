$(document).ready(function(){
    
    var options = {
				keyboard : false,
				contentHeight : 400,
				contentWidth : 700,
				backdrop: 'static'
			};
    var wizard = $("#satellite-wizard").wizard(options);
	
	$('#crearlibro').click(function(e) {
						e.preventDefault();
						wizard.show();
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

