<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
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
                                    <i class="fas fa-user-tie icon-gradient bg-deep-blue"></i>
                                </div>
                                <div>Admin Clientes para todos
                                    <div class="page-title-subheading">Creación, modificación o eliminación de Clientes.</div>
                                </div>
                                
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                        Listado de Clientes
                                    </div>
                                    <div class="btn-actions-pane-right">
                                        <div role="group" class="btn-group-sm btn-group">
                                            <button type="button" class="btn mr-2 mb-2 btn-primary mt-1" data-toggle="modal" data-target=".modal-cliente">
                                                <i class="fas fa-plus-circle"></i>
                                                Nuevo Cliente
                                            </button>
                                            <!-- <button class="btn btn-focus">All Month</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Dirección</th>
                                                    <th>Teléfono</th>
                                                    <th class="text-center" width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="listaClientes">

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
    <div class="modal fade modal-cliente" id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_action">Crear Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmCliente">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="txtIdCliente" type="hidden">
                                    <label for="cmbTipoDocumento">Tipo Documento</label>
                                    <select name="cmbTipoDocumento" id="cmbTipoDocumento" class="form-control">
                                        <option value="1">CC</option>
                                        <option value="2">NIT</option>
                                        <option value="3">TI</option>
                                        <option value="4">RC</option>
                                        <option value="5">CE</option>
                                        <option value="6">DNI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtNroDocumento">No. Documento</label>
                                    <input name="txtNroDocumento" id="txtNroDocumento" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtDv">Dígito de Verificación</label>
                                    <input name="txtDv" id="txtDv" type="number" value="0" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtPrimerNombre">Primer Nombre</label>
                                    <input name="txtPrimerNombre" id="txtPrimerNombre" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtSegundoNombre">Segundo Nombre</label>
                                    <input name="txtSegundoNombre" id="txtSegundoNombre" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtPrimerApellido">Primer Apellido</label>
                                    <input name="txtPrimerApellido" id="txtPrimerApellido" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtSegundoApellido">Segundo Apellido</label>
                                    <input name="txtSegundoApellido" id="txtSegundoApellido" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtDireccion">Dirección</label>
                                    <input name="txtDireccion" id="txtDireccion" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtTelefono">Teléfono</label>
                                    <input name="txtTelefono" id="txtTelefono" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cmbCiudad">Ciudad</label>
                                    <select class="form-control" name="cmbCiudad" id="cmbCiudad">
                                        <option value="0">Seleccionar...</option>
                                        <option value="1">Barranquilla</option>
                                        <option value="2">Santa Marta</option>
                                        <option value="3">Cartagena</option>
                                        <option value="4">Montería</option>
                                        <option value="5">Riohacha</option>
                                        <option value="6">Bogotá</option>
                                        <option value="7">Medellín</option>
                                        <option value="8">Cali</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtEmail">Email</label>
                                    <input name="txtEmail" id="txtEmail" type="text" class="form-control">
                                </div>
                            </div>
                        </div>   
                        
                    </form>
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

    let submitAccion = 0;             // 0=>Crear - 1=>Editar
    consultarClientes();

    function consultarClientes(){
        $.ajax({
            method: "POST",
            url: "ajax/ajxClientes.php",
            data: { accion: 'consultarClientes' },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS", result);
                $("#listaClientes").html('');
                $.each(result, function(index, el){
                    $("#listaClientes").append(`
                        <tr>
                            <td>${el.documento}</td>
                            <td>${el.prim_nom} ${el.seg_nom}</td>
                            <td>${el.prim_ape} ${el.seg_ape}</td>
                            <td>${el.direccion}</td>
                            <td>${el.telefono}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-success mx-2" id="btnEditar${el.id}"><i class="fas fa-user-edit"></i></a>
                                <a href="javascript:void(0);" class="text-danger mx-2" id="btnBorrar${el.id}"><i class="fas fa-user-times"></i></a>
                            </td>
                        </tr>
                    `);
                    $("#btnEditar"+el.id).click(() => {
                        $("#modal-cliente").modal('show');
                        $("#txtIdCliente").val(el.id);
                        $("#cmbTipoDocumento").val(el.tipo_doc);
                        $("#txtNroDocumento").val(el.documento);
                        $("#txtDv").val(el.dv);
                        $("#txtPrimerNombre").val(el.prim_nom);
                        $("#txtSegundoNombre").val(el.seg_nom);
                        $("#txtPrimerApellido").val(el.prim_ape);
                        $("#txtSegundoApellido").val(el.seg_ape);
                        $("#txtDireccion").val(el.direccion);
                        $("#txtTelefono").val(el.telefono);
                        $("#cmbCiudad").val(el.ciudad);
                        $("#txtEmail").val(el.email);
                        $("#title_modal_action").text("Editar Cliente");
                        submitAccion = 1;
                    });

                    $("#btnBorrar"+el.id).click(() => {
                        eliminarCliente(el.id);
                    });
                });
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    $("#btnGuardar").click(function( event ) {

        let id = $("#txtIdCliente").val();
        let tipoDocumento = $("#cmbTipoDocumento").val();
        let nroDocumento = $("#txtNroDocumento").val();
        let dv = $("#txtDv").val();
        let primerNombre = $("#txtPrimerNombre").val();
        let segundoNombre = $("#txtSegundoNombre").val();
        let primerApellido = $("#txtPrimerApellido").val();
        let segundoApellido = $("#txtSegundoApellido").val();
        let direccion = $("#txtDireccion").val();
        let telefono = $("#txtTelefono").val();
        let ciudad = $("#cmbCiudad").val();
        let email = $("#txtEmail").val();
        let nombre = primerNombre+ ' ' + segundoNombre+ ' ' + primerApellido+ ' ' + segundoApellido;
        let accion = (submitAccion == 0) ? 'crearCliente':'editarCliente';
        if (validar()){
        $.ajax({
            method: "POST",
            url: "ajax/ajxClientes.php",
            data: { accion, id, nombre, tipoDocumento, nroDocumento, dv, primerNombre, segundoNombre, primerApellido, segundoApellido, direccion, telefono, ciudad ,email},
            dataType: "json",
            success: (result) => {
                swal({
                    title: "¡Listo!",
                    type: "success",
                    text: "Se guardó un cliente exitosamente",
                    confirmButtonText: "Ok"
                });

                $("#modal-cliente").modal('hide');

                if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open'); 
                    $('.modal-backdrop').remove(); 
                };

                limpiar();
                consultarClientes();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
        }else{
            alert ("Falta llenar Informacion requerida");
        }

    });


    function eliminarCliente(id){
        $.ajax({
            method: "POST",
            url: "ajax/ajxClientes.php",
            data: { accion: 'eliminarCliente', id },
            dataType: "json",
            success: (result) => {
                console.log("SUCCESS DELETE", result);
                consultarClientes();
            },
            error: (err) => {
                console.log("ERROR", err);
            }
        });
    }

    function limpiar(){
        $("#txtIdCliente").val('');
        $("#cmbTipoDocumento").val('');
        $("#txtNroDocumento").val('');
        $("#txtDv").val('');
        $("#txtPrimerNombre").val('');
        $("#txtSegundoNombre").val('');
        $("#txtPrimerApellido").val('');
        $("#txtSegundoApellido").val('');
        $("#txtDireccion").val('');
        $("#txtTelefono").val('');
        $("#cmbCiudad").val('');
        $("#txtEmail").val('');
        $("#title_modal_action").text("Crear Cliente");
        submitAccion = 0;
    }

    function validar(){
        if($('#txtNroDocumento').val() == ''
            || $('#txtPrimerNombre').val() == ''
            || $('#txtPrimerApellido').val() == ''
            || $('#txtSegundoApellido').val() == ''
            || $('#txtDireccion').val() == ''
            || $('#txtTelefono').val() == ''
            || $('#txtEmail').val() == ''
        ){
            return false;
        } else {
            return true;
        }   
    }

</script>
</html>
