<?php
    //print_r($_POST);
    session_start();
    require_once "../../clases/Conexion.php";
    $obj= new conectar();
    $conexion= $obj->conexion();

    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];

    if(isset($desde)==false){
        $desde = $hasta;
    }

    if(isset($hasta)==false){
        $hasta = $desde;
    }
    
    $_SESSION['desde']=$desde;
    $_SESSION['hasta']=$hasta;
?>