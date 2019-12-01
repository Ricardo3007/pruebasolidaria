<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Círculo Social</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    <link href="./main.css" rel="stylesheet">
</head>
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
                                    <i class="fas fa-users icon-gradient bg-deep-blue"></i>
                                </div>
                                <div>Admin Grupos
                                    <div class="page-title-subheading">Creación, modificación o eliminación de Grupos.</div>
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
                                            Grupo
                                        </div>
                                        
                                    </div>
                                    <div class="btn-actions-pane-right">
                                        <div role="group" class="btn-group-sm btn-group">
                                            <button type="button" class="btn btn-primary" id="btnNuevoGrupo" data-toggle="modal" data-target=".modal-grupo">
                                                <i class="fas fa-plus-circle"></i>
                                                Nuevo
                                            </button>
                                            <!-- <button class="btn btn-focus">All Month</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="frmUsuario">
                                        <input id="txtIdGrupo" type="hidden">
                                        <div class="position-relative form-group">
                                            <label for="cmbGrupos" class="">Nombre del Grupo</label>
                                            <select name="cmbGrupos" id="cmbGrupos" class="form-control select2">
                                                <option value=""></option>
                                            </select>
                                        </div>

                                        <div class="position-relative form-group">
                                            <label for="cmbClientes" class="">Lista de Clientes</label>
                                            <div class="d-flex align-items-center">
                                                <select name="cmbClientes" id="cmbClientes" class="form-control select2">
                                                    <option value=""></option>
                                                </select>
                                                <a href="javascript:void(0);" id="btnAgregarCliente" style="font-size: 30px"><i class="fas fa-plus-circle icon-gradient bg-primary ml-2"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                        Miembros del Grupo
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Nombres y Apellidos</th>
                                                    <th>Teléfono</th>
                                                    <th>Email</th>
                                                    <th class="text-center" width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listaMiembros">

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
        </div>
    </div>

    <!-- Modal de Clientes -->
    <div class="modal fade modal-grupo" id="modal-grupo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_action">Crear Grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtNombreGrupo">Nombre del grupo</label>
                        <input type="text" class="form-control" id="txtNombreGrupo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

    let submitAccion = 0;             // 0=>Crear - 1=>Editar
    consultarGrupos();
    consultarClientes();

    function consultarClientes(){
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion: 'consultarClientes' },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS", result);
                $("#cmbClientes").html('<option value="0">Seleccionar...</option>');
                $.each(result, function(index, el){
                    $("#cmbClientes").append('<option value="'+el.id+'">'+el.nombre+'</option>');
                });
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    function consultarGrupos(){
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion: 'consultarGrupos' },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS", result);
                $("#cmbGrupos").html('<option value="0">Seleccionar...</option>');
                $.each(result, function(index, el){
                    $("#cmbGrupos").append('<option value="'+el.id+'">'+el.nombre+'</option>');
                });
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    $("#btnAgregarCliente").click(function(){
        let idGrupo = $("#cmbGrupos").val();
        let idCliente = $("#cmbClientes").val();
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion: 'agregarClienteGrupo', idGrupo, idCliente },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS", result);
                consultarMiembrosGrupo(idGrupo);
                consultarClientes();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    })

    function consultarMiembrosGrupo(idGrupo){
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion: 'consultarMiembrosGrupo', idGrupo },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS Miembros", result);
                $("#listaMiembros").html("");
                $.each(result, function(index, el){
                    $("#listaMiembros").append(`
                        <tr>
                            <td>${el.documento}</td>
                            <td>${el.nombre}</td>
                            <td>${el.telefono}</td>
                            <td>${el.email}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-danger mx-2" id="btnBorrar${el.id}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    `);
                    $("#btnBorrar"+el.id).click(function(){
                        eliminarMiembroGrupo(idGrupo, el.id);
                    });
                });
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    $("#cmbGrupos").change(function() {
        let id = $("#cmbGrupos").val();
        consultarMiembrosGrupo(id);
    })

    $("#btnGuardar").click(function() {

        let id = $("#txtIdGrupo").val();
        let nombre = $("#txtNombreGrupo").val();
        let accion = (submitAccion == 0) ? 'crearGrupo':'editarGrupo';
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion, id, nombre },
            dataType: "json",
            success: (result) => {
                swal({
                    title: "¡Listo!",
                    type: "success",
                    text: "Se guardó un grupo exitosamente",
                    confirmButtonText: "Ok"
                });
                console.log("SUCCESS SAVE", result);
                $("#modal-grupo").modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open'); 
                    $('.modal-backdrop').remove(); 
                };
                limpiar();
                consultarGrupos();
                consultarClientes();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });

    });

    function eliminarMiembroGrupo(idGrupo, idCliente){
        $.ajax({
            method: "POST",
            url: "ajax/ajxGrupos.php",
            data: { accion: 'eliminarMiembroGrupo', idGrupo, idCliente },
            dataType: "json",
            success: (result) => {
                consultarMiembrosGrupo(idGrupo);
                consultarClientes();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    function limpiar(){
        $("#txtIdGrupo").val('');
        $("#txtNombreGrupo").val('');
        $("#title_modal_action").text("Crear Grupo");
        submitAccion = 0;
    }
</script>
</html>
