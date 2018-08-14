<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config_ini.php");
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////// Vamos a crear una herrramienta para codificar a uft-8 el contenido que proviene de ////////////
    ////////// tablas que anteriormente estaban codificadas en iso ///////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /* Se recuperan el campo de la tabla afectada  */
    //$nombreDeLaTabla = "cursos";
    //$idDeRegistro = "idDeCurso";
    //$nombreDelCampo = "horarios";
           
	//$matrizDeRegistros= array();
	//$consulta = "SELECT ".$idDeRegistro.", ".$nombreDelCampo." ";
	//$consulta .= "FROM ".$nombreDeLaTabla.";";
	//$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	//$hacerConsulta->execute(); // Se ejecuta la consulta.
	//$matrizDeRegistros = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	//$hacerConsulta->closeCursor(); // Se libera el recurso.
	//   
	///* A continuación, en un bucle, codificamos la cadena recibida y hacemos un UPDATE. */
	//foreach ($matrizDeRegistros as $registro) {
	//	/* Codificamos */
	//	$campoEnUtf8 = utf8_encode($registro[$nombreDelCampo]);
	//	
	//	/* Actualizamos en bd   */
	//	$consulta = "UPDATE ".$nombreDeLaTabla." ";
	//	$consulta .= "SET ";
	//	$consulta .= "".$nombreDelCampo." = :campoEnUtf8 ";
	//	$consulta .= "WHERE ".$idDeRegistro." = :idDeRegistro;";
	//	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	//	$hacerConsulta->bindParam(":idDeRegistro", $registro[$idDeRegistro]); 
	//	$hacerConsulta->bindParam(":campoEnUtf8", $campoEnUtf8); 
	//	$hacerConsulta->execute(); // Se ejecuta la consulta.
	//	$hacerConsulta->closeCursor(); // Se libera el recurso.
	//						
	//}
	
	//$matrizDeRegistros= array();
	//$consulta = "SELECT ".$idDeRegistro.", ".$nombreDelCampo." ";
	//$consulta .= "FROM ".$nombreDeLaTabla.";";
	//$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	//$hacerConsulta->execute(); // Se ejecuta la consulta.
	//$matrizDeRegistros = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	//$hacerConsulta->closeCursor(); // Se libera el recurso.	
	//
	///* A continuación, en un bucle, recodificamos la cadena recibida y hacemos un UPDATE. */
	//foreach ($matrizDeRegistros as $registro) {
	//	/* Codificamos */
	//	$campoEnUtf8 = utf8_decode($registro[$nombreDelCampo]);
	//	
	//	/* Actualizamos en bd   */
	//	$consulta = "UPDATE ".$nombreDeLaTabla." ";
	//	$consulta .= "SET ";
	//	$consulta .= "".$nombreDelCampo." = :campoEnUtf8 ";
	//	$consulta .= "WHERE ".$idDeRegistro." = :idDeRegistro;";
	//	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	//	$hacerConsulta->bindParam(":idDeRegistro", $registro[$idDeRegistro]); 
	//	$hacerConsulta->bindParam(":campoEnUtf8", $campoEnUtf8); 
	//	$hacerConsulta->execute(); // Se ejecuta la consulta.
	//	$hacerConsulta->closeCursor(); // Se libera el recurso.
	//						
	//}
	
	
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////// Vamos a crear una herrramienta para sustituir caracteres "raros" que nos han podido ///////////
    ////////// limpiuarse con la función anterior //////////////// ///////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
        
	/******************************************************************************************************
	****	SE CREA UN LISTADO DE CARACTERES PROHIBIDOS Y SUSTITUDIOS PARA LA SUBIDA DE PDFS Y OTROS   ****
	****	ARCHIVOS QUE POSTERIORMENTE TIENEN QUE SER REFERENCIADOS MEDIANTE UN LINK			       ****		 
	*******************************************************************************************************/
	
//	$caracteresProhibidos = array("\"");	
//	$caracteresSustitutos = array("&quot;");	 
//          
//    $nombreDeLaTabla = "cursos";
//    $idDeRegistro = "idDeCurso";
//    $nombreDelCampo = "nombreDeCurso";
//	
//	$matrizDeRegistros= array();
//	$consulta = "SELECT ".$idDeRegistro.", ".$nombreDelCampo." ";
//	$consulta .= "FROM ".$nombreDeLaTabla.";";
//	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
//	$hacerConsulta->execute(); // Se ejecuta la consulta.
//	$matrizDeRegistros = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
//	$hacerConsulta->closeCursor(); // Se libera el recurso.
//	
//	/* A continuación, en un bucle, se retocan las ?? por Ó y hacemos un UPDATE. */
//	foreach ($matrizDeRegistros as $registro) {
//		/* Reemplazamos */
//		$campoEnUtf8 = $registro[$nombreDelCampo];
//		$campoEnUtf8 = str_replace($caracteresProhibidos, $caracteresSustitutos, $campoEnUtf8);
//					
//		/* Actualizamos en bd   */
//		$consulta = "UPDATE ".$nombreDeLaTabla." ";
//		$consulta .= "SET ";
//		$consulta .= "".$nombreDelCampo." = :campoEnUtf8 ";
//		$consulta .= "WHERE ".$idDeRegistro." = :idDeRegistro;";
//		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
//		$hacerConsulta->bindParam(":idDeRegistro", $registro[$idDeRegistro]); 
//		$hacerConsulta->bindParam(":campoEnUtf8", $campoEnUtf8); 
//		$hacerConsulta->execute(); // Se ejecuta la consulta.
//		$hacerConsulta->closeCursor(); // Se libera el recurso.   
//	}


	/******************************************************************************************************
	****	LIMPIAMOS LAS ETIQUETAS HTML QUE PUEDA CONTENER EL TEXTO RECIBIDO EN LA VARIABLE           ****
	*******************************************************************************************************/
          
    $nombreDeLaTabla = "cursos";
    $idDeRegistro = "idDeCurso";
    $nombreDelCampo = "fichaMaster";
	
	$matrizDeRegistros= array();
	$consulta = "SELECT ".$idDeRegistro.", ".$nombreDelCampo." ";
	$consulta .= "FROM ".$nombreDeLaTabla.";";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeRegistros = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	/* A continuación, en un bucle, se retocan las ?? por Ó y hacemos un UPDATE. */
	foreach ($matrizDeRegistros as $registro) {
		/* Reemplazamos */
		$campo = $registro[$nombreDelCampo];
		$campo = strip_tags($campo);
					
		/* Actualizamos en bd   */
		$consulta = "UPDATE ".$nombreDeLaTabla." ";
		$consulta .= "SET ";
		$consulta .= "".$nombreDelCampo." = :campo ";
		$consulta .= "WHERE ".$idDeRegistro." = :idDeRegistro;";
		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
		$hacerConsulta->bindParam(":idDeRegistro", $registro[$idDeRegistro]); 
		$hacerConsulta->bindParam(":campo", $campo); 
		$hacerConsulta->execute(); // Se ejecuta la consulta.
		$hacerConsulta->closeCursor(); // Se libera el recurso.   
	}
	
?>