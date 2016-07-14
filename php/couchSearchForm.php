
<div class="col-md-4 couchSearchForm-container" id="couchSearchFormContainer" data-spy="affix" data-offset-top="200" data-offset-bottom="200">
    <div class="row couchSearchForm">

        <form class="form-block" role="form" data-toggle="validator" action="#searchResult" method="post" name="couchSearchForm" id="couchSearchForm">

            <div class="form-group">
            <label for="couchCountry" class="couchSearchFormLabel">Ad&oacute;nde vas?</label>
            <div class="form-group has-feedback has-warning">
                <label for="couchCountry" class="sr-only">Pais</label>
                <select class="form-control" name="formCountry" id="formCountry" data-error="Seleccione un pais!" onchange="showCities()">
                    <option selected hidden value>Pais</option>
                    <?php
                        $query = "SELECT p.idpais, p.nombre FROM pais p";
                        $result = queryAllByAssoc($query);
                        foreach ($result as $row) {
                            echo "<option value=".$row['idpais'].">".$row['nombre']."</option>";
                        }
                    ?>
                </select>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback has-warning">
                <label for="couchCity" class="sr-only">Ciudad</label>
                <select class="form-control" name="formCity" id="formCity" data-error="Seleccione una ciudad!">
                    <option selected hidden value>Ciudad</option>
                </select>                <div class="help-block with-errors"></div>
            </div>
            </div>

            <hr class="couchSearchFormHr">

            <div class="form-group has-feedback has-success">
                <label for="couchType" class="sr-only">Tipo</label>
                <select class="form-control" name="couchType" id="couchType" data-error="Seleccione un tipo!">
                    <option selected hidden value>Tipo de Couch</option>
                    <?php
                        $query = "SELECT t.idtipo, t.descripcion FROM tipo t";
                        $result = queryAllByAssoc($query);
                        foreach ($result as $row) {
                            echo "<option value=".$row['idtipo'].">".$row['descripcion']."</option>";
                        }
                    ?>
                </select>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback has-success">
                <label for="couchCapacity" class="sr-only">Capacidad</label>
                <input type="text" pattern="^[0-9\s]+$" class="form-control" name="couchCapacity" id="couchCapacity" placeholder="Cantidad de personas" data-error="Ingrese un numero!"></input>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback has-success">
                <label for="couchTitle" class="sr-only">Titulo</label>
                <input type="text" class="form-control" name="couchTitle" id="couchTitle" placeholder="Titulo del Couch" data-error="Ingrese un titulo!"></input>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback has-success">
                <label for="couchDescription" class="sr-only">Descripcion</label>
                <textarea class="form-control" rows="3" name="couchDescription" id="couchDescription" placeholder="Descripcion del Couch" data-error="Ingrese una descripcion!"></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>

            <div class="checkbox collapse" id="caracteristicas">
                <?php
                    $query = "SELECT * FROM caracteristica";
                    $result = queryAllByAssoc($query);
                    foreach ($result as $caracteristica) {
                        $idCaracteristica = $caracteristica['idcaracteristica'];
                        $nombreCaracteristica = $caracteristica['descripcion'];
                        echo "<label>";
                        echo "<input name='caracteristicas[]' type='checkbox' value=".$idCaracteristica.">";
                        echo "$nombreCaracteristica";
                        echo "</label> ";
                    }
                ?>
            </div>

            <button type="submit" onclick="showSearch()" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
            <a href="#caracteristicas" role="button" data-toggle="collapse" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
            <button onclick="resetCouchSearch()" role="button" class="btn btn-warning resetCouchSearch">Reset</button>
        </form>

    </div>
</div>
<script>
    var height = document.getElementById("splashPage").offsetHeight;
    document.getElementById("couchSearchFormContainer").setAttribute('data-offset-top', height - 150);

    $( document.getElementById("couchSearchForm") ).on( "submit", function( event ) {
      event.preventDefault();
      var formData = ( $( this ).serialize() );
      searchForCouches(formData);
      window.scroll(0,findPos(document.getElementById("searchResult")));
    });

    function resetCouchSearch() {
        document.getElementById("couchSearchForm").reset();
        var formData = ( $( this ).serialize() );
        searchForCouches(formData);
        window.location=('index.php#mainContent');
    }
</script>
