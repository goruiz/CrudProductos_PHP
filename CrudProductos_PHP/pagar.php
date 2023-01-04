<?php
include("administrador/conn.php");
include("plantilla/head.php");
session_start();
$verificar = true;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = $_POST['usr'];
    $pass = $_POST['pwd'];

    $sql = "select * from usuarios where usr = '$user' and pwd = '$pass'; ";
    $res = $conn->query($sql);

    //print_r($res);
    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        $id = $row["id"];
        $subTotal = 0;
        $IVA = 0;
        $aPagar = 0;

        foreach ($_SESSION["CARRITO"] as $elemento) {
            $subTotal += $elemento["importe"];
        }
        $IVA = $subTotal * 0.12;
        $aPagar = $subTotal + $IVA;

        $sql = "insert into factura values (null,$id,$aPagar,$IVA);";
        $idFac = 0;
        if(!$conn->query($sql)){            
            $verificar = false;
        }else{
            $idFac = $conn->insert_id;
        }
        //insertgar el detalle de los productos.       
        foreach ($_SESSION["CARRITO"] as $elemento) {
            $idp =$elemento['id'];
            $cantidad = $elemento["cantidad"];
            $precio = $elemento["precio"];
            $importe = $elemento['importe'];

            $sql ="insert into detallefactura values (null,$cantidad,$precio,$importe,$idFac,$idp);";
            if(!$conn->query($sql)){            
                $verificar = false;
            }            
        } 
        $conn->close();       

        if ($verificar) {
            session_destroy();
            echo "<script>
            alert('Bienvenido, compra realizada.');
            window.location.href = 'Index.php';
            </script>";
        }else{
            echo "<script>
            alert('Bienvenido, ERROR al comprar.');
            window.location.href = 'Index.php';
            </script>";
        }
    } else {
        echo "<script>alert('Intente nuevamente.');</script>";
    }
}
?>

<div class="container">
    <div class="row">
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ingrese el usuario</label>
                <input type="text" class="form-control" name="usr" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Tus credenciales estan seguras</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pwd" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Compra</button>
        </form>

    </div>
</div>
<?php
include("plantilla/footer.php");
?>