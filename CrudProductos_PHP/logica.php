<?php
include "administrador/conn.php";
session_start();
$verificar = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Agregar"])) {
    $id = $_POST["id"];
    $sql = "Select * from productos where id = $id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    //Agregar un nuevo producto al carrito, si la variable carrito existe.
    if (!isset($_SESSION["CARRITO"])) {
        $tempCarrito = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "precio" => $row["precio"],
            "cantidad" => 1,
            "importe" => $row["precio"]
        );
        $_SESSION["CARRITO"][$row["id"]] = $tempCarrito;
    } else {
        foreach ($_SESSION["CARRITO"] as $elementos) {
            if ($elementos["id"] == $id) {
                $_SESSION["CARRITO"][$id]["cantidad"]++;
                $_SESSION["CARRITO"][$id]["importe"] = $_SESSION["CARRITO"][$id]["cantidad"] * $_SESSION["CARRITO"][$id]["precio"];
                $verificar = false;
            }
        }
        if ($verificar) {
            $totalElementos = count($_SESSION["CARRITO"]);
            $tempCarrito = array(
                "id" => $row["id"],
                "nombre" => $row["nombre"],
                "precio" => $row["precio"],
                "cantidad" => 1,
                "importe" => $row["precio"]
            );
            $_SESSION["CARRITO"][$row["id"]] = $tempCarrito;
        }
    }
    header("Location: Carrito.php");
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Eliminar"])) {
    $id = $_POST["id"];
    unset($_SESSION["CARRITO"][$id]);
    header("Location: Carrito.php");
}else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Actualizar"])) {

    $id = $_GET['id'];
    $cantidad = $_GET['cantidad'];
    $_SESSION["CARRITO"][$id]["cantidad"] = $cantidad;
    $_SESSION["CARRITO"][$id]["importe"] = $_SESSION["CARRITO"][$id]["cantidad"] *  $_SESSION["CARRITO"][$id]["precio"];
}