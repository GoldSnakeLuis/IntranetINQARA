<!DOCTYPE html>
<html lang="es">
    <head> 
        <style>
            th{ background-color: #c37719; color: #FFFFFF;}
        </style>
    </head>
    <body>          
    <table border="0" cellspacing="0" cellpadding="1" style="width: 100%;">
    <tr> 
    <td width="50%"> 
        <table border="0" cellspacing="0" cellpadding="1">
            <tr>
                <td colspan="2"><img src="<?php echo URL_PUBLIC_IMG; ?>logo.png"></td>
                <td colspan="2"><h2><?php echo $titulo; ?></h2></td>
                <td colspan="2"></td>
            </tr>
            <tr><td colspan="6"></td></tr>
            <tr>
                <td><b>Entidad:</b></td><td><?php echo $info_obra[0]->Empresa ?></td>
            </tr>
            <tr>
                <td><b>Obra:</b></td><td colspan="5"><?php echo $info_obra[0]->Nombre ?></td>
            </tr>
            <tr>
                <td><b>Proceso:</b></td><td colspan="5"><?php echo $info_obra[0]->proceso ?></td>
            </tr>
            <tr>
                <td><b>Monto:</b></td><td><?php echo number_format((float) $info_obra[0]->Monto_Inicial, 2, '.', ''); ?></td>
                <td><b>Fecha:</b></td><td><?php echo $info_obra[0]->fechacontrato ?></td>
                <td colspan="2">&nbsp;</td>
            </tr>
        </table>
    </td> 
    <td width="50%"> 
        <table border="0" cellspacing="0" cellpadding="1">
            <tr>
                <td><br/><br/><br/><br/><br/></td>
            </tr>            
        </table>
        <table border="1" cellspacing="0" cellpadding="1">
            <tr>
                <th align="center" bgcolor="#013ADF">PRESUPUESTOS</th>
                <th align="center" bgcolor="#013ADF">MONTOS</th>
            </tr>
            <tr>
                <td align="center">Ofertado</td>
                <td align="center"><?php echo $presupuesto[0]->ofertado ?></td>
            </tr>
            <tr>
                <td align="center">Adicional</td>
                <td align="center"><?php echo $presupuesto[0]->adicional ?></td>
            </tr>
            <tr>
                <td align="center">Reintegros</td>
                <td align="center"><?php echo$presupuesto[0]->reintegros ?></td>
            </tr>
            <tr>
                <td align="center">Deductivo</td>
                <td align="center"><?php echo$presupuesto[0]->deductivos ?></td>
            </tr>
        </table>
     </td>
    </tr>    
           
    </table>
    
        
        <br/>
        <?php
//        print_r($info_obra[0]);
        ?>
        <table border="1" cellspacing="3" cellpadding="4" style="width: 100%;">
            <tr>
            <tr>
                <th COLSPAN="5">FACTURA</th>
                <th COLSPAN="2">CANCELACION</th>
                <th COLSPAN="2">RESUMEN</th>
                <th rowspan="2" >Detracci&oacute;n</th>
            </tr>
            <tr>
                <th align="center">Numero</th>
                <th align="center">Concepto</th>
                <th align="center">Monto</th>
                <th align="center">Deducción</th>
                <th align="center">Emisión</th>
                <th align="center">Monto</th>
                <th align="center">Fecha</th>
                <th align="center">Saldo</th>
                <th align="center">Acumulado</th>
            </tr>
            <?php
            $acumulado=0.0; $result=0.0; $Cancel=0.0; $Saldo=0.0;
            foreach ($porpagar as $key => $fila) {
                $acumulado = number_format((float) $fila->MontoTotal, 2, '.', '') + number_format((float) $acumulado, 2, '.', '');
                $result = number_format((float)$fila->monto_Obra, 2, '.', '') - number_format((float)$acumulado, 2, '.', '');
                $Cancel = number_format((float)$fila->MontoCan, 2, '.', '') + number_format((float)$Cancel, 2, '.', '');
                $Saldo= number_format((float)$fila->saldoResum, 2, '.', '') + number_format((float)$Saldo, 2, '.', '');
                
                $index = ($key + 1) % 2;
                echo (($index == 0) ? '<tr bgcolor="#fff0da">' : '<tr bgcolor="#ffdba4">');
                echo '<td align="center">' . $fila->Numero . '</td>';
                echo '<td align="center">' . $fila->Descripcion . '</td>';
                echo '<td align="center">' . number_format((float) $fila->MontoTotal, 2, '.', '') . '</td>';
                echo '<td align="center">' . number_format((float) $result , 2, '.', '') . '</td>';
                echo '<td align="center">' . $fila->Fecha . '</td>';
                echo '<td align="center">' . number_format((float) $fila->MontoCan, 2, '.', '') . '</td>';
                echo '<td align="center">' . $fila->fechaCan . '</td>';
                echo '<td align="center">' . number_format((float) $fila->saldoResum, 2, '.', '') . '</td>';
                echo '<td align="center">' . number_format((float) $acumulado , 2, '.', '') . '</td>';
                echo '<td align="center">' . $fila->Detraccion . '</td>';
                echo '</tr>';
            }
            
                echo '<tr bgcolor="#013ADF">';
                echo '<td COLSPAN="2" align="center">TOTAL</td>';
                echo '<td align="center">' . $acumulado . '</td>';
                echo '<td align="center">' . $result . '</td>';
                echo '<td></td>';
                echo '<td align="center">' . $Cancel . '</td>';
                echo '<td></td>';
                echo '<td align="center">' . $Saldo . '</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            ?>
            
        </table>
   </body>

</html>
