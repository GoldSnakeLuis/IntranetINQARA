<section role="main" class="content-body">
    <header class="page-header"><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <h2><?php echo $actualH; ?></h2>
    </header>
    <div class="row">
        <div class="col-md-12">
            <section class="card">
                <div class="tabs">
                    <header class="card-header">

                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <a id="btnRegistrar" class="modal-with-form btn btn-default btn btn-info" href="#mdlnuevo">Nuevo <i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 text-right" id="datatableButtons">
                            </div>
                        </div>
                        </br>
                        <table class="table table-bordered table-striped mb-none" id="tablaObras" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Razón Social</th>
                                    <th>Nro. DOC</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
    <!--******************* MODALS NUEVO ******************-->   
    <!--id="copy_course_modal" tabindex="-1" role="dialog" aria-labelledby="copycourse" aria-hidden="true"-->
    <div id="mdlnuevo" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Nuevo Cliente / Proveedor</h2>
            </header>
            <form action="#" class="form-horizontal" id="frmObra" method="POST">
                <div class="card-body"> 
                    <div class="form-row col-md-12">                                        
                        <div class="form-group col-md-6">
                            <label class="control-label" for="textareaDefault">Nombre / Razón Social</label>
                            <div>
                                <input name="nombrecorto" id="nombrecorto" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: LOREMITSUM12345" required/>                            
                            </div>
                        </div>   
                        <div class="form-group col-md-6">
                            <label class="control-label" >DNI / RUC</label>
                            <div>
                                <input type="number" class="form-control" id="montoinicial" name="montoinicial" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="txtIdEditar" id="txtIdEditar">                                    
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-info btn-primary mt-3 mb-3 btn btn-success">Guardar</button>
                            <button type="button" class="btn btn-default modal-dismiss red btn-outline">Cancelar</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>     
</section>



<script>
    var datatable;
    var APP = function () {

        var plugins = function () {
        }

        var initDatatables = function () {
            var cont = 1;
            $.LoadingOverlay("show");
            datatable = $('#tablaObras').DataTable({
                "sAjaxSource": "./Clieprovs/Clieprovs_lista",
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "aoColumns": [{"mData": "id"}, {"mData": "Razon_Social"}, {"mData": "ruc"}, {"mData": null}],
                "aoColumnDefs": [
                    {
                        "aTargets": [0],
                        "mRender": function (data, type, full) {
                            return cont++;
                        }
                    }, {
                        "aTargets": [3],
                        "mData": "download_link",
                        "mRender": function (data, type, full) {
                            return '<center><button><i class="fa fa-pencil"></i></button>&nbsp;<button><i class="fa fa-trash"></i></button></center>';
                        }
                    }
                ],
                drawCallback: function (settings, json) {
//                    eventos();
                    $.LoadingOverlay("hide");
                }

            });

            var botones = new $.fn.dataTable.Buttons(datatable, {
                buttons: [
                    {extend: "pdf", className: "btn btn-info", exportOptions: {columns: [0, 1, 2]}}
                    , {extend: "excel", className: "btn btn-info", exportOptions: {columns: [0, 1, 2]}}
                    , {extend: "print", className: "btn red btn-outline", text: "Imprimir", exportOptions: {columns: [0, 1, 2]}}
                ],
            });
            botones.container().appendTo('#datatableButtons');
            $('div.dataTables_filter input').addClass('form-control input-sm');
        }

        var eventos = function () {
            registrarAJAX("#frmObra", "./Obras/Obra_registrar");
        }

        var CargaInicial = function () {

            $("#btnRegistrar").click(function () {
                $("#frmObra")[0].reset();
                $("#txtIdEditar").val(null);
            });

            $(".idEditar").click(function () {
                $("#btnRegistrar").click();
                var a = buscarxidAJAX(this.id, './Obras/Obra_listaxID');
                $("#txtIdEditar").val(a[0].id);
                $("#nombrecorto").val(a[0].NombreCorto);
                $("#montoinicial").val(a[0].Monto_Inicial);
                $("#empresa").val(a[0].Empresa);
                $("#nombre").val(a[0].Nombre);
            });

            $(".idEstado").click(function () {
                if ($(this).attr("estado") == 1) {
                    estadoAJAX(this.id, "./Obras/Obra_actualizaEstado", 2);
                } else
                if ($(this).attr("estado") == 2) {
                    estadoAJAX(this.id, "./Obras/Obra_actualizaEstado", 1);
                }
            });

            $(".idEliminar").click(function () {
                estadoAJAX(this.id, "./Obras/Obra_actualizaEstado", 0);
            });

        };

        return {
            init: function () {
//                plugins();
                eventos();
                initDatatables();
                CargaInicial();
            }
        };
    }();
</script>
