<?php
    include ("../admin/includes/funciones_auxiliares.php");
    require_once ("../assets/php_mailer/PHPMailerAutoload.php");

	/* Establecemos un control de seguridad para eviar la llegada de correos en blanco por medio
	de la definición de contenido mínimo para ciertas variables. */
	if (!isset($_POST["apellidos"] ) || $_POST["apellidos"] == "") die();
	if (!isset($_POST["nombre"]) || $_POST["nombre"] == "") die();
	if (!isset($_POST["nacionalidad"]) || $_POST["nacionalidad"] == "") die();
	if (!isset($_POST["ciudad"]) || $_POST["ciudad"] == "") die();
	if (!isset($_POST["mail"]) || $_POST["mail"] == "") die();
	if (!isset($_POST["grado"]) || $_POST["grado"] == "") die();

    /* Se recuperan todas las variables del formulario */
    // Datos personales
    $apellidos = $_POST["apellidos"];
    $nombre = $_POST["nombre"];
    $fechaNac = $_POST["fechaNac"];
    $nacionalidad = $_POST["nacionalidad"];
    $domicilio = $_POST["domicilio"];
    $ciudad = $_POST["ciudad"];
    $provincia = $_POST["provincia"];
    $cp = $_POST["cp"];
    $dni = $_POST["dni"];
    $tlf = $_POST["tlf"];
    $movil = $_POST["movil"];
    $mail = $_POST["mail"];

    // Datos profesionales
    $grado = $_POST["grado"];
    $especialidad = $_POST["especialidad"];
    $fin = $_POST["fin"];
    $centro = $_POST["centro"];

    // Tasas
    $dia = $_POST["dia"];

    // Forma de pago
    $pago = $_POST["pago"];
    $titular = $_POST["titularBanco"];
    $banco = $_POST["banco"];
    $iban = $_POST["iban"];

    /* Cursos */
    // Psicoterapia Breve de Pareja
    if (isset($_POST["pbp"])) $pbp = $_POST["pbp"];
    $u_pbp = $_POST["u_pbp"];
    $m_pbp = $_POST["m_pbp"];

    // Integracion de Tecnicas en Psicoterapia
    //if (isset($_POST["ipb"])) $ipb = $_POST["ipb"];
    //$u_ipb = $_POST["u_ipb"];
    //$m_ipb = $_POST["m_ipb"];

    // Evaluacion Psicologica y Psicodiagnostico
    if (isset($_POST["epp"])) $epp = $_POST["epp"];
    $u_epp = $_POST["u_epp"];
    $m_epp = $_POST["m_epp"];

    // Clinica e Intervenciin en Trauma con EMDR
    if (isset($_POST["cit"])) $cit = $_POST["cit"];
    $u_cit = $_POST["u_cit"];
    $m_cit = $_POST["m_cit"];

	// Experto en Formación Superior en EMDR
    if (isset($_POST["fs"])) $fs = $_POST["fs"];
    $u_fs = $_POST["u_fs"];
    $m_fs = $_POST["m_fs"];

    // Trastornos de Personalidad
    if (isset($_POST["tp"])) $tp = $_POST["tp"];
    $u_tp = $_POST["u_tp"];
    $m_tp = $_POST["m_tp"];

    // Psicoterapia Breve
    if (isset($_POST["pb"])) $pb = $_POST["pb"];
    $u_pb = $_POST["u_pb"];
    $m_pb = $_POST["m_pb"];

    // Medicina Psicosomatica y Psicologia de la Salud
    if (isset($_POST["mp"])) $mp = $_POST["mp"];
    $u_mp = $_POST["u_mp"];
    $m_mp = $_POST["m_mp"];

    // Psicoterapia Breve con Niñdos y Adolescentes
    if (isset($_POST["pbn"])) $pbn = $_POST["pbn"];
    $u_pbn = $_POST["u_pbn"];
    $m_pbn = $_POST["m_pbn"];

    // Psicopatologia y Psiquiatria
    if (isset($_POST["pp"])) $pp = $_POST["pp"];
    $u_pp = $_POST["u_pp"];
    $m_pp = $_POST["m_pp"];

    // Psicofarmacologia Clinica
    if (isset($_POST["pc"])) $pc = $_POST["pc"];
    $u_pc = $_POST["u_pc"];
    $m_pc = $_POST["m_pc"];

    // Psicogeriatria
    if (isset($_POST["pg"])) $pg = $_POST["pg"];
    $u_pg = $_POST["u_pg"];
    $m_pg = $_POST["m_pg"];

    // Trastornos del Comportamiento Alimentario
    if (isset($_POST["tca"])) $tca = $_POST["tca"];
    $u_tca = $_POST["u_tca"];
    $m_tca = $_POST["m_tca"];

    /* Se recuperan los archivso recibidos desde el formlario y se guardan en un directorio temporal*/
	// Empezamos compobando si viene pdfs, y en caso de venir guardandolos en su directorio de destino
	$resultadoPdf = "";

	// Docuemnto 1
	if ($_FILES["f_titulo"]["size"] > 0) { //Nombre de archivo nuevo
		$tipo1 = $_FILES["f_titulo"]["type"];
		$error1 = $_FILES["f_titulo"]["error"];
		if (!strstr($tipo1,"pdf")) {
			$resultadoPdf .= "El documento T&iacute;tulo no es correcto.</br>";
		} else if ($error1 != 0) {
			$resultadoPdf .= $error1."</br>";
        } else {
            /* Se guarda en el directorio correspondiente el documento */
			$mNombrePdf1 = str_replace($caracteresProhibidos, $caracteresSustitutos, "1_".$_FILES["f_titulo"]["name"]);
			move_uploaded_file($_FILES["f_titulo"]["tmp_name"], "../adjuntos/".$mNombrePdf1);
            $mAdjunto1 = "../adjuntos/".$mNombrePdf1;
		}
	}

  	// Docuemnto 2
	if ($_FILES["f_foto"]["size"] > 0) { //Nombre de archivo nuevo
		$tipo2 = $_FILES["f_foto"]["type"];
		$error2 = $_FILES["f_foto"]["error"];
		if (!strstr($tipo2,"jpeg")) {
			$resultadoPdf .= "El documento Foto no es correcto.</br>";
		} else if ($error2 != 0) {
			$resultadoPdf .= $error2."</br>";
        } else {
			/* Se guarda en el directorio correspondiente el documento */
			$mNombrePdf2 = str_replace($caracteresProhibidos, $caracteresSustitutos, "2_".$_FILES["f_foto"]["name"]);
			move_uploaded_file($_FILES["f_foto"]["tmp_name"], "../adjuntos/".$mNombrePdf2);
            $mAdjunto2 = "../adjuntos/".$mNombrePdf2;
		}
	}

  	// Docuemnto 3
	if ($_FILES["f_dni"]["size"] > 0) { //Nombre de archivo nuevo
		$tipo3 = $_FILES["f_dni"]["type"];
		$error3 = $_FILES["f_dni"]["error"];
		if (!strstr($tipo3,"pdf")) {
			$resultadoPdf .= "El documento DNI / Pasaporte no es correcto.</br>";
		} else if ($error3 != 0) {
			$resultadoPdf .= $error3."</br>";
        } else {
            /* Se guarda en el directorio correspondiente el documento */
			$mNombrePdf3 = str_replace($caracteresProhibidos, $caracteresSustitutos, "3_".$_FILES["f_dni"]["name"]);
			move_uploaded_file($_FILES["f_dni"]["tmp_name"], "../adjuntos/".$mNombrePdf3);
            $mAdjunto3 = "../adjuntos/".$mNombrePdf3;
		}
	}

  	// Docuemnto 4
	if ($_FILES["f_matricula"]["size"] > 0) { //Nombre de archivo nuevo
		$tipo4 = $_FILES["f_matricula"]["type"];
		$error4 = $_FILES["f_matricula"]["error"];
		if (!strstr($tipo4,"pdf")) {
			$resultadoPdf .= "El documento Justificante de pago no es correcto.</br>";
		} else if ($error4 != 0) {
			$resultadoPdf .= $error4."</br>";
        } else {
            /* Se guarda en el directorio correspondiente el documento */
			$mNombrePdf4 = str_replace($caracteresProhibidos, $caracteresSustitutos, "4_".$_FILES["f_matricula"]["name"]);
			move_uploaded_file($_FILES["f_matricula"]["tmp_name"], "../adjuntos/".$mNombrePdf4);
            $mAdjunto4 = "../adjuntos/".$mNombrePdf4;
		}
	}

    /************************************************************************************************************/
    /******************************** Se comienza a montar el correo con PHPMailer ******************************/
    /************************************************************************************************************/

    $objetoCorreo = new PHPMailer;

    /* Comentar las siguientes lineas si el servidor no soporta smtp */
	//$objetoCorreo->isSMTP(); // Aquí se activaría el SMTP.
	//$objetoCorreo->Host = 'smtp.psicociencias.com'; // Estableceríamos el nombre del servidor SMTP.
	//$objetoCorreo->SMTPAuth = true; // Estableceríamos la autentitificación por SMTP
	//$objetoCorreo->SMTPSecure = 'tls'; // El protocolo de seguridad puede ser tls o ssl.
	//$objetoCorreo->Port = 587; // Estableceríamos el puerto de conexión.

	// Establecemos nuestros datos de correo.
	$objetoCorreo->Username = 'psicosomatica@psicociencias.com'; // Nuestra cuenta de correo.
	$objetoCorreo->Password = '@Psico2013'; // Nuestra contraseña.

	$objetoCorreo->setFrom($mail, $nombre.' '.$apellidos); // El remitente

  $objetoCorreo->addAddress('psicosomatica@psicociencias.com', 'Psicociencias'); // El destinatario
	//$objetoCorreo->addAddress('chrueda@gmail.com', 'Psicociencias'); // El destinatario
	$objetoCorreo->addReplyTo($mail, $nombre.' '.$apellidos); // La cuenta de respuesta (remitente)

	/* Para incluir ficheros adjuntos. Podemos incluir tantos como queramos, con la única limitación de la capacidad de envío
     de nuestro servidor, o, si la conocemos, la capacidad de recepción del destinatario. */
	$objetoCorreo->addAttachment($mAdjunto1);
	$objetoCorreo->addAttachment($mAdjunto2);
	$objetoCorreo->addAttachment($mAdjunto3);
	$objetoCorreo->addAttachment($mAdjunto4);

	/* Preparamos una imagen que vamos a incluir en el contenido de nuestro correo.
	Hablaremos de este método y sus parámetros en el próximo apartado. */
	//$objetoCorreo->AddEmbeddedImage('imagenes/imagen.png', 'logo_php', 'logo', 'base64', 'image/png');
	$objetoCorreo->isHTML(true); // Indicamos que el correo va a ser HTML.
	$objetoCorreo->CharSet = 'UTF-8'; // El correo irá codificado en UTF-8, para evitar problemas con letras acentuadas y otros caracteres especiales.

	$objetoCorreo->Subject = 'Inscripción desde la web'; // Indicamos el asunto

	/* Incluimos el cuerpo del correo en una variable. Contenido HTML puro y duro, con algo de CSS. */
	$correo = "<div style=\"width:90%;\">";
	$correo .= "<h2>Inscripci&oacute;n realizada desde la web</h2>";
	$correo .= "</div>";

	$correo .= "<h3><b>Datos personales del alumno</b></h3></hr>";
  $correo .= "<p><b>Apellidos</b>: ".$apellidos."</p>";
  $correo .= "<p><b>Nombre: </b>".$nombre."</p>";
  $correo .= "<p><b>Fecha de nacimiento: </b>".$fechaNac."</p>";
  $correo .= "<p><b>Nacionalidad: </b>".$nacionalidad."</p>";
  $correo .= "<p><b>Domicilio: </b>".$domicilio." ".$cp." ".$ciudad." (".$provincia.")</p>";
  $correo .= "<p><b>DNI / Pasaporte: </b>".$dni."</p>";
  $correo .= "<p><b>Tlf: </b>".$tlf."</p>";
  $correo .= "<p><b>Móvil: </b>".$movil."</p>";
  $correo .= "<p><b>eMail: </b>".$mail."</p>";

  $correo .= "</br>";
	$correo .= "<h3><b>Datos personales del alumno</b></h3></hr>";
  $correo .= "<p><b>Licenciatura / grado: </b>".$grado."</p>";
  $correo .= "<p><b>Especialidad: </b>".$especialidad."</p>";
  $correo .= "<p><b>Año de finalización: </b>".$fin."</p>";
  $correo .= "<p><b>Centro de trabajo: </b>".$centro."</p>";

  $correo .= "</br>";
	$correo .= "<h3><b>Tasas de inscripción y reserva de plaza</b></h3></hr>";
  $correo .= "<p><b>Fecha de pago: </b>".$dia."</p>";

	$correo .= "</br>";
	$correo .= "<h3><b>Forma de pago</b></h3></hr>";

	if ($pago == "P") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Domiciliación bancaria: 5 cuotas mensuales de 205 €</p>";
	} elseif ($pago == "E") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Efectivo (a abonar en las sesiones presenciales): 5 cuotas de 200 €</p>";
	} elseif ($pago == "D") {
		$correo .= "<p><b>Modalidad: </b>Distancia: Domiciliación bancaria: 9 cuotas mensuales de 100 €</p>";
	} elseif ($pago == "P2") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Domiciliación bancaria: 3 cuotas mensuales de 310 €</p>";
	} elseif($pago == "E2") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Efectivo (a abonar en las sesiones presenciales): 3 cuotas de 300 €</p>";
	} elseif ($pago == "P3") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Domiciliación bancaria: 3 cuotas mensuales de 365 €</p>";
	} elseif($pago == "E3") {
		$correo .= "<p><b>Modalidad: </b>Presencial: Efectivo (a abonar en las sesiones presenciales): 3 cuotas de 360 €</p>";
	} else {
		$correo .= "<p><b>Modalidad: </b>No se ha definido</p>";
	}

	if ($pago =="P" || $pago == "D" || $pago = "P2" || $pago = "P3") {
		$correo .= "<p><b>Titular de la cuenta: </b>".$titular."</p>";
		$correo .= "<p><b>Entidad bancaria: </b>".$banco."</p>";
		$correo .= "<p><b>Cuenta bancaria: </b>".$iban."</p>";
	}

    $correo .= "</br>";
	$correo .= "<h3><b>Cursos en los que se matricula</b></h3></hr>";

    /* Cursos */
    if ($pbp != "") {
		$correo .= "<p><b>Curso: </b>Psicoterapia Breve de Pareja, ";
		if ($u_pbp == "s")	$correo .= "Universitario, ";
		if ($m_pbp == "p") $correo .= "Presencial.</p>";
		if ($m_pbp == "d") $correo .= "Distancia.</p>";
	}

    if ($ipb != "") {
		$correo .= "<p><b>Curso: </b>Integración de Técnicas en Psicoterapia, ";
		if ($u_ipb == "s")	$correo .= "Universitario, ";
		if ($m_ipb == "p") $correo .= "Presencial.</p>";
		if ($m_ipb == "d") $correo .= "Distancia.</p>";
	}

    if ($epp != "") {
		$correo .= "<p><b>Curso: </b>Evaluación Psicológica y Psicodiagnóstico, ";
		if ($u_ipb == "d")	$correo .= "Universitario, ";
		if ($m_epp == "p") $correo .= "Presencial.</p>";
		if ($m_epp == "d") $correo .= "Distancia.</p>";
	}

    if ($cit != "") {
		$correo .= "<p><b>Curso: </b>Clínica e Intervención en Trauma con EMDR, ";
		if ($u_cit == "s")	$correo .= "Universitario, ";
		if ($m_cit == "p") $correo .= "Presencial.</p>";
		if ($m_cit == "s") $correo .= "Distancia.</p>";
	}

	if ($fs != "") {
		$correo .= "<p><b>Curso: </b>Experto en Formación Superior en EMDR, ";
		if ($u_fs == "s")	$correo .= "Universitario, ";
		if ($m_fs == "p") $correo .= "Presencial.</p>";
		if ($m_fs == "s") $correo .= "Distancia.</p>";
	}

    if ($tp != "") {
		$correo .= "<p><b>Curso: </b>Trastornos de Personalidad, ";
		if ($u_tp == "s")	$correo .= "Universitario, ";
		if ($m_tp == "p") $correo .= "Presencial.</p>";
		if ($m_tp == "d") $correo .= "Distancia.</p>";
	}

    if ($pb != "") {
		$correo .= "<p><b>Curso: </b>Psicoterapia Breve, ";
		if ($u_pb == "s")	$correo .= "Universitario, ";
		if ($m_pb == "p") $correo .= "Presencial.</p>";
		if ($m_pb == "d") $correo .= "Distancia.</p>";
	}

    if ($mp != "") {
		$correo .= "<p><b>Curso: </b>Medicina Psicosomática y Psicología de la Salud, ";
		if ($u_mp == "s")	$correo .= "Universitario, ";
		if ($m_mp == "p") $correo .= "Presencial.</p>";
		if ($m_mp == "d") $correo .= "Distancia.</p>";
	}

    if ($pbn != "") {
		$correo .= "<p><b>Curso: </b>Psicoterapia Breve con Niños y Adolescentes, ";
		if ($u_pbn == "s")	$correo .= "Universitario, ";
		if ($m_pbn == "p") $correo .= "Presencial.</p>";
		if ($m_pbn == "d") $correo .= "Distancia.</p>";
	}

    if ($pp != "") {
		$correo .= "<p><b>Curso: </b>Psicopatología y Psiquiatría, ";
		if ($u_pp == "s") $correo .= "Universitario, ";
		if ($m_pp == "p") $correo .= "Presencial.</p>";
		if ($m_pp == "d") $correo .= "Distancia.</p>";
	}

    if ($pc != "") {
		$correo .= "<p><b>Curso: </b>Psicofarmacología Clínica, ";
		if ($u_pc == "s") $correo .= "Universitario, ";
		if ($m_pc == "p") $correo .= "Presencial.</p>";
		if ($m_pc == "d") $correo .= "Distancia.</p>";
	}

    if ($pg != "") {
		$correo .= "<p><b>Curso: </b>Psicogeriatría, ";
		if ($u_pg == "s") $correo .= "Universitario, ";
		if ($m_pg == "p") $correo .= "Presencial.</p>";
		if ($m_pg == "d") $correo .= "Distancia.</p>";
	}

    if ($tca != "") {
		$correo .= "<p><b>Curso: </b>Trastornos del Comportamiento Alimentario, ";
		if ($u_tca == "s") $correo .= "Universitario, ";
		if ($m_tca == "p") $correo .= "Presencial.</p>";
		if ($m_tca == "d") $correo .= "Distancia.</p>";
	}

	 /* Completamops el correo con las variables de control */
	// Creamos variables de control */
	$ipDeAcceso= $_SERVER["REMOTE_ADDR"];
	$fechaDeAcceso = date("Y-m-d");
	$horaDeAcceso = date("H:i");

	//De llama a la función que recuepra la info del usuario de las funciones auxiliares.
	$info=detect();

	// Ponemos el correo que hemos diseñado como cuerpo.
	$objetoCorreo->Body = $correo;

	// Alternativa por si el destinatario no acepta correos HTML.
	//$objetoCorreo->AltBody = 'Tu programa de correo no acepta HTML. No sabes lo que te estás perdiendo. Visitanos en www.eldesvandejose.com.';

	/************************************************************************************************************/
    /******************************** Se comienza a montar el correo para el alumno *****************************/
    /************************************************************************************************************/

    $objetoCorreo2 = new PHPMailer;

    /* Comentar las siguientes lineas si el servidor no soporta smtp */
	//$objetoCorreo2->isSMTP(); // Aquí se activaría el SMTP.
	//$objetoCorreo2->Host = 'smtp.psicociencias.com'; // Estableceríamos el nombre del servidor SMTP.
	//$objetoCorreo2->SMTPAuth = true; // Estableceríamos la autentitificación por SMTP
	//$objetoCorreo2->SMTPSecure = 'tls'; // El protocolo de seguridad puede ser tls o ssl.
	//$objetoCorreo2->Port = 587; // Estableceríamos el puerto de conexión.

	// Establecemos nuestros datos de correo.
	$objetoCorreo2->Username = 'psicosomatica@psicociencias.com'; // Nuestra cuenta de correo.
	$objetoCorreo2->Password = '@Psico2013'; // Nuestra contraseña.

  $objetoCorreo2->setFrom('psicosomatica@psicociencias.com', 'Psicociencias'); // El remitente
	$objetoCorreo2->addAddress($mail, $nombre.' '.$apellidos); // El destinatario
  $objetoCorreo2->addReplyTo('psicosomatica@psicociencias.com', 'Psicociencias'); // La cuenta de respuesta (remitente)

	$objetoCorreo2->isHTML(true); // Indicamos que el correo va a ser HTML.
	$objetoCorreo2->CharSet = 'UTF-8'; // El correo irá codificado en UTF-8, para evitar problemas con letras acentuadas y otros caracteres especiales.

	$objetoCorreo2->Subject = 'Inscripción en curso'; // Indicamos el asunto

	/* Incluimos el cuerpo del correo en una variable. Contenido HTML puro y duro, con algo de CSS. */
	$correo2 = "<div style=\"width:90%;\">";
	$correo2 .= "<h2>Inscripci&oacute;n realizada desde la web de la Sociedad Española de Medicina Psicosomática y Psicoterapia</h2>";
	$correo2 .= "</div>";
	$correo2 .= "<p>Estimado/a ".$nombre.",</p>";
	$correo2 .= "<p>Hemos recibido su solicitud de inscripción en uno de nuestros cursos. ";
	$correo2 .= "Una vez hayamos revisado los datos y documentación recibidos nos pondremos en contacto con usted para confirmarle la matrícula</p>";
	$correo2 .= "<p>Le agradecemos la confianza depositada en la Sociedad Española de Medicina Psicosomática y Psicoterapia. </p>";
	$correo2 .= "<p>Atentamente, </p>";
	$correo2 .= "<p>Secretaría de la SEMPyP.</p>";

	// Ponemos el correo que hemos diseñado como cuerpo.
	$objetoCorreo2->Body = $correo2;

	// Enviamos el segundo correo
	$objetoCorreo2->send();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="KaYmEpWWAZKV4HgxuuF3nSL7X/T54CmjG1rauo56kNY=" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sociedad Espa&ntilde;ola de Medicina Psicosom&aacute;tica y Psicoterapia</title>
