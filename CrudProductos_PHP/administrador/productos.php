<?php
include "plantillas/head2.php";
include "conn.php";
$sql = "select * from productos";
$result = mysqli_query($conn, $sql);
?>
<div class="container">
    <div class="row">
        <table class="table table-striped">
            <thread>
                <tr>
                
                    <th scape="col">Nombre</th>
                    <th scape="col">Cantidad</th>
                    <th scape="col">Precio</th>
                    <th scape="col">Foto</th>
                    <th scape="col">Marca</th>
                    
                </tr>

            </thread>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                    
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['cantidad'] ?></td>
                        <td><?php echo $row['precio'] ?></td>
                        <td><?php echo $row['Foto'] ?></td>
                        <td><?php echo $row['marca'] ?></td>
                        <td>
                            <form action="crud/productos_crud.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form action="formularioProductos.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
                                <button type="submit" class="btn btn-info" name="Enviar" value="Actualizar">Actualizar</button>
                            </form>
                        </td>
                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include "plantillas/footer.php";
?>