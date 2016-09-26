var ws = null;

var tagsLeidos = [];
var xhr;
var usuarioEncontrado;
var inputTag;
var connectionStatus;
var imagenEstado;
var guardarBtn;
var btnActual;
var id;
var s;
var tiempoleyendo;
var tagLeido;

var guardarTag = function(idLibro){
    event.stopPropagation();
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url:  '../tags',
        dataType: 'json',
        data: {id: idLibro, tag: $('#tag'+idLibro).val()},
        success: function (data) {
            $('#guardarTag'+idLibro).css('color','silver');
            $('#connectionStatus' + idLibro).text(' Guardado');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);

        }
    });

}

var validaTag = function() {
    if(!xhr){

        xhr = $.ajax({
            type: 'GET',
            url:  '../tags/'+ tagLeido,
            dataType: 'json',
            success: function (data) {
                 if(!data){
                    inputTag.val(tagLeido);
                    guardarBtn.css('color','#f0ad4e');
                    tagLeido = null;
                 }else{
                    alert('Tag ya ha sido asignado');
                 }

                xhr = false;

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
                xhr = false;
            }
        });
    }
};

var Ant_onopen = function() {
    btnActual.css({'pointer-events': 'auto', 'color':'#333'});
    connectionStatus.text(' Conectado');
    ws.send('leer1tag');
    imagenEstado.attr("class" , "glyphicon glyphicon-stop");
};

var Ant_onClose = function() {
    ws = null;
    imagenEstado.attr("class" , "glyphicon glyphicon-play");
    tiempoleyendo.css('display', 'none');
    connectionStatus.text('');
    $('.glyphicon-play').css({'pointer-events': 'auto', 'color':'#333'});
    if(!!tagLeido){
        validaTag();
    }
};

var Ant_OnMensaje = function(event) {
    var data = event.data;

    switch (data){
        case "ingreseComando":
            connectionStatus.text(' Lector listo');
            break;
        case "leyendoTags":
            connectionStatus.text(' Leyendo');
            tiempoleyendo.css('display', 'block');
            break;
        default:
            tagLeido = data;
    }

};

var leerTags = function(btn, id){
    event.stopPropagation();
    event.preventDefault();
    $('.glyphicon-play,.glyphicon-stop').css({'pointer-events': 'none', 'color':'silver'});

    connectionStatus = $('#connectionStatus' + id);
    imagenEstado = $('#imagenEstado' + id);
    inputTag = $('#tag'+id);
    guardarBtn = $('#guardarTag'+id);
    btnActual = $(btn);
    tiempoleyendo = $('#carga'+id);

    id = id;
    var iniciar = function(){
        ws = new WebSocket('ws://192.168.0.123:5555');
        connectionStatus.text('Abriendo...');

        ws.onopen = Ant_onopen;
        ws.onclose = Ant_onClose;
        ws.onmessage = Ant_OnMensaje;
        ws.onerror = function(event) {
            alert("Error al intentar conectar el lector");
        };
    }


    if(!!ws){
        connectionStatus.text('Deteniendo..');
        ws.send('detenerLectura');
        ws.close();

    }else{
        iniciar();
    }

    return false;
}

