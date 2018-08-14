<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	include_once ("../includes/funciones_auxiliares.php"); //Se incluyen las funciones auxiliares, una sola vez.
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la propiedad de la galeria para poder ubicar las imagnes en la bd */
	$galeriaPropietaria = "maestro_de_catalogo";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "editar_articulo.php";
	
	/* Se recogen la variables que vienen del formulario anterior */
	$id_de_articulo = $_POST["id_de_articulo"];
	$alt_de_imagen = $_POST["alt_de_imagen"];
	$descripcion_de_imagen = $_POST["descripcion_de_imagen"];
	
	/* La variable $erroresEnImagen almacena la lista de los fallos que se veyan reconociendo en los datos enviados en el formulario. */
	$nombreDeArchivo = getRandomString(6, 12, "x");
	$erroresEnImagen = "";
	if ($_FILES["nueva_imagen"]["size"] == 0){
		$erroresEnImagen .= "No se ha enviado el archivo de imagen.<br /><br />";
	} elseif ($_FILES["nueva_imagen"]["size"] > 5000000){
		$erroresEnImagen .= "El archivo enviado como imagen es demasiado grande.<br /><br />";
	}
	if ((!strpos($_FILES["nueva_imagen"]["type"], "gif")) && (!strpos($_FILES["nueva_imagen"]["type"], "jp"))){
		$erroresEnImagen .= "El tipo de imagen no es adecuado.<br /><br />";
	}
	if ($_FILES["nueva_imagen"]["error"] != 0){
		$erroresEnImagen .= "Se ha producido un error en el env&iacute;o de la imagen.<br /><br />";
	}
	if ($erroresEnImagen == ""){
		list($anchura, $altura) = getimagesize($_FILES["nueva_imagen"]["tmp_name"]); // Las dimensiones originales.
		if ($anchura > 1024 || $altura > 1024) $erroresEnImagen = "La imagen es demasiado grande.<br /><br />";
	}
	/* Si se han producido errores, se muestran los mensajes oportunos y no se hacen mas operaciones. */
	if ($erroresEnImagen != ""){
		$resultado = $erroresEnImagen;
	} else {
	/* Si no se han producido errores se determina el tipo de imagen que es y se graba en el disco. */
		if (strpos($_FILES["nueva_imagen"]["type"],"gif")){
			$nombreDeImagen = $nombreDeArchivo.".gif";
			$nombreDeMini = $nombreDeArchivo."Mini.gif";
			$original = imagecreatefromgif($_FILES["nueva_imagen"]["tmp_name"]);
			imagegif($original, "../../images/galeria/fotos/".$nombreDeImagen);
		} else {
			$nombreDeImagen = $nombreDeArchivo.".jpg";
			$nombreDeMini = $nombreDeArchivo."Mini.jpg";
			$original = imagecreatefromjpeg($_FILES["nueva_imagen"]["tmp_name"]);
			imagejpeg($original, "../../images/galeria/fotos/".$nombreDeImagen);
		}
	/* Se estima que la anchura mas grande debera ser como mucho de 70 y la altura de 70 para la miniatura.
	Si se superan estaas medidas, se recalculan unas nuevas dimensiones, manteniendo la proporción.*/
		if ($anchura>70){
			$coeficiente = ($anchura/70);
			$nuevaAnchura = (int)($anchura/$coeficiente);
			$nuevaAltura = (int)($altura/$coeficiente);
		} else {
			$nuevaAnchura = $anchura;
			$nuevaAltura = $altura;
		}
		if ($nuevaAltura>70){
			$coeficiente = ($nuevaAltura/70);
			$nuevaAnchura = (int)($nuevaAnchura/$coeficiente);
			$nuevaAltura = (int)($nuevaAltura/$coeficiente);
		}
		$escalada = imagecreatetruecolor($nuevaAnchura, $nuevaAltura);
		imagecopyresampled($escalada, $original, 0, 0, 0, 0, $nuevaAnchura, $nuevaAltura, $anchura, $altura);
		if (strpos($_FILES["nueva_imagen"]["type"],"gif")){
			imagegif($escalada, "../../images/galeria/fotos/".$nombreDeMini);
		} else {
			imagejpeg($escalada, "../../images/galeria/fotos/".$nombreDeMini);
		}
		// Ahora se genera la consulta para grabar las fotos del articulo.
			$fecha_de_creacion = date("Y-m-d");
			$usuario_de_creacion = $_SESSION["id_de_usuario"];
			$consulta = "INSERT INTO maestro_de_imagenes (";
			$consulta .= "id_de_elemento, galeria_propietaria, nombre_de_foto, nombre_de_mini, alt_de_imagen, descripcion_de_imagen, ";
			$consulta .= "fecha_de_creacion, usuario_de_creacion";
			$consulta .= ") VALUES (";
			$consulta .= ":idDeArticulo, :galeriaPropietaria, :nombreDeFoto, :miniDeFoto, :altDeImagen, :miniDeImagen, ";
			$consulta .= ":fechaDeCreacion, :usuarioDeCreacion);";
			$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
			$hacerConsulta->bindParam(":idDeArticulo", $id_de_articulo); 
			$hacerConsulta->bindParam(":galeriaPropietaria", $galeriaPropietaria); 
			$hacerConsulta->bindParam(":nombreDeFoto", $nombreDeImagen); 
			$hacerConsulta->bindParam(":miniDeFoto", $nombreDeMini); 
			$hacerConsulta->bindParam(":altDeImagen", $alt_de_imagen); 
			$hacerConsulta->bindParam(":miniDeImagen", $descripcion_de_imagen); 
			$hacerConsulta->bindParam(":fechaDeCreacion", $fecha_de_creacion); 
			$hacerConsulta->bindParam(":usuarioDeCreacion", $usuario_de_creacion); 
			$hacerConsulta->execute(); // Se ejecuta la consulta.
			$hacerConsulta->closeCursor(); // Se libera el recurso.
			$resultado = "La imagen se ha grabado correctamente.";
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
    <!-- Ckeditor -->
    <script src="../includes/ckeditor/ckeditor.js"></script>
    <!-- Sceript personalizados -->
    <script language="javascript" type="text/javascript">
	/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
	function retornar(){
		document.getElementById("formRetorno").submit();
	}
    </script>
      
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
                <h3>Nueva imagen</h3>
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
								<?php echo "<h2>".$resultado."</h2>"; ?>
							</div>
						</div>
						<div class="row">
							 <br /><br /><br />&nbsp;&nbsp;<a href="javascript:retornar();" class="btn btn-primary">Aceptar</a>
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
	<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
	<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post">
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
		<input type="hidden" name="id_de_articulo" id="id_de_articulo" value="<?php echo $id_de_articulo; ?>" />
	</form>
  </body>
</html>