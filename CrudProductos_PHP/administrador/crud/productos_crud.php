<?php

include("../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["Enviar"] === "Guardar") {

    $ruta = "../../img/productos/";
    $ruta .= basename($_FILES["foto"]["name"]);
    $verificar = false;
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {
        //echo "Archivo guardado con exito.";
        $verificar = true;
    }

    if ($verificar) {
        $id = $_POST['id'];
        $nombre = $_POST["nombre"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $marca = $_POST["marca"];
        $foto = "img/productos/" . basename($_FILES["foto"]["name"]);
        #echo "<script>alert('Salio');</script>";
        if (isset($_POST['id']) and $_POST['id']!=0) {
            
            
            $sql = "update productos set nombre= '$nombre', cantidad ='$cantidad', precio ='$precio',
            Foto='$foto', marca='$marca', descripcion='$descripcion'
            where id='$id';";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Datos actualizados correctamente');</script>";
                echo "<script>window.location.href ='../productos.php'</script>";
            } else {
                echo "<script>alert('Error al actualizar....');</script>";
                echo "<script>window.location.href ='../formularioProductos.php'</script>";
            }
            
        } else {
            $sql = "insert into productos values(null,'$nombre','$cantidad','$precio','$foto','$marca','$descripcion');";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Datos guardados correctamente');</script>";
                echo "<script>window.location.href ='../productos.php'</script>";
            } else {
                echo "<script>alert('Error al guardar');</script>";
                echo "<script>window.location.href ='../formularioProductos.php'</script>";
            }
        }
        
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["Enviar"] === "Eliminar") {
    $id = $_POST['id'];
    $sql = "delete from productos where id = $id;";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Datos eliminados correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar');</script>";
    }
    echo "<script>window.location.href ='../productos.php'</script>";
}else{
    echo "<script>alert('Error...');</script>";
    echo "<script>window.location.href ='../productos.php'</script>";
}