<?php
  session_start();
  // print_r($_SESSION);
  require_once "../class/BaseDatos.php";
  use clases\BaseDatos;

  if (isset($_POST['accion'])){
    
    if ($_POST['accion'] == 'consultarUsuarios'){

        $bd = new BaseDatos();
        $rst = $bd->query("SELECT * FROM usuarios");
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'crearUsuario') {

        $nombres      = $_POST['nombres'];
        $apellidos    = $_POST['apellidos'];
        $usuario      = $_POST['usuario'];
        $password     = $_POST['password'];
        $email        = $_POST['email'];

        $bd = new BaseDatos();

        // $rst = $bd->insert("usuarios", "nombreusu, password, nombres, apellidos", "'$usuario', '$password', '$nombres', '$apellidos'", "1");
        $rst = $bd->insert("usuarios", "nombreusu, password, nombres, apellidos,email", "'$usuario', '$password', '$nombres', '$apellidos', '$email'", "1");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'editarUsuario') {

        $id      = $_POST['id'];
        $nombres      = $_POST['nombres'];
        $apellidos    = $_POST['apellidos'];
        $usuario      = $_POST['usuario'];
        $password     = $_POST['password'];
        $email        = $_POST['email'];

        $bd = new BaseDatos();

        $rst = $bd->update("usuarios", "nombreusu='$usuario', password='$password', nombres='$nombres', apellidos='$apellidos' , email='$email' ", "id='$id'", "1");
        // $rst = $bd->query("UPDATE usuarios SET nombreusu='$usuario', password='$password', nombres='$nombres', apellidos='$apellidos' WHERE id='$id'");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'eliminarUsuario') {
      
      $id      = $_POST['id'];

      $bd = new BaseDatos();

      $rst = $bd->query("DELETE FROM usuarios where id=$id");
      
      echo json_encode($rst);
  }

  elseif ($_POST['accion'] == 'loginUsuario') {
      
    $usuario      = $_POST['usuario'];
    $password     = $_POST['password'];

    $bd = new BaseDatos();
    $rst = $bd->query("SELECT * FROM usuarios where nombreusu='$usuario' and password='$password'");
    if(isset($rst[0]['id'])){
      $_SESSION['nombres'] = $rst[0]['nombres'];
      $_SESSION['apellidos'] = $rst[0]['apellidos'];
      $_SESSION['email'] = $rst[0]['email'];
    }
    echo json_encode($rst);
}

}