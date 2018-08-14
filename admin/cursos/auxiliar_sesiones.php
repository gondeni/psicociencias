<?php
include '../includes/config.php';

if(isset($_POST){
    switch($_POST['opt']){
        case 'nuevo':
        nuevaSesion($_POST['id_de_curso'],$_POST['fecha']);
        break;
        
        case 'borrar':
        borrarSesion($_POST['id_de_sesion']);
        break;

        default:
        break;
    }
}

function nuevaSesion($id_curso,$fecha){
    $consulta = "INSERT INTO `sesiones` (`id_de_curso`,`fecha_de_sesion`) VALUES (".$id_curso.",'".$fecha."');";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
}

function borrarSesion($id){
    $consulta = "DELETE FROM `sesiones` WHERE `id_de_sesion` = ".$id_sesion.";";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
}

?>