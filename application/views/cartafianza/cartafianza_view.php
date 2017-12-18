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
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <button id="btnRegistrar" class="modal-with-form btn btn-default btn btn-info" disabled href="#mdlnuevo">Agregar Carta Fianza <i class="fa fa-plus"></i></button>
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
                                    <th>Fiel Cmpl</th>
                                    <th>N° CF</th>
                                    <th>Gasto</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>                                    
                                    <th>Opci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody >

                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <form name="frmReporte" id="frmReporte" action="./generaReporte" method="POST">
                            <input type="hidden" name="idObra" id="rptIdObra">
                            <button class="btn btn-warning" id="btnGeneraReporte" disabled>Generar Reporte</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>


    <!--******************* MODALS NUEVO ******************-->   
    <!--id="copy_course_modal" tabindex="-1" role="dialog" aria-labelledby="copycourse" aria-hidden="true"-->
    <div id="mdlnuevo" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Nueva Carta Fianza</h2>
            </header>
            <form action="#" class="form-horizontal" id="frmCartaFianza" method="POST">
                <div class="card-body">                 
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="nombreCortoObra">Obra</label>
                            <input name="nombreCortoObra" id="nombreCortoObra" class="form-control text-uppercase" data-plugin-maxlength placeholder="OBRA" required disabled/>
                            <input type="hidden" id="idObra" name="idObra">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="txtFielCumplimiento">Fiel Cumplimiento</label>                            
                            <input name="txtFielCumplimiento" id="txtFielCumplimiento" class="form-control text-uppercase" data-plugin-maxlength maxlength="100" placeholder="Ejm: FAC-0001-00000000999" required/>                            
                        </div>
                        <div class="form-group col-md-12">
                            <label for="txtNroCarta">Nro Cara Fianza</label>                            
                            <input name="txtNroCarta" id="txtNroCarta" class="form-control text-uppercase" data-plugin-maxlength maxlength="25" placeholder="Ejm: FAC-0001-00000000999" required/>                            
                        </div>                    
                        <div class="form-group col-md-6">
                            <label for="txtFechaIni">Fecha Inicio</label>                            
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <!--<input id="txtFechaFactura" name="txtFechaFactura" type="text" data-plugin-datepicker class="form-control">-->
                                <input id="txtFechaIni" name="txtFechaIni" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtFechaFin">Fecha Fin</label>                            
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <!--<input id="txtFechaFactura" name="txtFechaFactura" type="text" data-plugin-datepicker class="form-control">-->
                                <input id="txtFechaFin" name="txtFechaFin" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">

                            </div>
                        </div>
                    </div>                                        
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="txtGastoFinanciero">Gasto Financiero</label>
                            <input type="number" min="0" step="0.01" name="txtGastoFinanciero" id="txtGastoFinanciero" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 0000.00" required/>
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


<!--******************* MODALS Pago ******************-->   
<button id="btnAbreModalDetCarta" class="modal-with-form btn btn-default btn btn-info" href="#mdlDetFecCarta" style="display: none;"></button>
<div id="mdlDetFecCarta" class="modal-block modal-block-sm mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">
                Fechas Renovación
                <button data-dismiss="modal" class="close modal-dismiss">×</button>
            </h2>

        </header>

        <div class="card-body">
            <form action="#" class="form-horizontal" id="frmPago" method="POST">
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="txtFecha">Inicio</label>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="txtFecha" name="txtFecha" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                        </div>
                        <input type="hidden" id="cpd_id" name="cpd_id">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFecha2">Final</label>                            
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="txtFecha2" name="txtFecha2" type="text" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                        </div>
                        <input type="hidden" id="cpd_id" name="cpd_id">
                    </div>
                </div>
                <div class="form-row col-md-12">
                        <div class="form-group col-md-11">
                            <label for="txtRenov">Monto Renovación</label>
                            <input type="number" min="0" step="0.01" name="txtRenov" id="txtRenov" class="form-control text-uppercase" data-plugin-maxlength maxlength="15" placeholder="Ejm: 0000.00" required/>
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
                        <th>Inicio</th>
                        <th>Final</th>
                        <th>Monto</th>
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
            datatable = $('#tablaObras').DataTable({
                "sAjaxSource": "./CartaFianza/CartaFianza_listaxidObra?idObra=" + idObra,
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "scrollX": true,
                "aoColumns": [{"mData": "id"}, {"mData": "FielCumplimiento"}, {"mData": "numero"}, {"mData": "gastofinac"},  {"mData": null }, {"mData": "fechavencimiento"}, {"mData": null}],
                "aoColumnDefs": [
                    {
                        "aTargets": [6],
                        "mRender": function (data, type, full) {
                            return '<a href="#" id="' + data.id + '" class="idEliminartodo dropdown-item text-1"> <i class="fa fa-trash-o"></i> Eliminar</a>';
                        }
                    },
                    {
                        "aTargets": [4],
                        "mRender": function (data, type, full) {
                            $saldoResum = parseFloat(data.saldoResum);
                            return '<button class="btnDetCarta modal-with-form btn btn-default btn btn-info" href="#mdlDetFecCarta" id="' + data.id + '">' + data.fechaemision + '</button>';
                        }
                    }
                ],
                "order": [[0, "desc"]],
                drawCallback: function (settings, json) {
                    $(".btnDetCarta").on('click', function (e) {
                        var idAmort = $(this).attr("id");
                        $("#cpd_id").val(idAmort);
                        $("#btnAbreModalDetCarta").click();
                        initDatatablesDetCarta(idAmort);
                    });
                    
                    $(".idEliminartodo").on('click', function (e) {
                        eliminarAJAX(this.id, "./CartaFianza/CartaFianza_Eliminar");
                    });
                    $.LoadingOverlay("hide");
                }
            });
            var botones = new $.fn.dataTable.Buttons(datatable, {
                buttons: [
                    {extend: "pdf", className: "btn btn-info", exportOptions: {columns: [1, 2, 3, 4, 5, 6]}}
                    , {extend: "excel", className: "btn btn-info", exportOptions: {columns: [1, 2, 3, 4, 5, 6]}}
                    , {extend: "print", className: "btn red btn-outline", text: "Imprimir", exportOptions: {columns: [1, 2, 3, 4, 5, 6]}}
                ],
            });
            botones.container().appendTo('#datatableButtons');
            $('div.dataTables_filter input').addClass('form-control input-sm');
        }

