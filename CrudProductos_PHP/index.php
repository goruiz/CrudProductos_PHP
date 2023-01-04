<?php
include('plantilla/head.php');
include('administrador/conn.php');
$sql = "select * from productos";
$result = mysqli_query($conn, $sql);
?>

<div class="container-lg">


    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <br>
                <div class="card" style="width: 17rem;">
                    <img class="card-img-top" src=<?php echo $row['Foto'] ?> alt="Card image cap" height="200px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre'] ?></h5>
                        <p class="card-text"><?php echo $row['descripcion'] ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Precio: <?php echo $row['precio'] ?></li>
                        <li class="list-group-item">Marca: <?php echo $row['marca'] ?></li>
                    </ul>
                    <div class="card-body">
                        <form action="logica.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
                            <button type="submit" class="btn btn-success" name="Agregar" value="Agregar">Agregar</button>
                        </form>

                    </div>
                </div>


            <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Upps... Error al cargar los datos
            </div>
        <?php
        }
        ?>

    </div>

</div>

<?php
include('plantilla/footer.php')
?>