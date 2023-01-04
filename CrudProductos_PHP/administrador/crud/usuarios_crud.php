
<?php
include("../conn.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){

    
$verificar=true;


if($verificar){

        $usr=$_POST["usr"];
        $pwd=$_POST["pwd"];



        $sql="insert into usuarios values(null,'$usr','$pwd')";
        if(mysqli_query($conn,$sql)){
            echo "Datos guardados correctamente!";

        }else{
            echo "NO SE PUDO GUARDAR";
        }

    }
}