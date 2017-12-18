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
                                </div>
                            </div>
                            <div class="col-md-6 text-right" id="datatableButtons">
                            </div>
                        </div>
                        </br>
                        <table class="table table-bordered table-striped mb-none" id="tablaObras" style="width: 100%; text-align:center; align:center;  " >
                            <thead>
                                <tr>
                                    <th COLSPAN="5">FACTURA</th>
                                    <th COLSPAN="2">CANCELACION</th>
                                    <th COLSPAN="2">RESUMEN</th>
                                    <th rowspan="2" >Detracci&oacute;n</th>
                                </tr>
                                <tr>
                                    <th>Numero</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Deducción</th>
                                    <th>Emisión</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Saldo</th>
                                    <th>Acumulado</th>
                                </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">

                    <form name="frmReporteControlPagos" id="frmReporteControlPagos" action="./PorCobrar/generaReporte" method="POST">
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
<button id="btnAbreModalDetAmort" class="modal-with-form btn btn-default btn btn-info" href="#mdlDetAmortizacion" style="display: none;"></button>
<div id="mdlDetAmortizacion" class="modal-block modal-block-sm mfp-hide">
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
            <table class="table table-bordered table-striped mb-none" id="tablaDetAmort" style="width: 100%; text-align:center; align:center;  " >
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
                "sAjaxSource": "./PorCobrar/PorCobrarAmortizacion_listaxObra?cboobra=" + idObra,
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "scrollX": true,
                "aoColumns": [{"mData": "Numero"}, {"mData": "Descripcion"}, {"mData": "MontoTotal"}, {"mData": null}, {"mData": "Fecha"}, {"mData": null}, {"mData": "fechaCan"}, {"mData": "saldoResum"}, {"mData": null}, {"mData": "Detraccion"}],
                "aoColumnDefs": [
                    {
                        "aTargets": [8],
                        "mRender": function (data, type, full) {
                            $acumulado = parseFloat(data.MontoCan) + parseFloat($acumulado);
                            return '' + $acumulado + '';
                        }
                    },
                    {
                        "aTargets": [3],
                        "mRender": function (data, type, full) {
                            $acumulado = parseFloat(data.MontoTotal) + parseFloat($acumulado);
                            $result = parseFloat(data.monto_Obra) - parseFloat($acumulado);
                            return '' + $result + '';
                        }
                    },
                    {
                        "aTargets": [5],
                        "mRender": function (data, type, full) {
                            return '<button class="btnDetAmort modal-with-form btn btn-default btn btn-info" href="#mdlDetAmortizacion" id="' + data.id + '">' + data.MontoCan + '</button>';
                        }
                    }
                ],
                "order": [[4, "asc"]],
                drawCallback: function (settings, json) {
                    $(".btnDetAmort").on('click', function (e) {
//                        $("#mdlDetAmortizacion").modal('show');
                        var idAmort = $(this).attr("id");
                        $("#cpd_id").val(idAmort);
                        $("#btnAbreModalDetAmort").click();
                        initDatatablesDetAmor(idAmort);
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
            $('#tablaDetAmort').dataTable().fnDestroy();
            datatableDetAmort = $('#tablaDetAmort').DataTable({
                "sAjaxSource": "./PorCobrar/PorCobrar_listaxAmortizacion?id=" + idAmort,
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
                        eliminarAJAX(this.id, "./PorCobrar/Ctacte_Eliminar");
                    });
                }
            });
        }
//-------------------FIN DETALLE PAGOS------------
        var eventos = function () {
            $("#selectObra").change(function () {
                var id = $("#selectObra").val();
                var a = buscarxidAJAX(id, '../Mantenedores/Obras/Obra_listaxID');
                monto = parseFloat(a[0].Monto_Inicial).toFixed(2);
                $("#valorObra").val(monto);
                initDatatables($("#selectObra").val());
                $("#rptIdObra").val($("#selectObra").val());
                $("#btnGeneraReporte").removeAttr('disabled'); 
            });
            
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
                //registrarAJAX("#frmPago", "./PorCobrar/Ctacte_registrar");
                
                var cpdid = $("#cpd_id").val();
                var txtFechaFactura = $("#txtFechaFactura").val();
                var pago = $("#pago").val();
                e.preventDefault();
                $.ajax({
                    url: '../PorCobrar/PorCobrar/Ctacte_registrar',
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