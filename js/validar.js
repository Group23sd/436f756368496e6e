<script type="text/javascript">
  function validar() {
    if (document.pagar.names.value.length == 0){
      alert("Debe ingresar su nombre");
      document.pagar.names.focus();
      return 0;
    }
    if (document.pagar.num.value.length == 0) {
      alert("Debe ingresar un numero de tarjeta");
      document.pagar.num.focus();
      return 0;
    }
    if (document.pagar.pass.value.length == 0) {
      alert("Debe ingresar un codigo de seguridad");
      document.pagar.pass.focus();
      return 0;
    }
    if (document.pagar.pass.value.length != 3) {
      alert("Debe ingresar tres numeros para el codigo de seguridad");
      document.pagar.pass.focus();
      return 0;
    }
    if (document.pagar.pass.value - Math.floor(document.pagar.pass.value) != 0 ) {
      alert("Codigo de seguridad invalido");
      document.pagar.pass.focus();
      return 0;
    }
    if ( (document.pagar.year.value) < (Date.getFullYear()) ) {
      alert("Tarjeta caducada");
      return 0;
    }


  }

</script>