$(document).ready(function () {



    var options = {
        keyboard: false,
        contentHeight: 600,
        contentWidth: 900,
        backdrop: 'static'
    };

    wizard = $("#libros-wizard").wizard(options);

    wizard.on('closed', function () {
        wizard.reset();
    });

    wizard.on("reset", function (wizard) {

        $.each(wizard.cards, function (name, card) {
            card.el.find("input").val('');
            $.each($(".search-choice-close"), function (idx, elementdelete) {
                $(elementdelete).click()
            });
            $(".search-choice-close").mouseup();
        });
    });

    wizard.on("submit", function (wizard) {
        var adquisicion = wizard.cards["Adquisición"].serializeObject();
        var items = $('#table-ejemplares').bootstrapTable('getData');



        $.ajax({
            type: 'POST',
            url: '../inventario',
            dataType: 'json',
            data: { "adquisicion": JSON.stringify(adquisicion), "items": JSON.stringify(items) },
            success: function (data) {
                setTimeout(function () {
                    wizard.trigger("success");
                    wizard.hideButtons();
                    wizard._submitting = false;
                    wizard.showSubmitCard("success");
                    wizard.updateProgressBar(0);
                }, 20);

            }
        });
    });

    wizard.el.find(".wizard-success .im-done").click(function () {
        wizard.hide();
        setTimeout(function () {
            wizard.reset();
        }, 250);
        $('#table-libros').bootstrapTable('refresh', {
            url: '../inventario'
        });
    });

    wizard.el.find(".wizard-success .create-another-server").click(function () {
        wizard.reset();
    });

    wizard.cards["Adquisición"].on("validate", function (card) {
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

            $('input[id^="observaciones"]').on('blur', function (e) {
                $table.bootstrapTable('getData')[$(this).attr('idEjemplarObs') - 1].observaciones = this.value;
            })

            $('.spinerTomo').spinedit({
                minimum: 1,
                step: 1
            })
		 	.css('border-color', 'white')
		 	.on("valueChanged", function (e) {
		 	    $table.bootstrapTable('getData')[$(this).attr('idEjemplar') - 1].tomo = e.value;
		 	});


            return true;
        }


    });

    $(".chzn-select").chosen({ allow_single_deselect: true });

    $('#Cantidad').spinedit({
        minimum: 1,
        step: 1
    });

    $('#Fecha').datepicker({ autoclose: true });

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




window.totalEvents = {
    'click .like': function (e, value, row, index) {
        var estado = $(e.target).attr("estado");

        $('#myModalLabel').html('<span class="' + $(e.target).attr("class") + ' "><h5>' + $(e.target).attr("titulo") + '</h5></span>' + ' ' + row.titulo);
        $('#myModal').modal('toggle');

        $('#table-javascript').bootstrapTable('destroy');

        $('#table-javascript').bootstrapTable({
            method: 'POST',
            url: '/inventario/buscarXestado?idLibro=' + row.id + '&idEstado=' + estado + '',
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
            columns: columnas(estado)
        });


    }
};

function columnas(estado) {
    var cols = [];
    cols.push({ field: 'id', title: 'ID', sortable: true });
    cols.push({ field: 'placa', title: 'Placa', sortable: true });
    cols.push({ field: 'tomo', title: 'Tomo', sortable: true });
    //cols.push({ field: 'observaciones', title: 'Observaciones', sortable: true });
    cols.push({ field: 'tag', title: 'Tag - EPC', sortable: true, formatter: tagFormatter });
    cols.push({ field: 'leertag', title: 'Actualizar', sortable: false, formatter: leerTagFormatter});
    if (estado == "total") {
        cols.push({ field: 'estado', title: 'Disponible', sortable: true, formatter: estadoFormatter });
    }
    return cols;
}


function disponiblesFormatter(value, row, index) {
    return formatoCantidadArticulos('totalArticulosDisponibles', 'Disponibles', 'disponibles', 'info', value)
}

function enprestamoFormatter(value, row, index) {
    return formatoCantidadArticulos('totalArticulosenPrestamo', 'En Prestamo', 'enprestamo', 'danger', value)
}

function totalFormatter(value, row, index) {
    return formatoCantidadArticulos('totalArticulos', 'Total Ejemplares', 'total', 'success', value)
}


function formatoCantidadArticulos(id, titulo, estado, estilo, value) {
    return [
                '<a class="like" href="javascript:void(0)" title="' + value + '" >',
                    '<span id="' + id + '" titulo="' + titulo + '" estado="' + estado + '" class="badge progress-bar-' + estilo + '">' + value + '</span>',
                '</a>'
            ].join('');
}


function tomoFormatter(value, row, index) {

    return '<input type="text" id="tomo' + row.id + '" idEjemplar="' + row.id + '"  name="tomo' + row.id + '" class="form-control spinerTomo"  data-serialize="1">';
}

function observacionesFormatter(value, row, index) {

    return '<input type="text" id="observaciones' + row.id + '" name="observaciones' + row.id + '" idEjemplarObs="' + row.id + '" class="form-control"  data-serialize="1">';
}

function tagFormatter(value, row, index) {

    return '<input type="text" id="tag' + row.id + '" name="tag' + row.id + ' idEjemplarObs="' + row.id + '" class="form-control epc" value="'+ row.epc +'"  data-serialize="1">';
}

function leerTagFormatter(value, row, index) {
        return '<span title="Leer desde Antena" style="padding-right: 10px;cursor:pointer;" class="glyphicon glyphicon-play" onclick="leerTags(this, '+ row.id + ')" id="imagenEstado'+  row.id +'"  aria-hidden="true"></span><span class="glyphicon glyphicon-floppy-save" title="Guardar" style="cursor:pointer;color: silver" onclick="guardarTag('+ row.id + ')" id="guardarTag'+  row.id +'"  aria-hidden="true"></span><span style="font-size: 12px" id="connectionStatus'+  row.id+'" > </span><div style="display: none;" id="carga'+ row.id +'" class="carga"></div>'


    //return '<input type="text" id="observaciones' + row.id + '" name="observaciones' + row.id + '" idEjemplarObs="' + row.id + '" class="form-control"  data-serialize="1">';
}

function estadoFormatter(value, row, index) {
    var estilo = (value == 'Disponible') ? 'info' : 'danger'
    return [
            '<span class="badge progress-bar-' + estilo + '"> </span>',
        ].join('');
}

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