<!DOCTYPE html>
<?php
    require_once 'userSession.php';
    require_once 'database.php';
    require_once 'feedback.php';

    if (!$_SESSION['user']->isAdmin()) {
        unauthorizedAccess();
        exit();
    }

    $sql = "SELECT vn.valor FROM valor_negocio vn WHERE vn.valor_nombre = 'precioPremium'";
    $precioActual = queryByAssoc($sql)['valor'];
?>
<html>
<head>
    <title>Cambiar Precio Premium</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootbox.js"></script>
    <script src="../js/confirmation.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once "navbar.php" ?>
    <!-- CONTENT -->
    <div class="container-fluid inner-body">
        <!-- MAIN -->
        <main class="row">
            <div class="col-md-12 content-wrapper">
                <div class="row main-content">
                    <h2>Cambiar Precio Premium</h2>
                    <div class="col-md-5 col-md-offset-3">
                        <form class="form-horizontal" role="form" data-toggle="validator" action="updatePremiumPrice.php" method="post" name="updatePremiumPriceForm" id="updatePremiumPriceForm">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="currentPrice">Precio Actual: </label>
                                    <div class="input-group col-sm-8">
                                        <div class="input-group-addon">$</div>
                                        <input type="text" disabled <?php echo 'value='.implode(",",explode(".",$precioActual)) ?> name="currentPrice" id="currentPrice" class="form-control"></input>
                                    </div>
                                </div>

                                <div class="row">

                                <div class="col-sm-8">

                                <div class="form-group has-feedback">
                                    <label class="col-sm-6 control-label" for="newPrice">Precio Nuevo: </label>
                                    <div class="col-sm-6" style="padding: 0px">
                                    <div class="input-group ">
                                        <div class="input-group-addon">$</div>
                                        <input type="text" pattern="^[0-9\s]+$" class="form-control" name="newPriceFull" id="newPriceFull" data-error="Ingrese un valor numerico!" required></input>
                                    </div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                </div>
                                <div class="col-sm-4">

                                <div class="form-group has-feedback">
                                    <div class="input-group">
                                        <div class="input-group-addon">,</div>
                                        <input type="text" pattern="^[0-9\s]+$" maxlength="2" value="00" class="form-control" name="newPriceCents" id="newPriceCents" data-error="Ingrese un valor numerico de no mas de dos digitos!" required></input>
                                    </div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>

                                </div>

                                </div>

                                <div class="row">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                    <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                                </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <?php require_once 'footer.php' ?>
    </div>
</body>
</html>
