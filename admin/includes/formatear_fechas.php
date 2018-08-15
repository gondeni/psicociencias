<?php
function formatear_fecha($fecha, $opc)
{
    $fecha = str_replace('/', '-', $fecha);
    if ($fecha != null) {
        if ($opc == 1)
            return date('d/m/Y', strtotime($fecha));
        else
            return date('Y-m-d', strtotime($fecha)); //Error de formato
    } else
        return;
}

function formatear_datetime($fecha, $opc)
{
  $fecha = str_replace('/', '-', $fecha);
    if ($fecha != null) {
        if ($opc == 1)
            return date('H:i d/m/Y', strtotime($fecha));
        else
            return date('Y-m-d H:i:s', strtotime($fecha)); //Error de formato
    } else
        return;

}

?>
