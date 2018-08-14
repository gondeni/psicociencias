<?php
	/***********************************************************************************************************************
	****		SE CREA UN LISTADO DE CARACTERES PROHIBIDOS Y SUSTITUDIOS PARA LA SUBIDA DE PDFS Y OTROS            ****
	****		ARCHIVOS QUE POSTERIORMENTE TIENEN QUE SER REFERENCIADOS MEDIANTE UN LINK			    ****		 
	***********************************************************************************************************************/
	
		$caracteresProhibidos = array("á","é","í","ó","ú","ç","ƒ","ê","î","ò","–","„"," ","-",",",";",":","/","'","Ó","Á","À");	
		$caracteresSustitutos = array("a","e","i","o","u","A","E","I","O","U","n","N","_","_","_","_","_","_","_","_","_","_");	
		
		//$caracteresProhibidos = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú",",",";",":","-","ñ","Ñ"," ","~");
		//$caracteresSustitutos = array("a","e","i","o","u","A","E","I","O","U","_","_","_","_","n","N","_","_");
	
	/***********************************************************************************************************************
	****		AQUI ACABA EL LISTADO DE CARACTERES PROHIBIDOS Y SUSTITUIDOS				            ****
	***********************************************************************************************************************/


	/*****************************************************************************************************/
	/****	LA SIGUIENTE FUNCIÓN RECORTA UNA CADENA A UNA LONGITUD MÁXIMA, EVITANDO EL CORTE DE **********/
	/****	PALABRASY FINALIZANDO CON PUNTOS SUSPENSIVOS SI ES NECESARIO .	******************************/
	/*****************************************************************************************************/

	function recortarCadena($cadena, $longMax) {
		$cadena = trim($cadena);
		$longitudDeCadena = strlen($cadena);
		if ($longitudDeCadena > $longMax) {
			$recorteInicial = substr($cadena, 0, $longMax);
			$posicionUltimoEspacio = strrpos($recorteInicial, " ");
			$cadenaFinal = substr($recorteInicial, 0, $posicionUltimoEspacio)."...";
		} else {
			$cadenaFinal = $cadena;
		}
		return ($cadenaFinal);
	}

	/*****************************************************************************************************/
	/*****	LAS SIGUIENTES FUNCIONES SE USAN PARA CODIFICAR Y DESCODIFICAR CONTRASE„AS.	**************/
	/*****************************************************************************************************/

	function codificaClave($cadenaOriginal) {
		$cadenaCodificada = "";
		$longitudDeCadena = strlen($cadenaOriginal);
		for ($i = 0; $i < $longitudDeCadena; $i++) {
			$caracter = base64_encode(substr($cadenaOriginal, $i, 1));
			$cadenaCodificada .= $caracter;
		}
		$cadenaCodificada = base64_encode($cadenaCodificada);
		return $cadenaCodificada;
	}

	function descodificaClave($cadenaCodificada) {
		$cadenaCodificada = base64_decode($cadenaCodificada);
		$longitudDeCadena = strlen($cadenaCodificada);
		$cadenaDescodificada = "";
		for ($i = 0; $i < $longitudDeCadena; $i+=4) {
			$subcadena = substr($cadenaCodificada, $i, 4);
			$caracter = base64_decode($subcadena);
			$cadenaDescodificada .= $caracter;
		}
		return $cadenaDescodificada;
	}

	/********************************************************************************************************/ 
	/****	LA SIGUIENTE FUNCION GENERA UNA CADENA ALEATORIA. RECIBE TRES ARGUMENTOS OBLIGATORIOS. **********/
	/****	EL PRIMERO ES EL NUMERO MINIMO DE CARACTERES QUE TENDRA LA CADENA. EL SEGUNDO ES EL *************/
	/****	NUMERO MAXIMO DE CARACTERES QUE TENDRA LA CADENA Y EL TERCERO DETERMINA SI LAS LETRAS  **********/
	/****	EMPLEADAS SERAN SOLO MAYUSCULAS O TAMBIEN MINUSCULAS.  					*********/
	/********************************************************************************************************/

	function getRandomString() {
		/* Se requieren tres argumentos. Se determina el número de estos y, si no es el adecuado,
		  se dispara un error fatal de usuario. */
		$numeroDeArgumentos = func_num_args();
		if ($numeroDeArgumentos != 3) {
			echo "Esta función requiere tres argumentos.<br />";
			trigger_error("Se necesitan tres argumentos.", E_USER_ERROR);
		} else {
			/* Se cargan los argumentos en una matriz para trabajar con ellos como los elementos de la misma. */
			$argumentos = func_get_args();
			/* Se convierten los dos primeros argumentos a enteros. Estos deben determinar el número mínimo
			  y máximo de caracteres que contendrá la cadena aleatoria. Deben ser valores enteros positivos. */
			settype($argumentos[0], "integer");
			settype($argumentos[1], "integer");
			$argumentos[0] = abs($argumentos[0]);
			$argumentos[1] = abs($argumentos[1]);
			$minimo = min($argumentos[0], $argumentos[1]);
			$maximo = max($argumentos[0], $argumentos[1]);
			/* El número mínimo de caracteres debe ser menor o igual que el máximo. Si no, se dispara un error fatal. */
			if ($minimo > $maximo) {
				echo "El valor \'m&iacute;nimo\' tiene que ser menor o igual que el \'m&aacute;ximo\'.<br />";
				trigger_error("El valor \'m&iacute;nimo\' tiene que ser menor o igual que el \'m&aacute;ximo\'.", E_USER_ERROR);
			}
			/* El tercer argumento debe ser una X para determinar que solo se incluyan letras mayúsculas
			  (además, por supuesto, de dígitos, guión y guión bajo) o una x, para determinar que las
			  letras puedan ser mayúsculas o minúsculas. Si no es uno de estos dos, se dispara un error fatal. */
			if ($argumentos[2] !== "X" && $argumentos[2] !== "x") {
				echo "El valor del tercer argumento debe ser \'X\' o \'x\'.<br />";
				trigger_error("El valor del tercer argumento debe ser \'X\' o \'x\'.", E_USER_ERROR);
			}
			/* La longitud de la cadena quedará comprendida entre los valores mínimo y máximo. */
			$longitudDeCadena = rand($minimo, $maximo);
			/* Se crea una matriz con todos los posibles caracteres a usar en la cadena aleatoria. */
			$matrizDeCaracteres = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "_", "_", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"); // 62 elementos.
			/* En base al tercer argumento, se determina que elementos de la matriz podrán formar parte de la cadena aleatoria. */
			if ($argumentos[2] === "X") {
				$elementos = 37;
			} else {
				$elementos = 61;
			}
			/* Se inicializa la cadena y se crea mediante un bucle, que se repite tantos ciclos como caracteres
			  se ha determinado que tendrá la cadena. En cada ciclo se añade un nuevo caracter, extraido al azar
			  de la matriz al efecto, a la cadena. */
			$cadena = "";
			for ($contador = 0; $contador < $longitudDeCadena; $contador++) {
				$elementoAleatorio = rand(0, $elementos);
				$cadena .= $matrizDeCaracteres[$elementoAleatorio];
			}
		}
		/* Se devuelve la cadena como resultado de la función. */
		return $cadena;
	}

	/* *********************************************************************************************************************************************
	 * *********************************************************************************************************************************************																																		****
	 * ***	AQUI EMPIEZA LA FUNCION QUE GENERA Y ENVIA CORREOS ELECTRONICOS.								********																	****
	 * ***	Las matriz de correos para destinatarios principales es indexada, pero cada elemento es una asociativa, donde la clave		********
	 * ***	tiene la direccion y el valor el nombre del destinatario. La matriz de CC tiene como valor de cada elemento un correo para CC.	********															****
	 * ***	La matriz $matrizDeOrigen tiene dos elementos. El que tiene clave "nombre", con el valor el nombre de la empresa gestora	********
	 * ***	y el que tiene clave "correo" con el correo de la empresa gestora.								********															****
	 * ****************************************************************************************************************************************** */

	function enviarCorreoElectronico($matrizDeDestinatariosPrincipales, $asunto, $titular, $cadenaDeMensaje, $matrizDeCC, $procesoGenerador, $idDeEmpresaDestino, $matrizDeFicherosAdjuntos = array()) {
		global $conexion; // Para grabar el historico.
		global $nombreDeLaEmpresaGestora;
		global $correoParaGestion;

	// Si la empresa de destino está dada de baja, no se envía ni graba nada.
		if ($idDeEmpresaDestino > "0") {
			$abandonarProceso = false;
			$consulta = "SELECT ";
			$consulta .= "sigue_vigente ";
			$consulta .= "FROM ";
			$consulta .= "maestro_de_empresas ";
			$consulta .= "WHERE ";
			$consulta .= "id_de_empresa = '".$idDeEmpresaDestino."';";
			$hacerConsulta = mysql_query($consulta, $conexion);
			if (mysql_num_rows($hacerConsulta) == 0) {
				$abandonarProceso = true;
			} else {
				if (mysql_result($hacerConsulta, 0, "sigue_vigente") == "N")
					$abandonarProceso = true;
			}
			@mysql_free_result($hacerConsulta);
			if ($abandonarProceso) return;
		}
	// Fin de comprobación de si la empresa destinataria está vigente.

		if (isset($matrizDeOrigen))	unset($matrizDeOrigen);
		$matrizDeOrigen = array();
		$matrizDeOrigen["nombre"] = $nombreDeLaEmpresaGestora;
		$matrizDeOrigen["correo"] = $correoParaGestion;
		
	// Comprobamos si hay destinatarios principales.
		if (count($matrizDeDestinatariosPrincipales) == 0) return; // Si no hay destinatarios, no hay correo.
			
	// Recortamos los límites de las cadenas recibidas.
		$asunto = trim($asunto);
		$titular = trim($titular);
		$cadenaDeMensaje = trim($cadenaDeMensaje);

		global $URL_imagenDeCorreo;
		global $PAIS_deOrigen;

	// Variables de encabezado y pie de correos.
		$encabezadoGeneral = "";
		$encabezadoGeneral .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
		$encabezadoGeneral .= "<html xmlns='http://www.w3.org/1999/xhtml'>";
		$encabezadoGeneral .= "<head>";
		$encabezadoGeneral .= "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-15' />";
		$encabezadoGeneral .= "</head>";
		$encabezadoGeneral .= "<body>";
		$encabezadoGeneral .= "<div style='text-align:left; padding:10px; font-size:16px; font-family:Arial,Tahoma,Verdana; color:blue; ";
		$encabezadoGeneral .= "border-top:3px solid #DBDBDB; border-left:3px solid #DBDBDB; border-bottom: 1px solid #808080; border-right: 1px solid #808080;'>";
		$encabezadoGeneral .= $titular;
		$encabezadoGeneral .= "</div><br /><br />";
		$encabezadoGeneral .= "<div style='font-family:Arial,Tahoma,Verdana,sans-serif; font-size:12px; color:#000 !important; text-align:justify;'>";
		$pieGeneral = "";
		$pieGeneral .= "</div><br /><br />";
		if ($PAIS_deOrigen == "es") {
			$pieGeneral .= "<p style='font-family:Arial,Tahoma,Verdana,sans-serif; font-size:10px; color:#000 !important; text-align:justify;'>";
			$pieGeneral .= "Este correo electrónico y la información contenida en el mismo es de carácter confidencial y está sometida al secreto profesional, ";
			$pieGeneral .= "dirigiéndose exclusivamente al destinatario mencionado en el encabezamiento, cuyos datos forman parte de un fichero responsabilidad ";
			$pieGeneral .= "de ENTORNO DE GESTIÓN DOCUMENTAL, S.L. con dirección en CL IGLESIA Nº11 3º, CP 28220, MAJADAHONDA (Madrid) y cuya finalidad ";
			$pieGeneral .= "es contactar con el titular de los datos a través del correo electrónico. Le informamos que cuenta con los derechos ARCO, ";
			$pieGeneral .= "que podrá ejercitar en la dirección arriba indicada o mediante el envío de un e-mail, adjuntando fotocopia de su DNI. ";
			$pieGeneral .= "Si el receptor de la comunicación no fuera el destinatario, le informamos que cualquier divulgación, copia,  distribución o utilización no ";
			$pieGeneral .= "autorizada de la información contenida en la misma está prohibida por la legislación vigente.";
			$pieGeneral .= "</p><br /><br />";
		}
		$pieGeneral .= "<img src='cid:sello' width='132' height='31' border='0' />";
		$pieGeneral .= "</body></html>";

		include_once("correos/class.phpmailer.php");
		$objetoDeCorreo = new phpMailer();
		$objetoDeCorreo->IsSMTP();
		$objetoDeCorreo->SMTPAuth = true;
		$objetoDeCorreo->Host = "127.0.0.1";
		$objetoDeCorreo->From = $matrizDeOrigen["correo"];
		$objetoDeCorreo->FromName = $matrizDeOrigen["nombre"];
		$objetoDeCorreo->AddEmbeddedImage($URL_imagenDeCorreo, "sello", $URL_imagenDeCorreo);
		$objetoDeCorreo->isHTML(true);
		$listaDeDestinatarios = ""; // Para el historico
		foreach ($matrizDeDestinatariosPrincipales as $destino) {
			$objetoDeCorreo->AddAddress(key($destino));
			$listaDeDestinatarios .= key($destino).","; // Para el historico
		}
		foreach ($matrizDeCC as $cc) $objetoDeCorreo->AddCC($cc);

		$objetoDeCorreo->Subject = $asunto;
		$mensaje = $encabezadoGeneral.$cadenaDeMensaje.$pieGeneral;

		$objetoDeCorreo->Body = $mensaje;
		$objetoDeCorreo->WordWrap = 50;
		
		foreach ($matrizDeFicherosAdjuntos as $adjunto)	$objetoDeCorreo->AddAttachment($adjunto);
		$resultado = $objetoDeCorreo->Send();
		unset($objetoDeCorreo);

	// A partir de aquí se graba el correo en el histórico (se pone como opcional, durante la implantación, pero tras esa fase, operará siempre).
		$cadenaDeMensaje = str_replace("'", "`", $cadenaDeMensaje);
		$consulta = "INSERT INTO historico_de_correos (";
		$consulta .= "fecha, ";
		$consulta .= "hora, ";
		$consulta .= "correos_de_destinatarios, ";
		$consulta .= "id_de_empresa, ";
		$consulta .= "asunto, ";
		$consulta .= "titular, ";
		$consulta .= "contenido, ";
		$consulta .= "testigo_de_adicionales, ";
		$consulta .= "proceso, ";
		$consulta .= "adjuntos";
		$consulta .= ") VALUES (";
		$consulta .= "'".date("Y-m-d")."', ";
		$consulta .= "'".date("H:i:s")."', ";
		$consulta .= "'".$listaDeDestinatarios."', ";
		$consulta .= "'".$idDeEmpresaDestino."', ";
		$consulta .= "'".$asunto."', ";
		$consulta .= "'".$titular."', ";
		$consulta .= "'".$cadenaDeMensaje."', ";
		$consulta .= "'".implode(",", $matrizDeCC)."', ";
		$consulta .= "'".$procesoGenerador."', ";
		$consulta .= "'".implode(",", $matrizDeFicherosAdjuntos)."'";
		$consulta .= ");";
		$hacerConsulta = mysql_query($consulta, $conexion);
		@mysql_free_result($hacerConsulta);
	}

	/* *************************************************************************************************************************************************
	 * ***	LA SIGUIENTE FUNCION LEE UN DATO PROCEDENTE DE UN FORMULARIO Y LO ALMACENA EN UNA VARIABLE, ELIMINANDO LOS CARACTERES POTENCIALMENTE	****
	 * ***	"CONFLICTIVOS" (LAS COMILLAS DOBLES Y SIMPLES) Y SUSTITUYÉNDOLOS POR ACENTOS AGUDOS. ADEMÁS CODIFICA EL RESULTADO EN UTF-8. RECIBE DOS	****
	 * ***	ARGUMENTOS: $campo ES EL NOMBRE DEL CAMPO COMO LLEGA DESDE UN FORMULARIO (EL ATRIBUTO NAME), $por_defecto ES EL VALOR QUE SE ATRIBUIRA	****
	 * ***	A LA VARIABLE SI EL CAMPO ESPERADO NO HA LLEGADO DESDE EL FORMULARIO LLAMANTE.								****
	 * ********************************************************************************************************************************************** */

	function leerCampoDeFormulario($campo, $por_defecto = "") {
		if (isset($_REQUEST[$campo])) {
			$variable = $_REQUEST[$campo];
			$caracteres = array("'", '"');
			$variable = str_replace($caracteres, "´", $variable);
			$variable = utf8_decode($variable);
		} else {
			$variable = $por_defecto;
		}
		return $variable;
	}
