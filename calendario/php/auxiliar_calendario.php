<?php
include('../../includes/config_ini.php');

try {

  // Returning array
  $events = array();

  // Prepare and execute query
  $consulta = "SELECT * FROM `sesiones`";
  $hacerConsulta = $conexion->prepare($consulta);
  $hacerConsulta->execute();
  $sesiones = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC);

  // echo "<pre/>";
  // vaR_dump($sesiones);
  // die();

  foreach ($sesiones as $keySesion => $sesion){

    $sesiones[$keySesion]['nombre_de_curso'] = '';

    $consulta = "SELECT `idDeCurso`,`nombreDeCurso` FROM `cursos`";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
    $cursos = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC);

    foreach($cursos as $curso){
      if($curso['idDeCurso'] == $sesiones[$keySesion]['id_de_curso']){
        $sesiones[$keySesion]['nombre_de_curso'] = $curso['nombreDeCurso'];
      }
    }



    // Fetch results
    $e = array();
    $e['id_de_sesion'] = $sesiones[$keySesion]['id_de_sesion'];
    $e['id_de_curso'] = $sesiones[$keySesion]['id_de_curso'];
    $e['title'] = $sesiones[$keySesion]['nombre_de_curso'];
    $e['start'] = $sesiones[$keySesion]['fecha_de_sesion'];
    $e['end'] = $sesiones[$keySesion]['fecha_de_sesion'];
    $e['allDay'] = true;

    // Merge the event array into the return array
    array_push($events, $e);
  }

  // Output json for our calendar
  $fp = fopen('../json/sesiones.json', 'wa+');
  fwrite($fp, json_encode($events));
  fclose($fp);

  exit();

} catch (PDOException $e){
  echo $e->getMessage();
}





?>
