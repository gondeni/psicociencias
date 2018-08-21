<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	include_once ("../includes/funciones_auxiliares.php"); //Se incluyen las funciones auxiliares, una sola vez.

	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];

	/* Se establece la p�gina de retorno */
	$paginaDeRetorno = "cursos.php";

	/* Se recogen las variables que vienen de la p�gina de alta  */
	$nombre_de_curso = htmlentities($_POST["nombre_de_curso"]);
	$id_de_seccion = $_POST["id_de_seccion"];
	$descripcion_de_curso = $_POST["descripcion_de_curso"];
	$modalidad_de_curso = $_POST["modalidad_de_curso"];
	$color_calendario = $_POST["color"];
	$id_de_sede = $_POST["id_de_sede"];
	$sesiones_de_curso = $_POST["sesiones_de_curso"];
	$fechas_de_curso = $_POST["fechas_de_curso"];
	$horarios_de_curso = $_POST["horarios_de_curso"];
	$ficha_master = $_POST["ficha_master"];
	$tituloTab1 = $_POST["tituloTab1"];
	$tituloTab2 = $_POST["tituloTab2"];
	$tituloTab3 = $_POST["tituloTab3"];
	$tituloTab4 = $_POST["tituloTab4"];
	$tituloTab5 = $_POST["tituloTab5"];
	$tituloTab6 = $_POST["tituloTab6"];
	$contenidoTab1 = $_POST["contenidoTab1"];
	$contenidoTab2 = $_POST["contenidoTab2"];
	$contenidoTab3 = $_POST["contenidoTab3"];
	$contenidoTab4 = $_POST["contenidoTab4"];
	$contenidoTab5 = $_POST["contenidoTab5"];
	$contenidoTab6 = $_POST["contenidoTab6"];
	$orden_de_curso = $_POST["orden_de_curso"];
	$estado_de_curso = $_POST["estado_de_curso"];
	$fecha_de_creacion = date("Y-m-d");

	/* Se procesa la imagen si estaes recibida. */
	if ($_FILES["imagen_de_curso"]["size"] > 0) {
		$nombreDeImagen = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["imagen_de_curso"]["name"]);
		$erroresEnImagen = "";
		if ($_FILES["imagen_de_curso"]["size"] > 2097152){ // > 2MB
			$erroresEnImagen .= "El archivo enviado es demasiado grande.";
		}
		if (!strpos($_FILES["imagen_de_curso"]["type"], "jp")){
			$erroresEnImagen .= "El formato de la imagen no es adecuado.";
		}
		if ($_FILES["imagen_de_curso"]["error"] != 0){
			$erroresEnImagen .= "Se ha producido un error en el env&iacute;o de la imagen.";
		}
		if ($erroresEnImagen == ""){
			list($anchura, $altura) = getimagesize($_FILES["imagen_de_curso"]["tmp_name"]); // Las dimensiones originales.
			if ($anchura > 1600 || $altura > 800) $erroresEnImagen = "La imagen es demasiado grande.";
		}
		/* Si no se han producido errores se determina el tipo de imagen que es y se graba en el disco. */
		if ($erroresEnImagen == ""){
			$original = imagecreatefromjpeg($_FILES["imagen_de_curso"]["tmp_name"]);
			imagejpeg($original, "../../imagenes/banner/".$nombreDeImagen);
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $nombreDeEmpresa?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">

          <?php include("../menu.php"); ?>
          <?php include("../menu_top.php"); ?>

          <!-- CONTENIDO PRINCIPAL -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nuevo curso: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

											<?php
												/* Se define la consulta SQL */
												$consulta = "INSERT INTO cursos (";
												$consulta .= "nombreDeCurso, ";
												$consulta .= "idDeSeccion, ";
												$consulta .= "descripcionDeCurso, ";
												$consulta .= "tituloTab1, ";
												$consulta .= "contenidoTab1, ";
												$consulta .= "tituloTab2, ";
												$consulta .= "contenidoTab2, ";
												$consulta .= "tituloTab3, ";
												$consulta .= "contenidoTab3, ";
												$consulta .= "tituloTab4, ";
												$consulta .= "contenidoTab4, ";
												$consulta .= "tituloTab5, ";
												$consulta .= "contenidoTab5, ";
												$consulta .= "tituloTab6, ";
												$consulta .= "contenidoTab6, ";
												$consulta .= "modalidad, ";
												$consulta .= "color_calendario, ";
												$consulta .= "sesionesPresenciales, ";
												$consulta .= "fichaMaster, ";
												$consulta .= "sede, ";
												$consulta .= "fechas, ";
												$consulta .= "horarios, ";
												$consulta .= "orden, ";
												$consulta .= "estado, ";
												$consulta .= "banner";
												$consulta .= ") VALUES (";
												$consulta .= ":nombreDeCurso, ";
												$consulta .= ":idDeSeccion, ";
												$consulta .= ":descripcionDelCurso, ";
												$consulta .= ":tituloTab1, ";
												$consulta .= ":contenidoTab1, ";
												$consulta .= ":tituloTab2, ";
												$consulta .= ":contenidoTab2, ";
												$consulta .= ":tituloTab3, ";
												$consulta .= ":contenidoTab3, ";
												$consulta .= ":tituloTab4, ";
												$consulta .= ":contenidoTab4, ";
												$consulta .= ":tituloTab5, ";
												$consulta .= ":contenidoTab5, ";
												$consulta .= ":tituloTab6, ";
												$consulta .= ":contenidoTab6, ";
												$consulta .= ":modalidad, ";
												$consulta .= ":color_calendario, ";
												$consulta .= ":sesionesPresenciales, ";
												$consulta .= ":fichaMaster, ";
												$consulta .= ":sede, ";
												$consulta .= ":fechas, ";
												$consulta .= ":horarios, ";
												$consulta .= ":orden, ";
												$consulta .= ":estado, ";
												$consulta .= ":banner";
												$consulta .= ");";
												$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
												$hacerConsulta->bindParam(":nombreDeCurso", $nombre_de_curso);
												$hacerConsulta->bindParam(":idDeSeccion", $id_de_seccion);
												$hacerConsulta->bindParam(":descripcionDelCurso", $descripcion_de_curso);
												$hacerConsulta->bindParam(":tituloTab1", $tituloTab1);
												$hacerConsulta->bindParam(":contenidoTab1", $contenidoTab1);
												$hacerConsulta->bindParam(":tituloTab2", $tituloTab2);
												$hacerConsulta->bindParam(":contenidoTab2", $contenidoTab3);
												$hacerConsulta->bindParam(":tituloTab3", $tituloTab3);
												$hacerConsulta->bindParam(":contenidoTab3", $contenidoTab3);
												$hacerConsulta->bindParam(":tituloTab4", $tituloTab4);
												$hacerConsulta->bindParam(":contenidoTab4", $contenidoTab4);
												$hacerConsulta->bindParam(":tituloTab5", $tituloTab5);
												$hacerConsulta->bindParam(":contenidoTab5", $contenidoTab5);
												$hacerConsulta->bindParam(":tituloTab6", $tituloTab6);
												$hacerConsulta->bindParam(":contenidoTab6", $contenidoTab6);
												$hacerConsulta->bindParam(":modalidad", $modalidad_de_curso);
												$hacerConsulta->bindParam(":color_calendario", $color_calendario);
												$hacerConsulta->bindParam(":sesionesPresenciales", $sesiones_de_curso);
												$hacerConsulta->bindParam(":fichaMaster", $ficha_master);
												$hacerConsulta->bindParam(":sede", $id_de_sede);
												$hacerConsulta->bindParam(":fechas", $fechas_de_curso);
												$hacerConsulta->bindParam(":horarios", $horarios_de_curso);
												$hacerConsulta->bindParam(":orden", $orden_de_curso);
												$hacerConsulta->bindParam(":estado", $estado_de_curso);
												$hacerConsulta->bindParam(":banner", $banner_de_curso);
												$hacerConsulta->execute(); // Se ejecuta la consulta.
												$hacerConsulta->closeCursor(); // Se libera el recurso.

											?>

										<div class="row">
											<div class="col-md-2 col-sm-4 col-xs-12">.<img src="../imagenes/info.jpg" alt="info" class="img-rounded"></div>
											<div class="col-md-10 col-sm-8 col-xs-12">
												<br />
												<?php echo "<h2>Se ha grabado correctamente el art&iacute;culo del cat&aacute;logo.</h2>"; ?>
											</div>
										</div>

										<div class="row">
                      <br /><br /><br />
											&nbsp;&nbsp;<a href="cursos.php" class="btn btn-success">Aceptar</a>
										</div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- FIN CONTENIDO PRINCIPAL -->

          <?php include("../footer.php"); ?>

      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Sceript personalizados -->
    <script language="javascript" type="text/javascript">
			/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
			function retornar(){
				document.getElementById("formRetorno").submit();
			}
    </script>

	<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
	<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post" >
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
	</form>

  </body>
</html>
