<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "catalogo.php";
	
	/* Se recogen las variables que vienen de la p‡gina de alta */
	$id_de_articulo = $_POST["id_de_articulo"];
	$nombre_de_articulo = htmlentities($_POST["nombre_de_articulo"]);
	$id_de_seccion = $_POST["id_de_seccion"];
	$descripcion_de_articulo = $_POST["descripcion_de_articulo"];
	$precio_de_articulo = $_POST["precio_de_articulo"];
	if (isset($_POST["articulo_destacado"]) && $_POST["articulo_destacado"] == "on") {
		$articulo_destacado = "S";
	} else {
		$articulo_destacado = "N";
	}
	$estado_de_articulo = $_POST["estado_de_articulo"];
	$keywords_de_articulo = $_POST["keywords_de_articulo"];
		
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
                <h3>Editar art&iacute;culo del cat&aacute;logo: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
	
		<?php
			/* Se define la consulta SQL */
			$fecha_de_edicion = date("Y-m-d");
			$usuario_de_edicion = $_SESSION["id_de_usuario"];
			
			$consulta = "UPDATE maestro_de_catalogo ";
			$consulta .= "SET nombre_de_articulo=:nombreDeArticulo, id_de_seccion=:idDeSeccion, descripcion_de_articulo=:descripcionDeArticulo, ";
			$consulta .= "precio_de_articulo=:precioDeArticulo, articulo_destacado=:articuloDestacado, estado_de_articulo=:estadoDeArticulo, ";
			$consulta .= "keywords_de_articulo=:keywordsDeArticulo, fecha_de_edicion=:fechaDeEdicion, usuario_de_edicion=:usuarioDeEdicion ";
			$consulta .= "WHERE id_de_articulo=:idDeArticulo;";
				
			$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
			$hacerConsulta->bindParam(":idDeArticulo", $id_de_articulo); 
			$hacerConsulta->bindParam(":nombreDeArticulo", $nombre_de_articulo); 
			$hacerConsulta->bindParam(":idDeSeccion", $id_de_seccion);
			$hacerConsulta->bindParam(":descripcionDeArticulo", $descripcion_de_articulo);
			$hacerConsulta->bindParam(":precioDeArticulo", $precio_de_articulo);
			$hacerConsulta->bindParam(":articuloDestacado", $articulo_destacado);
			$hacerConsulta->bindParam(":estadoDeArticulo", $estado_de_articulo); 
			$hacerConsulta->bindParam(":keywordsDeArticulo", $keywords_de_articulo); 
			$hacerConsulta->bindParam(":fechaDeEdicion", $fecha_de_edicion); 
			$hacerConsulta->bindParam(":usuarioDeEdicion", $usuario_de_edicion); 
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
                                <br /><br /><br />&nbsp;&nbsp;<a href="catalogo.php" class="btn btn-primary">Aceptar</a>
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