//-------------------DETALLE PAGOS------------

    var initDatatablesDetCarta = function (idAmort) {
            $.LoadingOverlay("show");
            $('#tablaDetReqEc').dataTable().fnDestroy();
            datatableDetAmort = $('#tablaDetReqEc').DataTable({
                "sAjaxSource": "./CartaFianza/CartaFianzaDet_listaxIDCF?id=" + idAmort,
                "sServerMethod": "POST",
                "sAjaxDataProp": "",
                "dom": 'rtip',
                "aoColumns": [{"mData": "fechaemision"}, {"mData": "fechavencimiento"}, {"mData": "monto"}, {"mData": null}],
                "aoColumnDefs": [{
                        "aTargets": [3],
                        "mData": "download_link",
                        "mRender": function (data, type, full) {
                            return '<a href="#" id="' + data.cartafianza_id + '" class="idEliminar dropdown-item text-1"> <i class="fa fa-trash-o"></i></a>';
                        }
                    }],
                "order": [[0, "asc"]],
                drawCallback: function (settings, json) {
                    $.LoadingOverlay("hide");
                    $(".idEliminar").on('click', function (e) {
                        eliminarAJAX(this.id, "./CartaFianza/CartaFianzaDet_Eliminar");
                    });
                }
            });
        }

//-------------------FIN DETALLE PAGOS------------
        var eventos = function () {
            registrarAJAX("#frmCartaFianza", "./CartaFianza/CartaFianza_registrar");
            $("#selectObra").change(function () {
                initDatatables($("#selectObra").val());
                $("#nombreCortoObra").val($("#selectObra option:selected").text());
                $("#idObra").val($("#selectObra").val());
                $("#btnRegistrar").removeAttr('disabled');
                $("#rptIdObra").val($("#selectObra").val());
                $("#btnGeneraReporte").removeAttr('disabled');
            });
            
        }

        var CargaInicial = function () {
            //            LISTA DATOS SELET2 OBRAS
            listadoObras = buscarxidAJAX('0', "./Mantenedores/Obras/Obras_lista");
            listaObrasHTML = "<option></option>";
            $.each(listadoObras, function (index, datos) {
                listaObrasHTML += "<option value='" + datos.id + "'>" + datos.NombreCorto + " - " + datos.Empresa + "</option>";
                $("#selectObra").html(listaObrasHTML);
            });
            //            FIN LISTA DATOS SELET2 OBRAS 
            $("#Guardar").on('click', function (e) {
                var cpdid = $("#cpd_id").val();
                var txtFecha = $("#txtFecha").val();
                var txtFecha2 = $("#txtFecha2").val();
                var txtRenov = $("#txtRenov").val();
                e.preventDefault();
                $.ajax({
                    url: './CartaFianza/CartaFianzaDet_registrar',
                    type: "POST",
                    data: {
                        cpd_id: cpdid,
                        txtFecha: txtFecha,
                        txtFecha2: txtFecha2,
                        txtRenov: txtRenov
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
//                plugins();
                eventos();
                //initDatatables();
                CargaInicial();
            }
        };
    }();
</script>