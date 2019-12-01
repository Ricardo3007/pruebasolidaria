<?php

  require_once $_SERVER["DOCUMENT_ROOT"] . "/class/BaseDatos.php";
  use clases\BaseDatos;
  $bd = new BaseDatos();
  
  $nombres      = $_POST['nombres'];
  $apellidos    = $_POST['apellidos'];
  $usuario      = $_POST['usuario'];
  $password     = $_POST['password'];

  //echo  $nombres;
  
  $resultado = $bd->query("insert into usuarios (nombreusu,password,nombres,apellidos) 
  values('".$usuario."','".$password."','".$nombres."','".$apellidos."')");
  echo $resultado;
  
   //echo '<script>alert("Registros Grabados" ) </script>';
   header("Location: /creditoSolidario/registrousu.php");

  // return $resultado