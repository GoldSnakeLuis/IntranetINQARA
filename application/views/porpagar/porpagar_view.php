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
                            <div class="col-md-6">                            
                                <select data-plugin-selectTwo class="form-control" id="selectObra" data-plugin-options='{ "minimumInputLength": 2, "placeholder": "Elegir Obra", "allowClear": true}'>                                
                                    <option></option>                                    
                                </select>                            
                            </div>
                            <div class="col-md-6">
                                <input name="valorObra" id="valorObra" class="form-control text-uppercase" required disabled/>
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <button id="btnRegistrar" class="modal-with-form btn btn-default btn btn-info" disabled href="#mdlnuevo">Agregar Documento Por Pagar <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right" id="datatableButtons">
                            </div>
                        </div>
                        </br>
                        <table class="table table-bordered table-striped mb-none" id="tablaObras" style="width: 100%; text-align:center; align:center;  " >
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Ruc</th>
                                    <th>fecha</th>
                                    <th>Numero</th>
                                    <th>Detalle</th>
                                    <th>Monto</th>
                                    <th>Adelanto</th>
                                    <th>Detracción</th>
                                    <th>Saldo</th>
                                    <th>Banco</th>
                                    <th>N° Cuenta</th>
                                    <th>CCI</th>
                                    <th>Opci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">

                    <form name="frmReportePorPagar" id="frmReportePorPagar" action="./PorPagar/generaReporte" method="POST">
                        <input type="hidden" name="cboobra" id="rptIdObra">
                        <button class="btn btn-warning" id="btnGeneraReporte" disabled>Generar Reporte</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->    
</section>

<!--******************* MODALS Pago ******************-->   
<button id="btnAbreModalDetPorPag" class="modal-with-form btn btn-default btn btn-info" href="#mdlDetPorPagar" style="display: none;"></button>
<div id="mdlDetPorPagar" class="modal-block modal-block-sm mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">
                Pagos Realizados
                <button data-dismiss="modal" class="close modal-dismiss">×</button>
            </h2>

        </header>

        <div class="card-body">
            <form action="#" class="form-horizontal" id="frmPago" method="POST">
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label class="col-md-5 control-label" >Pago</label>
                        <input type="number" min="0" step="0.01" class="form-control" id="pago" name="pago" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="txtFecha">Fecha</label>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="txtFechaFactura" name="txtFecha" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                        </div>
                        <input type="hidden" id="cpd_id" name="cpd_id">
                    </div>
                    <div class="form-group col-md-1">
                        <label class="col-md-1 control-label" ></label>                        
                        <button type="submit" id="Guardar" class="Guardar btn btn-info btn-primary mt-3 mb-3 btn btn-success">+</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-striped mb-none" id="tablaDetReqEc" style="width: 100%; text-align:center; align:center;  " >
                <thead>
                    <tr>
                        <th>Pago</th>
                        <th>Fecha</th>
                        <th>Opt</th>
                    </tr>
                </thead>
                <tbody >

                </tbody>
            </table>                   
        </div>

    </section>
