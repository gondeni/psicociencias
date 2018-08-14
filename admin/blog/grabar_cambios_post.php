<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	include_once ("../includes/funciones_auxiliares.php"); //Se incluyen las funciones auxiliares, una sola vez.
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "blog.php";
	
	/* Se recogen las variables que vienen de la p‡gina de alta */
	$id_de_noticia = $_POST["id_de_noticia"];
	$nombre_de_noticia = htmlentities($_POST["titulo_de_noticia"]);
	$id_de_seccion = $_POST["id_de_seccion"];
	$cuerpo_de_noticia = $_POST["cuerpo_de_noticia"];
	if (isset($_POST["portada_de_noticia"]) && $_POST["portada_de_noticia"] == "on") {
		$portada_de_noticia = "S";
	} else {
		$portada_de_noticia = "N";
	}
	if (isset($_POST["destacado_de_noticia"]) && $_POST["destacado_de_noticia"] == "on") {
		$destacado_de_noticia = "S";
	} else {
		$destacado_de_noticia = "N";
	}
	$estado_de_noticia = $_POST["estado_de_noticia"];
	$boletin_de_noticia = $_POST["boletin_de_noticia"];
	$autor_de_noticia = $_POST["autor_de_noticia"];
	$keywords_de_noticia = $_POST["keywords_de_noticia"];
	
	/* Solo se nmodificará la imagen en caso de que se maruqe para borra o venga una nueva. */
			if ($_FILES["imagen_de_noticia"]["size"] == 0 && !isset($_POST["borrar_imagen"])) { // Si no se recibe imagen ni se ha marcado su eliminación
			$nombreDeImagen = $_POST["imagen_actual"];
		} elseif($_FILES["imagen_de_noticia"]["size"] == 0 && $_POST["borrar_imagen"] == "on") { // Si no se recibe imagen pero si se marca su eliminación
			$nombreDeImagen = "";
		} else { // Si llega una imagen nueva
			$nombreDeImagen = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["imagen_de_noticia"]["name"]);
			$erroresEnImagen = "";
			if ($_FILES["imagen_de_noticia"]["size"] > 1048576){ // > 1MB
				$erroresEnImagen .= "El archivo enviado es demasiado grande.";
			}
			if (!strpos($_FILES["imagen_de_noticia"]["type"], "jp")){
				$erroresEnImagen .= "El formato de la imagen no es adecuado.";
			}
			if ($_FILES["imagen_de_noticia"]["error"] != 0){
				$erroresEnImagen .= "Se ha producido un error en el env&iacute;o de la imagen.";
			}
			if ($erroresEnImagen == ""){
				list($anchura, $altura) = getimagesize($_FILES["imagen_de_noticia"]["tmp_name"]); // Las dimensiones originales.
				if ($anchura > 1600 || $altura > 1600) $erroresEnImagen = "La imagen es demasiado grande.";
			}
			/* Si no se han producido errores se determina el tipo de imagen que es y se graba en el disco. */
			if ($erroresEnImagen == ""){
				$original = imagecreatefromjpeg($_FILES["imagen_de_noticia"]["tmp_name"]);
				imagejpeg($original, "../../imagenes/noticias/".$nombreDeImagen);
			}
		}
		
	// PDFs-----------------------------------------------
	$nombre_de_pdf_1 = $_POST["nombre_de_pdf_1"];
	$nombre_de_pdf_2 = $_POST["nombre_de_pdf_2"];
	$nombre_de_pdf_3 = $_POST["nombre_de_pdf_3"];
	$nombre_de_pdf_4 = $_POST["nombre_de_pdf_4"];
	$nombre_de_pdf_5 = $_POST["nombre_de_pdf_5"];
		
	/* Comprobamos si viene pdfs, y en caso de venir guardandolos en su directorio de destino*/
	$resultadoPdf = "";
	
	// pdf 1
	if ($_FILES["pdf_1"]["size"] > 0) { 
		$tipo1 = $_FILES["pdf_1"]["type"];
		$error1 = $_FILES["pdf_1"]["error"];
		if ((!strstr($tipo1, "pdf")) || $error1 != 0) {
			$resultadoPdf .= "El documento enviado no es de tipo PDF o no ha llegado correctamente.";
		} else {
			/* Se guarda en el directorio correspondiente el documento PDF */
			$nombrePdf1 = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["pdf_1"]["name"]);
			move_uploaded_file($_FILES["pdf_1"]["tmp_name"], "../../pdf_noticias/".$nombrePdf1);
		}
	}
	
	// pdf 2
	if ($_FILES["pdf_2"]["size"] > 0) { 
		$tipo2 = $_FILES["pdf_2"]["type"];
		$error2 = $_FILES["pdf_2"]["error"];
		if ((!strstr($tipo2, "pdf")) || $error1 != 0) {
			$resultadoPdf .= "El documento enviado no es de tipo PDF o no ha llegado correctamente.";
		} else {
			/* Se guarda en el directorio correspondiente el documento PDF */
			$nombrePdf2 = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["pdf_2"]["name"]);
			move_uploaded_file($_FILES["pdf_2"]["tmp_name"], "../../pdf_noticias/".$nombrePdf2);
		}
	}
	
	// pdf 3
	if ($_FILES["pdf_3"]["size"] > 0) { 
		$tipo3 = $_FILES["pdf_3"]["type"];
		$error3 = $_FILES["pdf_3"]["error"];
		if ((!strstr($tipo3, "pdf")) || $error1 != 0) {
			$resultadoPdf .= "El documento enviado no es de tipo PDF o no ha llegado correctamente.";
		} else {
			/* Se guarda en el directorio correspondiente el documento PDF */
			$nombrePdf3 = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["pdf_3"]["name"]);
			move_uploaded_file($_FILES["pdf_3"]["tmp_name"], "../../pdf_noticias/".$nombrePdf3);
		}
	}
	
	// pdf 4
	if ($_FILES["pdf_4"]["size"] > 0) { 
		$tipo4 = $_FILES["pdf_4"]["type"];
		$error4 = $_FILES["pdf_4"]["error"];
		if ((!strstr($tipo4, "pdf")) || $error1 != 0) {
			$resultadoPdf .= "El documento enviado no es de tipo PDF o no ha llegado correctamente.";
		} else {
			/* Se guarda en el directorio correspondiente el documento PDF */
			$nombrePdf4 = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["pdf_4"]["name"]);
			move_uploaded_file($_FILES["pdf_4"]["tmp_name"], "../../pdf_noticias/".$nombrePdf4);
		}
	}
	
	// pdf 5
	if ($_FILES["pdf_5"]["size"] > 0) { 
		$tipo5 = $_FILES["pdf_5"]["type"];
		$error5 = $_FILES["pdf_5"]["error"];
		if ((!strstr($tipo5, "pdf")) || $error1 != 0) {
			$resultadoPdf .= "El documento enviado no es de tipo PDF o no ha llegado correctamente.";
		} else {
			/* Se guarda en el directorio correspondiente el documento PDF */
			$nombrePdf5 = str_replace($caracteresProhibidos, $caracteresSustitutos, $_FILES["pdf_5"]["name"]);
			move_uploaded_file($_FILES["pdf_5"]["tmp_name"], "../../pdf_noticias/".$nombrePdf5);
		}
	}
	
		
	/* Se define la consulta SQL */
	$fecha_de_edicion = date("Y-m-d");
	$usuario_de_edicion = $_SESSION["id_de_usuario"];
	
	$consulta = "UPDATE maestro_de_noticias ";
	$consulta .= "SET titulo_de_noticia=:tituloDeNoticia, id_de_seccion=:idDeSeccion, cuerpo_de_noticia=:cuerpoDeNoticia, imagen_de_noticia=:imagenDeNoticia, ";
	$consulta .= "portada_de_noticia=:portadaDeNoticia, destacado_de_noticia=:destacadoDeNoticia, estado_de_noticia=:estadoDeNoticia, ";
	$consulta .= "boletin_de_noticia=:boletinDeNoticia, autor_de_noticia=:autorDeNoticia, ";
	$consulta .= "keywords_de_noticia=:keywordsDeNoticia, fecha_de_edicion=:fechaDeEdicion, usuario_de_edicion=:usuarioDeEdicion, ";
	$consulta .= "pdf=:pdf1, pdf2=:pdf2, pdf3=:pdf3, pdf4=:pdf4, pdf5=:pdf5, ";
	$consulta .= "nombreDePdf=:nombreDePdf1, nombreDePdf2=:nombreDePdf2, nombreDePdf3=:nombreDePdf3, nombreDePdf4=:nombreDePdf4, nombreDePdf5=:nombreDePdf5 ";
	$consulta .= "WHERE id_de_noticia=:idDeNoticia;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":tituloDeNoticia", $nombre_de_noticia); 
	$hacerConsulta->bindParam(":idDeSeccion", $id_de_seccion); 
	$hacerConsulta->bindParam(":cuerpoDeNoticia", $cuerpo_de_noticia); 
	$hacerConsulta->bindParam(":imagenDeNoticia", $nombreDeImagen); 
	$hacerConsulta->bindParam(":portadaDeNoticia", $portada_de_noticia); 
	$hacerConsulta->bindParam(":destacadoDeNoticia", $destacado_de_noticia); 
	$hacerConsulta->bindParam(":boletinDeNoticia", $boletin_de_noticia); 
	$hacerConsulta->bindParam(":estadoDeNoticia", $estado_de_noticia); 
	$hacerConsulta->bindParam(":autorDeNoticia", $autor_de_noticia); 
	$hacerConsulta->bindParam(":keywordsDeNoticia", $keywords_de_noticia); 
	$hacerConsulta->bindParam(":fechaDeEdicion", $fecha_de_edicion); 
	$hacerConsulta->bindParam(":usuarioDeEdicion", $usuario_de_edicion);
	$hacerConsulta->bindParam(":pdf1", $nombrePdf1);
	$hacerConsulta->bindParam(":pdf2", $nombrePdf2);
	$hacerConsulta->bindParam(":pdf3", $nombrePdf3);
	$hacerConsulta->bindParam(":pdf4", $nombrePdf4);
	$hacerConsulta->bindParam(":pdf5", $nombrePdf5);
	$hacerConsulta->bindParam(":nombreDePdf1", $nombre_de_pdf_1);
	$hacerConsulta->bindParam(":nombreDePdf2", $nombre_de_pdf_2);
	$hacerConsulta->bindParam(":nombreDePdf3", $nombre_de_pdf_3);
	$hacerConsulta->bindParam(":nombreDePdf4", $nombre_de_pdf_4);
	$hacerConsulta->bindParam(":nombreDePdf5", $nombre_de_pdf_5);
	$hacerConsulta->bindParam(":idDeNoticia", $id_de_noticia); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
		
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
    <!-- Ckeditor -->
    <script src="../includes/ckeditor/ckeditor.js"></script>  
      
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
                <h3>Editar post del blog: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
											<div class="row">
												<div class="col-md-2 col-sm-4 col-xs-12">.<img src="../imagenes/info.jpg" alt="info" class="img-rounded"></div>
												<div class="col-md-10 col-sm-8 col-xs-12">
													<br />
													<?php echo "<h2>Se ha grabado correctamente el post del blog.</h2>"; ?>
												</div>
											</div>
											<div class="row">
												<br /><br /><br />&nbsp;&nbsp;<a href="<?php echo $paginaDeRetorno; ?>" class="btn btn-primary">Aceptar</a>
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
    <script src="../vendors/validator/validator.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->

  </body>
</html>