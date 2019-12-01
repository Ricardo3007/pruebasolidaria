<?php

  require_once "../class/BaseDatos.php";
  use clases\BaseDatos;

  if (isset($_POST['accion'])){
    
    if ($_POST['accion'] == 'consultarGrupos'){

        $bd = new BaseDatos();
        $rst = $bd->query("SELECT * FROM grupos WHERE estado=1");
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'crearGrupo') {
        
        $nombre = $_POST['nombre'];

        $bd = new BaseDatos();
        $rst = $bd->insert("grupos", "nombre, estado", "'$nombre', 1", "1");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'editarGrupo') {

        $id     = $_POST['id'];
        $nombre = $_POST['nombre'];

        $bd = new BaseDatos();

        $rst = $bd->update("grupos", "nombre='$nombre'", "id='$id'", "1");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'consultarClientes'){

        $bd = new BaseDatos();
        $rst = $bd->query("SELECT c.* FROM clientes c
                            WHERE c.id NOT IN (SELECT id_cliente FROM gruposclientes) AND estado='ACTIVO'");
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'consultarMiembrosGrupo') {

        $idGrupo     = $_POST['idGrupo'];

        $bd = new BaseDatos();
        $rst = $bd->query("SELECT c.* FROM clientes c
                            INNER JOIN gruposclientes gc ON c.id = gc.id_cliente
                            INNER JOIN grupos g ON g.id = gc.id_grupo
                            WHERE gc.id_grupo = $idGrupo"
                        );
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'agregarClienteGrupo') {

        $idGrupo     = $_POST['idGrupo'];
        $idCliente   = $_POST['idCliente'];

        $bd = new BaseDatos();

        $rst = $bd->insert("gruposclientes", "id_grupo, id_cliente", "$idGrupo, $idCliente", "1");
        
        echo json_encode($rst);
    }

    elseif ($_POST['accion'] == 'eliminarMiembroGrupo') {

        $idGrupo   = $_POST['idGrupo'];
        $idCliente = $_POST['idCliente'];

        $bd = new BaseDatos();
        $rst = $bd->query("DELETE FROM gruposclientes WHERE id_grupo = $idGrupo AND id_cliente = $idCliente");
        
        echo json_encode($rst);
    }


}