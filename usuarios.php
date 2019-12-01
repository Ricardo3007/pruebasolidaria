<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Círculo Solidario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link href="./main.css" rel="stylesheet"></head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        <!-- Incluímos el navbar -->
        <?php include 'navbar.html'; ?>       
        
        <div class="app-main">

            <?php include 'sidebar.html'; ?>       
   
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fas fa-user icon-gradient bg-deep-blue"></i>
                                </div>
                                <div>Admin Usuarios por siempre
                                    <div class="page-title-subheading">Creación, modificación o eliminación de Usuarios.
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header-tab-animation card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                        <div id="title_user_action">
                                            Crear Usuario
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="frmUsuario">
                                        <input id="txtIdUsuario" type="hidden">
                                        <div class="position-relative form-group">
                                            <label for="txtNombres" class="">Nombres</label>
                                            <input name="txtNombres" id="txtNombres" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="txtApellidos" class="">Apellidos</label>
                                            <input name="txtApellidos" id="txtApellidos" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="txtEmail" class="">Email</label>
                                            <input name="txtEmail" id="txtEmail" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="txtNombreusu" class="">Usuario</label>
                                            <input name="txtNombreusu" id="txtNombreusu" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="txtPassword" class="">Contraseña</label>
                                            <input name="txtPassword" id="txtPassword" type="password" class="form-control">
                                        </div>
                                        <button class="mt-2 btn btn-primary btn-block">
                                            <i class="pe-7s-check"></i>
                                            Guardar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                        Listado de Usuarios
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Usuario</th>
                                                    <th class="text-center" width="20%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listaUsuarios">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'footer.html'; ?>       
 
            </div>
            <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

<script type="text/javascript">

    let submitAccion = 0;             // 0=>Crear - 1=>Editar
    consultarUsuarios();

    function consultarUsuarios(){
        $.ajax({
            method: "POST",
            url: "ajax/ajxUsuarios.php",
            data: { accion: 'consultarUsuarios' },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS", result);
                $("#listaUsuarios").html('');
                $.each(result, function(index, el){
                    $("#listaUsuarios").append(`
                        <tr>
                            <td>${el.nombres}</td>
                            <td>${el.apellidos}</td>
                            <td>${el.nombreusu}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-success mx-2" id="btnEditar${el.id}"><i class="fas fa-user-edit"></i></a>
                                <a href="javascript:void(0);" class="text-danger mx-2" id="btnBorrar${el.id}"><i class="fas fa-user-times"></i></a>
                            </td>
                        </tr>
                    `);
                    $("#btnEditar"+el.id).click(() => {
                        $("#txtNombres").val(el.nombres);
                        $("#txtApellidos").val(el.apellidos);
                        $("#txtEmail").val(el.email);
                        $("#txtNombreusu").val(el.nombreusu);
                        $("#txtPassword").val(el.password);
                        $("#txtIdUsuario").val(el.id);
                        $("#title_user_action").text("Editar Usuario");
                        submitAccion = 1;
                    });

                    $("#btnBorrar"+el.id).click(() => {
                        eliminarUsuario(el.id);
                    });
                });
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    $("#frmUsuario").submit(function( event ) {
        event.preventDefault();

        let id = $("#txtIdUsuario").val();
        let nombres = $("#txtNombres").val();
        let apellidos = $("#txtApellidos").val();
        let email   = $("#txtEmail").val();
        let usuario = $("#txtNombreusu").val();
        let password = $("#txtPassword").val();
        let accion = (submitAccion == 0) ? 'crearUsuario':'editarUsuario';
        if (validar()){
            $.ajax({
                method: "POST",
                url: "ajax/ajxUsuarios.php",
                data: { accion, id, nombres, apellidos, usuario, password,email },
                dataType: "json",
                success: (result) => {
                    swal({
                        title: "¡Listo!",
                        type: "success",
                        text: "Se guardó un usuario exitosamente",
                        confirmButtonText: "Ok"
                    });
                    limpiar();
                    consultarUsuarios();
                },
                error: (err) => {
                    console.log("ERROR", err);
                }
            });
        } else {
           swal({
                title: "Validación",
                type: "warning",
                text: "Por favor llene los campos requeridos",
                confirmButtonText: "Ok"
            });
        }
        

    });

    function eliminarUsuario(id){
        $.ajax({
            method: "POST",
            url: "ajax/ajxUsuarios.php",
            data: { accion: 'eliminarUsuario', id },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS DELETE", result);
                consultarUsuarios();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    function limpiar(){
        $("#txtIdUsuario").val('');
        $("#txtNombres").val('');
        $("#txtApellidos").val('');
        $("#txtEmail").val('');
        $("#txtNombreusu").val('');
        $("#txtPassword").val('');
        $("#title_user_action").text("Crear Usuario");
        submitAccion = 0;
    }

    function validar(){
        if($('#txtNombres').val() == ''
            || $('#txtApellidos').val() == ''
            || $('#txtEmail').val() == ''
            || $('#txtNombreusu').val() == ''
            || $('#txtPassword').val() == ''
        ){
            return false;
        } else {
            return true;
        }
        
    }
</script>
</html>