</div>
<!--******************* MODALS NUEVO ******************-->   
<!--id="copy_course_modal" tabindex="-1" role="dialog" aria-labelledby="copycourse" aria-hidden="true"-->
<div id="mdlnuevo" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Nueva Doc. Por Pagar</h2>
        </header>
        <form action="#" class="form-horizontal" id="frmPorPagar" method="POST">
            <div class="card-body">                 
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="nombreCortoObra">Obra</label>
                        <input name="nombreCortoObra" id="nombreCortoObra" class="form-control text-uppercase" data-plugin-maxlength placeholder="OBRA" required disabled/>
                        <input type="hidden" id="idObra" name="idObra">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="selectClienteProv">Cliente/Proveedor</label>
                        <select data-plugin-selectTwo class="form-control" id="selectClienteProv" name="selectClienteProv" data-plugin-options='{ "minimumInputLength": 2, "placeholder": "Elegir Cliente/Proveedor", "allowClear": true}'>                                                            
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group  col-md-4">
                    <input type="hidden" id="selectDoc" name="selectDoc" value="-1">
                </div>       
                <div class="form-row col-md-12">
                    <div class="form-group col-md-8">
                        <label for="txtDescripcion">Detalle</label>                            
                        <input name="txtDescripcion" id="txtDescripcion" class="form-control text-uppercase" data-plugin-maxlength maxlength="50" placeholder="Ejm: LOREM IPSUM" required/>                            
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtFechaFactura">Fecha</label>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <!--<input id="txtFechaFactura" name="txtFechaFactura" type="text" data-plugin-datepicker class="form-control">-->
                            <input id="txtFechaFactura" name="txtFechaFactura" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                        </div>
                    </div>
                </div>                    
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="txtNroFactura">Comprobante Nro</label>                            
                        <input name="txtNroFactura" id="txtNroFactura" class="form-control text-uppercase" data-plugin-maxlength maxlength="25" placeholder="Ejm: FAC-0001-00000000999" required/>                            
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTotalValor">Monto</label>
                        <input type="number" min="0" step="0.01" name="txtTotalValor" id="txtTotalValor" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 0000.00" required/>
                    </div>                        
                </div> 
                <div class="form-row col-md-12">    
                    <div class="form-group col-md-6">
                        <label for="txtadelantDir">Adelanto</label>
                        <input type="number" min="0" step="0.01" name="txtadelantDir" id="txtTotalValor" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 0000.00" required/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtAdelantoMat"> Detraccion</label>
                        <input type="number" min="0" step="0.01" name="txtAdelantoMat" id="txtAdelantoMat" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 0000.00" required/>
                    </div>
                </div>

                <div class="form-row col-md-12">

                    <div class="form-group col-md-4">
                        <label for="txtBanco">Banco</label>                            
                        <input name="txtBanco" id="txtBanco" class="form-control text-uppercase" data-plugin-maxlength maxlength="5" placeholder="Ejm: LOREM" required/>                            
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCuenta">Cuenta</label>                            
                        <input name="txtCuenta" id="txtCuenta" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 1111-2222-333" required/>                            
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCci">CCI</label>                            
                        <input name="txtCci" id="txtCci" class="form-control text-uppercase" data-plugin-maxlength maxlength="30" placeholder="Ejm: 1111-222-333333" required/>                            
                    </div>
                </div>
                <!--------------------------->                    
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

<script>
    var datatable;

    var APP = function () {

        var plugins = function () {
        }

        var initDatatables = function (idObra) {
            $.LoadingOverlay("show");
            $('#tablaObras').dataTable().fnDestroy();
            $acumulado = 0.0;
            $result = 0.0;
            datatable = $('#tablaObras').DataTable({
                "sAjaxSource": "./PorPagar/PorPagarPorPagar_listaxObra?cboobra=" + idObra,
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "scrollX": true,
                "aoColumns": [{"mData": null}, {"mData": "ruc"}, {"mData": "Fecha"}, {"mData": "Numero"}, {"mData": "Descripcion"}, {"mData": null}, {"mData": "AdelantoDirecto"}, {"mData": "AdelantoMateriales"}, {"mData": null}, {"mData": "banco"}, {"mData": "cuenta"}, {"mData": "cci"}, {"mData": null}],
                "aoColumnDefs": [
                    {
                        "aTargets": [0],
                        "mData": "Empresa",
                        "mRender": function (data, type, full) {
                            if (data != null) {
                                return '<center><span class="label label-sm label-info">' + data.Empresa + ' </span></center>';
                            } else {
                                return '<center><span class="label label-sm label-info"> - </span></center>';
                            }
                        }
                    },
                    {
                        "aTargets": [5],
                        "mRender": function (data, type, full) {
                            $MontoTotal = parseFloat(data.MontoTotal);
                            return '' + $MontoTotal + '';
                        }
                    },{
                        "aTargets": [8],
                        "mRender": function (data, type, full) {
                            $saldoResum = parseFloat(data.saldoResum);
                            return '<button class="btnDetReqEc modal-with-form btn btn-default btn btn-info" href="#mdlDetPorPagar" id="' + data.id + '">' + $saldoResum + '</button>';
                        }
                    },
                    {
                        "aTargets": [12],
                        "mData": "download_link",
                        "mRender": function (data, type, full) {
                            return '<a href="#" id="' + data.id + '" class="idEliminartodo dropdown-item text-1"> <i class="fa fa-trash-o"></i> Eliminar</a>';
                        }
                    }
                ],
                "order": [[2, "asc"]],
                drawCallback: function (settings, json) {
                    $(".btnDetReqEc").on('click', function (e) {
                        var idAmort = $(this).attr("id");
                        $("#cpd_id").val(idAmort);
                        $("#btnAbreModalDetPorPag").click();
                        initDatatablesDetAmor(idAmort);
                    });

                    $(".idEliminartodo").on('click', function (e) {
                        eliminarAJAX(this.id, "./PorPagar/PorPagar_Eliminar");
                    });
                    $.LoadingOverlay("hide");
                }

            });
            var botones = new $.fn.dataTable.Buttons(datatable, {
                buttons: [
                    {extend: "pdf", className: "btn btn-info", exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}}
                    , {extend: "excel", className: "btn btn-info", exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}}
                    , {extend: "print", className: "btn red btn-outline", text: "Imprimir", exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}}
                ],
            });
            botones.container().appendTo('#datatableButtons');
            $('div.dataTables_filter input').addClass('form-control input-sm');
        }
