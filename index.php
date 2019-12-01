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
        <?php //include 'navbar.html'; ?>       
        
        <div class="app-main">

            <?php //include 'sidebar.html'; ?>       
   
            <div class="app-main__outer">
                <div class="app-main__inner">
                    
                    <div class="row">
                        <div class="col-md-4 offset-md-3">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header-tab-animation card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                        <div id="title_user_action">
                                             Inicio De Sesión prueba1
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="frmUsuario">
                                        <input id="txtIdUsuario" type="hidden">
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
                                            Iniciar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

            </div>
            <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

<script type="text/javascript">
   
    $("#frmUsuario").submit(function( event ) {
        event.preventDefault();


        let usuario = $("#txtNombreusu").val();
        let password = $("#txtPassword").val();
        let accion = 'loginUsuario';
        $.ajax({
            method: "POST",
            url: "ajax/ajxUsuarios.php",
            data: { accion, usuario, password },
            dataType: "json",
            success: (result) => {
                if (result.length){
                    console.log("SUCCESS LOGIN", result);
                    //console.log("aaa ", usuario);
                    window.location.replace("usuarios.php");
                } else {
                    swal({
                        title: "¡Error!",
                        type: "error",
                        text: "Usuario o contraseña incorrectos",
                        confirmButtonText: "Ok"
                    });
                   
                }   
                
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });

    });


    function limpiar(){
        $("#txtNombreusu").val('');
        $("#txtPassword").val('');
        $("#title_user_action").text("Crear Usuario");
        submitAccion = 0;
    }
</script>
</html>
