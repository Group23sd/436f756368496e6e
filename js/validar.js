<script type="text/javascript">
  function validar() {
    if (document.getElementById('pass').value - Math.floor(document.getElementById('pass').value) != 0 ) {
      alert("Codigo de seguridad invalido");
      return 0;
    }
    if ( (document.pagar.year.value) < (Date.getFullYear()) ) {
      alert("Tarjeta caducada");
      return 0;
    }


  }

</script>
