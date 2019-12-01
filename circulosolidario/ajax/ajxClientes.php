<?php

  require_once "../class/BaseDatos.php";
  use clases\BaseDatos;

  if (isset($_POST['accion'])){
    
    if ($_POST['accion'] == 'consultarClientes'){

        $bd = new BaseDatos();
        $rst = $bd->query("SELECT * FROM clientes WHERE estado='ACTIVO'");
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'crearCliente') {

        $tipoDocumento   = $_POST['tipoDocumento'];
        $nroDocumento    = $_POST['nroDocumento'];
        $dv              = $_POST['dv'];
        $nombre          = $_POST['nombre'];
        $primerNombre    = $_POST['primerNombre'];
        $segundoNombre   = $_POST['segundoNombre'];
        $primerApellido  = $_POST['primerApellido'];
        $segundoApellido = $_POST['segundoApellido'];
        $direccion       = $_POST['direccion'];
        $telefono        = $_POST['telefono'];
        $ciudad          = $_POST['ciudad'];
        $email           = $_POST['email'];

        $bd = new BaseDatos();

        // $rst = $bd->insert("clientes", "nombreusu, password, nombres, apellidos", "'$usuario', '$password', '$nombres', '$apellidos'", "1");
        $rst = $bd->insert(
            "clientes", 
            "nombre, documento, dv, tipo_doc, direccion, prim_ape, seg_ape, prim_nom, seg_nom, telefono, ciudad,email", 
            "'$nombre', '$nroDocumento', '$dv', '$tipoDocumento', '$direccion',  '$primerApellido', '$segundoApellido', '$primerNombre', '$segundoNombre', '$telefono', '$ciudad', '$email'",
            "1"
        );
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'editarCliente') {

        $id              = $_POST['id'];
        $tipoDocumento   = $_POST['tipoDocumento'];
        $nroDocumento    = $_POST['nroDocumento'];
        $dv              = $_POST['dv'];
        $nombre          = $_POST['nombre'];
        $primerNombre    = $_POST['primerNombre'];
        $segundoNombre   = $_POST['segundoNombre'];
        $primerApellido  = $_POST['primerApellido'];
        $segundoApellido = $_POST['segundoApellido'];
        $direccion       = $_POST['direccion'];
        $telefono        = $_POST['telefono'];
        $ciudad          = $_POST['ciudad'];
        $email           = $_POST['email'];

        $bd = new BaseDatos();

        $rst = $bd->update(
            "clientes", 
            "nombre='$nombre', documento='$nroDocumento', dv=$dv, tipo_doc='$tipoDocumento', direccion='$direccion', prim_ape='$primerApellido',seg_ape='$segundoApellido', seg_nom='$segundoNombre',prim_nom='$primerNombre', telefono='$telefono', ciudad='$ciudad', email='$email'", 
            "id='$id'", 
            "1"
        );
        // $rst = $bd->query("UPDATE clientes SET nombreusu='$usuario', password='$password', nombres='$nombres', apellidos='$apellidos' WHERE id='$id'");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'eliminarCliente') {
      
        $id      = $_POST['id'];
        $bd = new BaseDatos();
        $rst = $bd->update("clientes", "estado='INACTIVO'","id=$id", "1");
        echo json_encode($rst);
    }

  }