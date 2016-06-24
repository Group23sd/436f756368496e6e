$(document).on("click", "#confirmEjemplo", function(e) {
    bootbox.confirm("Está seguro que desea continuar con el ejemplo?", function(result) {
      if (result) {window.location = $(document).find('#confirmEjemplo').attr('data-href');}
    });
});

$(document).on("click", "#deleteCouch", function(e) {
    bootbox.confirm("Está seguro que desea eliminar el couch?", function(result) {
      if (result) {window.location = $(document).find('#deleteCouch').attr('data-href');}
    });
});

$(document).on("click", "#changeCouchState", function(e) {
    bootbox.confirm("Está seguro que desea cambiar la visibilidad de este couch al publico?", function(result) {
      if (result) {window.location = $(document).find('#changeCouchState').attr('data-href');}
    });
});

$(document).on("click", "#rejectReserva", function(e) {
    bootbox.confirm("Esta seguro que desea rechazar esta reserva?", function(result) {
      if (result) {window.location = $(document).find('#rejectReserva').attr('data-href');}
    });
});
