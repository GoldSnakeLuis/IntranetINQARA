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
                                    <a id="btnRegistrar" class="modal-with-form btn btn-default btn btn-info" href="#mdlnuevo">Nuevo Presupuesto <i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 text-right" id="datatableButtons">
                            </div>
                        </div>
                        </br>
                        <table class="table table-bordered table-striped mb-none" id="tablaObras" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Obra</th>
                                    <th>Ofertado</th>
                                    <th>Adicional</th>
                                    <th>Reintegros</th>
                                    <th>Deductivo</th>
                                    <th>Estado</th>
                                    <th>Opci&oacute;n</th>
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
                <h2 class="card-title">Nuevo Presupuesto</h2>
            </header>
            <div class="card-body"> 
                <form action="#" class="form-horizontal" id="frmObra" method="POST">
                    
                     <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="selectObra">Obra</label>
                            <select data-plugin-selectTwo class="form-control" id="selectObra" name="selectObra" data-plugin-options='{ "minimumInputLength": 2, "placeholder": "Elegir Obra", "allowClear": true}'>                                                            
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-6 control-label" >Monto Ofertado</label>
                            <input type="number" class="form-control" id="ofertado" name="ofertado" required>
                        </div>
                    </div>                   
                    <div class="form-row col-md-12">
                        <div class="form-group  col-md-6">
                            <label class="col-md-6 control-label" >Monto Adicional</label>
                            <input type="number" class="form-control" id="adicional" name="adicional" required>
                        </div>
                        <div class="form-group  col-md-6">
                            <label class="col-md-6 control-label" >Monto Reintegros</label>
                            <input type="number" class="form-control" id="reintegros" name="reintegros" required>
                        </div>
                    </div>    
                    <div class="form-row col-md-12">
                        <div class="form-group  col-md-6">
                            <label class="col-md-6 control-label" >Monto Deductivo</label>
                            <input type="number" class="form-control" id="deductivos" name="deductivos" required>
                        </div>
                    </div> 
                    <input type="hidden" name="txtIdEditar" id="txtIdEditar">
                    <footer class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-info btn-primary mt-3 mb-3 btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-default modal-dismiss red btn-outline">Cancelar</button>
                            </div>
                        </div>
                    </footer>
                </form>

            </div>
        </section>
    </div>     
</section>



<script>
    var datatable;
    var APP = function () {

        var plugins = function () {
        }

        var initDatatables = function () {
            $.LoadingOverlay("show");
            datatable = $('#tablaObras').DataTable({
                "sAjaxSource": "./Presupuestos/Presupuesto_lista",
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "aoColumns": [{"mData": "id"}, {"mData": "Obra"}, {"mData": "ofertado"}, {"mData": "adicional"}, {"mData": "reintegros"}, {"mData": "deductivos"},{"mData": "estado"},{"mData": null}],
                "aoColumnDefs": [
                    {
                        "aTargets": [7],
                        "mData": "download_link",
                        "mRender": function (data, type, full) {
                            return '<center><div class="btn-group">' +
                                    '<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Acci&oacute;n <i class="fa fa-angle-down"></i></button>' +
                                    '<ul class="dropdown-menu pull-left" role="menu">' +
                                    '<li><a href="#" id="' + data.id + '" class="idEditar dropdown-item text-1"> <i class="fa fa-pencil"></i> Editar</a></li>' +
                                    '<li><a href="#" id="' + data.id + '" estado="' + data.estado + '" class="idEstado dropdown-item text-1"> <i class="fa fa-check"></i> Cambiar Estado</a>' +
                                    '<li><a href="#" id="' + data.id + '" estado="' + data.estado + '" class="idEliminar dropdown-item text-1"> <i class="fa fa-trash-o"></i> Eliminar</a></li>' +
                                    '</ul></div></center>';
                        }
                    },
                    {
                        "aTargets": [6],
                        "mData": "estado",
                        "mRender": function (data, type, full) {
                            if (data == 1) {
                                return '<center><span class="label label-sm label-info"> Activo </span></center>';
                            } else {
                                if (data == 2) {
                                    return '<center><span class="label label-sm label-danger"> Inactivo </span></center>';
                                }
                            }
                        }
                    }
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Filtrar resultados",
                },
                drawCallback: function (settings, json) {
                    CargaInicial();
                    $.LoadingOverlay("hide");
                }

            });

            var botones = new $.fn.dataTable.Buttons(datatable, {
                buttons: [
                    {extend: "pdf", className: "btn btn-info", exportOptions: {columns: [0, 1, 2, 3,4,5,6]}}
                    , {extend: "excel", className: "btn btn-info", exportOptions: {columns: [0, 1, 2, 3,4,5,6]}}
                    , {extend: "print", className: "btn red btn-outline", text: "Imprimir", exportOptions: {columns: [0, 1, 2, 3,4,5,6]}}
                ],
            });
            botones.container().appendTo('#datatableButtons');
            $('div.dataTables_filter input').addClass('form-control input-sm');
        }

        var eventos = function () {
            registrarAJAX("#frmObra", "./Presupuestos/Presupuesto_registrar");
            
           //            LISTA DATOS SELET2
                listadoClientes = buscarxidAJAX('0', "../Mantenedores/Obras/Obras_lista");
                listaClientesHTML = "<option></option>";
                $.each(listadoClientes, function (index, datos) {
                    listaClientesHTML += "<option value='" + datos.id + "'>" + datos.NombreCorto + "</option>";
                    $("#selectObra").html(listaClientesHTML);
                });
                //            FIN LISTA DATOS SELET2 
        }

        var CargaInicial = function () {

            $("#btnRegistrar").click(function () {
                $("#frmObra")[0].reset();
                $("#txtIdEditar").val(null);
            });

            $(".idEditar").click(function () {
                $("#btnRegistrar").click();
                var a = buscarxidAJAX(this.id, './Presupuestos/Presupuesto_listaxID');
                $("#txtIdEditar").val(a[0].id);
                $("#ofertado").val(a[0].ofertado);
                $("#adicional").val(a[0].adicional);
                $("#reintegros").val(a[0].reintegros);
                $("#deductivos").val(a[0].deductivos);
            });

            $(".idEstado").click(function () {
                if ($(this).attr("estado") == 1) {
                    estadoAJAX(this.id, "./Presupuestos/Presupuesto_actualizaEstado", 2);
                } else
                if ($(this).attr("estado") == 2) {
                    estadoAJAX(this.id, "./Presupuestos/Presupuesto_actualizaEstado", 1);
                }
            });

            $(".idEliminar").click(function () {
                estadoAJAX(this.id, "./Presupuestos/Presupuesto_actualizaEstado", 0);
            });

        };

        return {
            init: function () {
//                plugins();
                eventos();
                initDatatables();
                CargaInicial();
            }
            ,
            recargaTabla: function () {
                initDatatables();
                CargaInicial();
            }
        };
    }();
</script>
