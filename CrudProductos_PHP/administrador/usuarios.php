<?php
include("plantillas/head2.php");
include ("conn.php");
$sql="select * from usuarios;";
$result= mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Usuarios</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <br/>
                <div class="card">
                    <div class="card-header">
                        Usuarios
                    </div>
                    <div class="card-body">
                        <form action="crud/usuarios_crud.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="hidden">
                                <label for="usr" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" name="usr">
                            </div>
                            <div class="mb-3">
                                
                                <label for="pwd" class="form-label">Contraseña:</label>
                                <input type="passwprd" class="form-control" name="pwd">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <table class="table table-stiped">
                <thead>
                    <tr>
                 
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
    
                  
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr><td>".$row['usr']."</td><td>".$row['pwd']."</td><td>";
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</body>

</html>