<meta name="keywords" content="Psicociencias. Master en psicologia clinica y psicoteratia. Cursos psicologia. formacion en psicologia. " />
<meta name="description" content="Sociedad Espa&ntilde;ola de Medicina Psicosom&aacute;tica y Psicoterapia" />
<!-- Inicio de carga de elementos de Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../includes/bootstrap/js/bootstrap.min.js"></script>
<!-- Fin de carga de elementos de Bootstrap -->
<link href="../css/generales.css" rel="stylesheet" type="text/css" />
<link href="../css/menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include("../cabecera.php"); ?>
	<?php include("../menu.php"); ?>

	<div id="breadcrumbBox">
		<div class="contenedor">
			<ol class="breadcrumb">
				<li><a href="../index.php">Inicio</a></li>
				<li class="active">Inscripciones</a></li>
			</ol>
		</div>
	</div>

	<div id="TODO">
		<div class="contenedor">
			<div id="SECCION">

				<div class="page-header">
					<h1>Formulario de inscripci&oacute;n <small>2017-2018</small></h1>
				</div>

					<div class="panel panel-verde">
						<div class="panel-heading">
							<h3 class="panel-title">Resultado de su envío</h3>
						</div>
						<div class="panel-body">
							<?php

								if ($resultadoPdf != "") echo "Resultado: ".$resultadoPdf;

								if(!$objetoCorreo->send()) {
									echo "<h2>No se pudo enviar el mensaje</h2></br>";
									echo "Detalles del error: ".$objetoCorreo->ErrorInfo,"</br></br>";
									echo "Disculpe las molestias.";
									echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
								} else {
									echo "<h2>Se ha enviado su formulario correctamente</h2></br>";
									echo "En breve se pondr&aacute; en contacto con usted la Secretar&iacute;a de la SEMPyP.</br></br>";
									echo "Muchas gracias.";
									echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
								}
							?>
						</div>
					</div>

			</div>
		</div>
	</div>
	<?php include("../pie.php"); ?>
</body>
</html>
