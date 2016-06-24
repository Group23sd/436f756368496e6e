$(document).on("click", "#confirmEjemplo", function(e) {
    bootbox.confirm("Está seguro que desea continuar con el ejemplo?", function(result) {
      if (result) {window.location = $(document).find('#confirmEjemplo').attr('data-href');}
    });
});
