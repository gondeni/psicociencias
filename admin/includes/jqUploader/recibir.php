<?php
	include ("../../includes/config.php");

	/* Conexion con base de datos. 
	$conexion = new PDO('mysql:host=localhost;dbname=jquploader;charset=UTF8', 'root', '');
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

	// Incluimos la clase RecoveryClass
	include_once 'php/RecoveryClass.php';

	// Creamos un objeto de la clase RecoveryClass
	$objetoDeArchivos = new RecoveryClass($_POST["cadenaDeDatos"]);

	/* Definimos la conexión a base de datos (pasándole la que hemos creado en este script), 
	y las estructuras de las tablas. La tabla de archivos es obligatoria. Las otras dos 
	pueden usarse o no, dependiendo del diseño y necesidades del formulario donde incorporamos 
	el plugin. 
	$objetoDeArchivos->setConexion($conexion);
	$objetoDeArchivos->setTablaDeArchivos(array(
		"nombreDeTabla"=>"archivos_enviados", 
		"clavePrimaria"=>"id", 
		"campoDeIdDeEnvio"=>"id_de_envio", 
		"campoDeNombreDeArchivo"=>"nombre_de_archivo", 
		"campoDeNombreOriginalDeArchivo"=>"nombre_de_original", // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
		"campoDeTipoDeArchivo"=>"tipo", // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
		"campoDePesoDeArchivo"=>"peso" // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
	)); */
	
	/* CH: Defino la tabla en la que vamos a trabajar para integrarlo en mi CMS. */
	$objetoDeArchivos->setConexion($conexion);
	$objetoDeArchivos->setTablaDeArchivos(array(
		"nombreDeTabla"=>"maestro_de_imagenes", 
		"clavePrimaria"=>"id_de_foto", 
		"campoDeIdDeEnvio"=>"id_de_envio", 
		"campoDeNombreDeArchivo"=>"nombre_de_foto", 
		"campoDeNombreOriginalDeArchivo"=>"nombre_de_original", // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
		"campoDeTipoDeArchivo"=>"tipo_de_foto", // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
		"campoDePesoDeArchivo"=>"peso_de_foto", // Este campo es opcional. Si no lo quieres, pon una cadena vacía "".
		"campoDeEstadoDeImagen"=>"estado_de_imagen", // Este campo personalizado de la tabla de CH.
		"campoDeFechaDeCreacion"=>"fecha_de_creacion", // Este campo personalizado de la tabla de CH.
		"campoDeUsuarioDeCreacion"=>"usuario_de_creacion" // Este campo personalizado de la tabla de CH.
	));

	/* El siguiente método es opcional. Si en tu formulario no defines 
	campos complementarios para los archivos subidos con el plugin, 
	no uses este método. */
	$objetoDeArchivos->setTablaDeDatosComplementarios(array(
		"nombreDeTabla"=>"temporal_de_imagenes_datos", 
		"clavePrimaria"=>"id", 
		"campoDeIdDeArchivoAsociado"=>"archivo_asociado", 
		"campoDeNombreDeDato"=>"nombre_de_dato", 
		"campoDeValorDeDato"=>"valor_de_dato"
	));

	/* El siguiente método es opcional. Si en tu página no hay campos asociados al 
	plugin, no emplees este método. */
	$objetoDeArchivos->setTablaDeDatosDeLaPagina(array(
		"nombreDeTabla"=>"temporal_de_imagenes_otros", 
		"clavePrimaria"=>"id", 
		"campoDeIdDeEnvio"=>"id_de_envio", 
		"campoDeNombreDeCampo"=>"nombre_de_campo", 
		"campoDeValorDeCampo"=>"valor_de_campo"
	));

	/* Recuperamos las tres matrices que han llegado por POST. 
	Esto sólo necesitamos hacerlo si queremos usarlas en otro proceso personalizado adicional.
	Si sólo queremos grabar los archivos enviados y sus datos adicionales usando la clase RecoveryClass, no los necesitaremos. */
	$matrizDeArchivos = $objetoDeArchivos->getArchivos();
	$matrizDeComplementarios = $objetoDeArchivos->getComplementarios();
	$matrizDeDatosDePagina = $objetoDeArchivos->getCamposDePagina();

	$fallo = $objetoDeArchivos->saveFiles('ficheros_enviados'); // indicador de si ha habido fallo
	$resultado = array("procesado"=>($fallo)?"N":"S");
	$resultado = json_encode($resultado);

	echo $resultado;
	
	/*********************************************************************************************************************************/
	/*********************************************************   FIN DEL PLUGIN ORIGINAL *********************************************/
	/*********************************************************************************************************************************/
	
	/*********************************************************************************************************************************/
	/*********************************************************************************************************************************/	
	/* CH: a partir de este momento se crea un añadido al plugin original para normalizar la información de almacenada en las tres tablas
	del plugin en el maestro de imagenes del CMS, es decir, dejarlo todo en una tabla para facilitar su manejo y evitar modificar todo
	el comportamiento del CMS, pues este trabaja con una sola tabla. Una vez unificado, se vacian las tablas secundarios del plugin que se
	entenderan, por tanto, como temporales */
	
	//Obtenemos el ultimo id_de_elemento grabado de la tabla temporal_de_imagenes_otros donde ha sido almacenado
	$consulta = "SELECT * ";
	$consulta .= "FROM temporal_de_imagenes_otros ";
	$consulta .= "WHERE nombre_de_campo = :nombreDeCampo ";
	$consulta .= "ORDER BY id DESC";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":nombreDeCampo", "id_de_trabajo"); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$elementoGrabado = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	$idDeEnvio = $elementoGrabado["id_de_envio"];
	$idDeElemento = $elementoGrabado["valor_de_campo"];
	
	/* Con el id_de_envio recuperamos la/s imagen/es grabadas en el maestro_de_imagenes a las que le vamos a actualizar los datos con
	los valores de las tablas temporales antes de borrarlas. */
	$matrizDeImagenes = array();
	$consulta = "SELECT id_de_foto, id_de_envio, nombre_de_original ";
	$consulta .= "FROM maestro_de_imagenes ";
	$consulta .= "WHERE id_de_envio = :idDeEnvio;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeEnvio", $idDeEnvio); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeImagenes = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	foreach ($matrizDeImagenes as $clave=>$imagen) {
		
		// A cada imagen le asignamos el id_de_elemento
		$matrizDeImagenes[$clave]["id_de_elemento"] = $idDeElemento;
		
		// A continuación, obtenemos los datos de temporal_de_imagenes_datos para cada imagen y los asignamos
		$matrizDeDatos = array();
		$consulta = "SELECT * ";
		$consulta .= "FROM temporal_de_imagenes_datos ";
		$consulta .= "WHERE archivo_asociado = :idDeElemento;";
		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
		$hacerConsulta->bindParam(":idDeElemento", $imagen["id_de_foto"]); // Se asigna una variable para la consulta.
		$hacerConsulta->execute(); // Se ejecuta la consulta.
		$matrizDeDatos = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
		$hacerConsulta->closeCursor(); // Se libera el recurso.
		
		foreach ($matrizDeDatos as $dato) {
			if ($dato["nombre_de_dato"] == "alt") $matrizDeImagenes[$clave]["alt_de_imagen"] = $dato["valor_de_dato"];
			if ($dato["nombre_de_dato"] == "descripcion") $matrizDeImagenes[$clave]["descripcion_de_imagen"] = $dato["valor_de_dato"];
		}
							
	}
	
	/* Este este punto contamos con los datos necesarios en la matriz para hacer el UPDATE correspondiente a cada elemento. */
	foreach ($matrizDeImagenes as $imagen) {
		
		$consulta = "UPDATE maestro_de_imagenes ";
		$consulta .= "SET id_de_elemento = :idDeElemento, ";
		$consulta .= "galeria_propietaria = :galeriaPropietaria, ";
		$consulta .= "descripcion_de_imagen = :descripcionDeImagen, ";
		$consulta .= "alt_de_imagen = :altDeImagen ";
		$consulta .= "WHERE id_de_foto = :idDeFoto;";
		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
		$hacerConsulta->bindParam(":idDeFoto", $imagen["id_de_foto"]);
		$hacerConsulta->bindParam(":idDeElemento", $imagen["id_de_elemento"]);
		$hacerConsulta->bindValue(":galeriaPropietaria", "maestro_de_portfolio");
		$hacerConsulta->bindParam(":descripcionDeImagen", $imagen["descripcion_de_imagen"]);
		$hacerConsulta->bindParam(":altDeImagen", $imagen["alt_de_imagen"]);
		$hacerConsulta->execute(); // Se ejecuta la consulta.
		$hacerConsulta->closeCursor(); // Se libera el recurso.
				
	}
	
	/* Por ultiumo vaciamos las tablas temporales. */
	$consulta = "TRUNCATE temporal_de_imagenes_datos;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	$consulta = "TRUNCATE temporal_de_imagenes_otros;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$hacerConsulta->closeCursor(); // Se libera el recurso.	
	
	/*********************************************************************************************************************************/
	/*********************************************************************************************************************************/	
?>