//-------------------DETALLE PAGOS------------
        var initDatatablesDetAmor = function (idAmort) {
            $.LoadingOverlay("show");
            $('#tablaDetReqEc').dataTable().fnDestroy();
            datatableDetAmort = $('#tablaDetReqEc').DataTable({
                "sAjaxSource": "./PorPagar/PorPagar_listaxPorPagar?id=" + idAmort,
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "dom": 'rtip',
                "aoColumns": [{"mData": "Pago"}, {"mData": "Fecha"}, {"mData": null}],
                "aoColumnDefs": [{
                        "aTargets": [2],
                        "mData": "download_link",
                        "mRender": function (data, type, full) {
                            return '<a href="#" id="' + data.id + '" class="idEliminar dropdown-item text-1"> <i class="fa fa-trash-o"></i></a>';
                        }
                    }],
                "order": [[1, "asc"]],
                drawCallback: function (settings, json) {
                    $.LoadingOverlay("hide");
                    $(".idEliminar").on('click', function (e) {
                        eliminarAJAX(this.id, "./PorPagar/Ctacte_Eliminar");
                    });
                }
            });
        }
//-------------------FIN DETALLE PAGOS------------
        var eventos = function () {
            registrarAJAX("#frmPorPagar", "./PorPagar/PorPagar_registrar");
            $("#selectObra").change(function () {
                var id = $("#selectObra").val();
                var a = buscarxidAJAX(id, '../Mantenedores/Obras/Obra_listaxID');
                monto = parseFloat(a[0].Monto_Inicial).toFixed(2);
                $("#valorObra").val(monto);
                initDatatables($("#selectObra").val());
                $("#nombreCortoObra").val($("#selectObra option:selected").text());
                $("#idObra").val($("#selectObra").val());
                $("#btnRegistrar").removeAttr('disabled');
                $("#rptIdObra").val($("#selectObra").val());
                $("#btnGeneraReporte").removeAttr('disabled');
            });

            // EVENTO ABRE MODAL
            $("#btnRegistrar").on('click', function (e) {
                //            LISTA DATOS SELET2 CLIENTES
                listadoClientes = buscarxidAJAX('0', "../Mantenedores/Clieprovs/Clieprovs_lista");
                listaClientesHTML = "<option></option>";
                $.each(listadoClientes, function (index, datos) {
                    listaClientesHTML += "<option value='" + datos.id + "'>" + datos.Razon_Social + " - " + datos.ruc + "</option>";
                    $("#selectClienteProv").html(listaClientesHTML);
                });
                //            FIN LISTA DATOS SELET2 CLIENTES

                $("#selectClienteProv").change(function () {
                    $("#btnRegistrar").removeAttr('disabled');
                });
            });
            // FIN EVENTO ABRE MODAL
        }

        var CargaInicial = function () {
            //            LISTA DATOS SELET2
            listadoObras = buscarxidAJAX('0', "../Mantenedores/Obras/Obras_lista");
            listaObrasHTML = "<option></option>";
            $.each(listadoObras, function (index, datos) {
                listaObrasHTML += "<option value='" + datos.id + "'>" + datos.NombreCorto + " - " + datos.Empresa + "</option>";
                $("#selectObra").html(listaObrasHTML);
            });
            //            FIN LISTA DATOS SELET2

            $("#Guardar").on('click', function (e) {

                var cpdid = $("#cpd_id").val();
                var txtFechaFactura = $("#txtFechaFactura").val();
                var pago = $("#pago").val();
                e.preventDefault();
                $.ajax({
                    url: './porPagar/Ctacte_registrar',
                    type: "POST",
                    data: {
                        cpd_id: cpdid,
                        txtFecha: txtFechaFactura,
                        pago: pago
                    },
                    beforeSend: function ()
                    {
                        $.LoadingOverlay("show");
                    },
                    success: function () {
                        $.LoadingOverlay("hide");
                        notificacion(1, "Registro realizado con éxito.");
                        $("#frmPago")[0].reset();
                        $('.modal-block .modal-dismiss').click();
                        datatable.ajax.reload();
                    },
                    error: function (e) {
                        $.LoadingOverlay("hide");
                        notificacion(0, "Hubo un error al realizar la acción solicitada.");
                        $("#frmPago")[0].reset();
                        $('.modal-block .modal-dismiss').click();
                    }
                });

            });

        };
        return {
            init: function () {
                eventos();
                CargaInicial();
            },
            recargaTabla: function () {
                //initDatatables();
                //CargaInicial();
            }
        };
    }();
</script>