<?php
include('plantilla/head.php');
session_start();
$subTotal = 0;
$IVA = 0;
$aPagar = 0;

#print_r($_SESSION["CARRITO"])
?>

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>IMPORTE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_SESSION["CARRITO"])) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Upps... Error al cargar los datos.
                    </div>
                <?php
                    return false;
                }
                foreach ($_SESSION["CARRITO"] as $elemento) {
                    #print_r($elemento);
                ?>
                    <tr>
                        <td><?php echo $elemento['id'] ?></td>
                        <td><?php echo $elemento['nombre'] ?></td>
                        <td><?php echo $elemento['precio'] ?></td>
                        <td><input type="number" onchange="actualizar(<?php echo $elemento['id']?>,this.value);" value="<?php echo $elemento['cantidad'] ?>"</td>
                        <td><?php echo $elemento['importe'] ?></td>
                        <td>
                            <form action="logica.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $elemento["id"] ?>">
                                <button type="submit" class="btn btn-danger" name="Eliminar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php

                    $subTotal += $elemento['importe'];
                }
                $IVA = $subTotal * (0.12);
                $aPagar = $subTotal + $IVA;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>SubTotal<strong></td>
                    <td style="text-align: right;"><strong><?php echo $subTotal ?><strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>IVA<strong></td>
                    <td style="text-align: right;"><strong><?php echo $IVA ?><strong></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>A Pagar<strong></td>
                    <td style="text-align: right;"><strong><?php echo $aPagar ?><strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="col-md-9">
        </div>
        <div class="col-md-2">
            <a class="btn btn-warning" href="pagar.php">Pagar</a>
        </div>
    </div>
</div>
<script>
    function actualizar(id, cantidad) {
        
        const Http = new XMLHttpRequest();
        const url = "logica.php?id=" + id + "&cantidad=" + cantidad + "&Actualizar=Actualizar";
        Http.open("GET", url, false);
        Http.send();

        location.reload();
    }
</script>
<?php
include('plantilla/footer.php');
?>