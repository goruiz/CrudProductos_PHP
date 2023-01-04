<?php
include "conn.php";
include("plantillas/head.php");
session_start();

if(!$_SESSION['PERMISO'] == TRUE){
    header('location: login.php');
}

$row="";
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["Enviar"] === "Actualizar") {
    $id = $_POST['id'];
    $sql = "select * from productos where id=$id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <br>
                <div class="card">
                    <div class="card-header">Productos</div>
                    <div class="card-body">
                        <form action="crud/productos_crud.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="hidden" class="form-id" id="id" name="id" value="<?php if (isset($row['id'])) {
                                                                                                    echo $row['id'];
                                                                                                } else {
                                                                                                    echo "0";
                                                                                                } ?>">

                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php if (isset($row['nombre'])) {
                                                                                                    echo $row['nombre'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="text" class="form-control" name="cantidad" value="<?php if (isset($row['cantidad'])) {
                                                                                                    echo $row['cantidad'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>">
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio:</label>
                                <input type="text" class="form-control" name="precio" value="<?php if (isset($row['precio'])) {
                                                                                                    echo $row['precio'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto:</label>
                                <label for="ruta" class="form-label"> <?php if (isset($row['Foto'])) {
                                                                            echo $row['Foto'];
                                                                        } else {
                                                                            echo "";
                                                                        } ?> </label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion:</label>
                                <input type="text" class="form-control" name="descripcion" value="<?php if (isset($row['descripcion'])) {
                                                                                                        echo $row['descripcion'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>">
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca:</label>
                                <input type="text" class="form-control" name="marca" value="<?php if (isset($row['marca'])) {
                                                                                                echo $row['marca'];
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="Enviar" value="Guardar">Guardar</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

</body>

</html