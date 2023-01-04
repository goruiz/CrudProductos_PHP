<?php
include('plantillas/head2.php');
include("conn.php");
session_start();
$_SESSION['PERMISO'] = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usr = $_POST["usuario"];
    $clave = $_POST["clave"];
    $sql = "select * from usuarios where usr='$usr' and pwd='$clave';";
    $res = $conn->query($sql);
    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        $_SESSION['PERMISO'] = TRUE;
        $_SESSION['USR'] = $row['usr'];
        echo "<script>
            alert('Bienvenido');
            window.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
            alert('No eres bienvenido');
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>

<body>

    <div class="conier">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <br />
                <div class="card">
                    <div class="card-header">
                        LOGIN
                    </div>
                    <div class="card-body">

                        <form method="POST">
                            <div class="mb-3">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario">

                            </div>
                            <div class="mb-3">
                                <label for="clave">Clave</label>
                                <input type="password" class="form-control" name="clave">
                            </div>

                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
</body>

</html>