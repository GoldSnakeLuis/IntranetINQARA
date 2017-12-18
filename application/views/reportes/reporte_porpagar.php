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
        <br/>
        <?php
//        print_r($info_obra[0]);
        ?>
        <table border="1" cellspacing="3" cellpadding="4" style="width: 100%;">
            <tr>
            <tr>
                                    <th>Empresa</th>
                                    <th>Ruc</th>
                                    <th>Fecha</th>
                                    <th>Numero</th>
                                    <th>Detalle</th>
                                    <th>Monto</th>
                                    <th>Adelanto</th>
                                    <th>Detracción</th>
                                    <th>Saldo</th>
                                    <th>Banco</th>
                                    <th>N° Cuenta</th>
                                    <th>CCI</th>
                                    
            </tr>
            <?php
            $acumulado=0.0; $acumulado3=0.0; $acumulado2=0.0; $Saldo=0.0;
            foreach ($porpagar as $key => $fila) {
                $acumulado = number_format((float) $fila->MontoTotal, 2, '.', '') + number_format((float) $acumulado, 2, '.', '');
                $acumulado2 = number_format((float)$fila->AdelantoDirecto, 2, '.', '') + number_format((float)$acumulado2, 2, '.', '');
                $acumulado3 = number_format((float)$fila->AdelantoMateriales, 2, '.', '') + number_format((float)$acumulado3, 2, '.', '');
                
                $Saldo= number_format((float)$fila->saldoResum, 2, '.', '') + number_format((float)$Saldo, 2, '.', '');
                
                $index = ($key + 1) % 2;
                echo (($index == 0) ? '<tr bgcolor="#fff0da">' : '<tr bgcolor="#ffdba4">');
                echo '<td align="center">' . $fila->Empresa . '</td>';
                echo '<td align="center">' . $fila->ruc . '</td>';
                echo '<td align="center">' . $fila->Fecha . '</td>';
                echo '<td align="center">' . $fila->Numero . '</td>';
                echo '<td align="center">' . $fila->Descripcion . '</td>';
                echo '<td align="center">' . number_format((float) $fila->MontoTotal, 2, '.', '') . '</td>';
                echo '<td align="center">' . number_format((float) $fila->AdelantoDirecto, 2, '.', '') . '</td>';
                echo '<td align="center">' . number_format((float) $fila->AdelantoMateriales, 2, '.', '') . '</td>';
                echo '<td align="center">' . number_format((float) $fila->saldoResum, 2, '.', '') . '</td>';
                echo '<td align="center">' . $fila->banco . '</td>';
                echo '<td align="center">' . $fila->cuenta . '</td>';
                echo '<td align="center">' . $fila->cci . '</td>';
                echo '</tr>';
            }
            
                echo '<tr bgcolor="#013ADF">';
                echo '<td COLSPAN="5" align="center">TOTAL</td>';
                echo '<td align="center">' . $acumulado . '</td>';
                echo '<td align="center">' . $acumulado2 . '</td>';
                echo '<td align="center">' . $acumulado3 . '</td>';
                echo '<td align="center">' . $Saldo . '</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
            ?>
            
        </table>
    </body>
</html>
