<?php
include '../includes/config.php';


if(isset($_POST)){
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
    global $conexion;

    $consulta = "SELECT COUNT(*) FROM `sesiones` WHERE `fecha_de_sesion` = '".$fecha."' AND `id_de_curso` = '".$id_curso."'";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
    $result = $hacerConsulta->fetch(\PDO::FETCH_NUM);

    if($result[0]=='0'){
        $consulta = "INSERT INTO `sesiones` (`id_de_curso`,`fecha_de_sesion`) VALUES (".$id_curso.",'".$fecha."')";
        $hacerConsulta = $conexion->prepare($consulta);
        $hacerConsulta->execute();
        echo 'true';
    }else{
        echo 'false';
    }


}

function borrarSesion($id){
    global $conexion;

    $consulta = "DELETE FROM `sesiones` WHERE `id_de_sesion` = ".$id.";";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
}

?>