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
                <td colspan="2"><img src="<?php echo URL_PUBLIC_IMG; ?>logo.jpg"></td>
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
//        print_r($cartafianza);
        ?>
        <table border="1" cellspacing="3" cellpadding="4" style="width: 100%;">
            <tr>
                <th>CF</th>
                <th align="center">Fiel Cumplimiento</th>
                <th align="center"># Carta Fianza</th>
                <th align="center">Gasto</th>
                <th align="center">Monto</th>
                <th align="center">Fecha de emisión/ini. Renov.</th>
                <th align="center">Fecha de venc. y/o renov.</th>
            </tr>
            <?php
            $bandera = 0;
            $bandera_id =-1;
            foreach ($cartafianza as $key => $fila) {
                
                if($bandera_id != $fila->id){       
                    $index = ($bandera + 1) % 2;
                    echo (($index == 0) ? '<tr bgcolor="#fff0da">' : '<tr bgcolor="#ffdba4">');
                    echo '<td ROWSPAN="'.$fila->contar .'"></td>';
                    echo '<td ROWSPAN="'.$fila->contar .'">' . $fila->FielCumplimiento . '</td>';
                    echo '<td ROWSPAN="'.$fila->contar .'">' . $fila->numero . '</td>';
                    echo '<td ROWSPAN="'.$fila->contar .'">' . number_format((float) $fila->gastofinac, 2, '.', '') . '</td>';
                    $bandera = $bandera+1;
                }else{
                    $index = ($bandera-1 + 1) % 2;
                    echo (($index == 0) ? '<tr bgcolor="#fff0da">' : '<tr bgcolor="#ffdba4">');
                }
                echo '<td>' . number_format((float) $fila->monto, 2, '.', '') . '</td>';
                echo '<td>' . $fila->fechaemision . '</td>';
                echo '<td>' . $fila->fechavencimiento . '</td>';
                echo '</tr>';
                $bandera_id =$fila->id;
            }
            ?>
        </table>
    </body>
</html>
