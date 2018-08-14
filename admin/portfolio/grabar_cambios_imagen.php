<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "editar_trabajo.php";
	
	/* Se recogen las variables que vienen por post */
	$id_de_trabajo = $_POST["id_de_trabajo"];
	$id_de_foto = $_POST["id_de_foto"];
	$alt_de_imagen = htmlentities($_POST["alt_de_imagen"]);
	$descripcion_de_imagen = htmlentities($_POST["descripcion_de_imagen"]);
	$imagen_de_portada = $_POST["imagen_de_portada"];
	$estado_de_imagen = $_POST["estado_de_imagen"];	
	$orden_de_imagen = $_POST["orden_de_imagen"];	
		
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
                <h3>Editar imagen: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
	
						<?php
							/* Se define la consulta SQL */
							$consulta = "UPDATE maestro_de_imagenes ";
							$consulta .= "SET alt_de_imagen = :altDeImagen, ";
							$consulta .= "descripcion_de_imagen = :descripcionDeImagen, ";
							$consulta .= "imagen_de_portada = :imagenDePortada, ";
							$consulta .= "estado_de_imagen = :estadoDeImagen, ";
							$consulta .= "orden_de_imagen = :ordenDeImagen ";
							$consulta .= "WHERE id_de_foto = :idDeFoto;";
							$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
							$hacerConsulta->bindParam(":idDeFoto", $id_de_foto); 
							$hacerConsulta->bindParam(":altDeImagen", $alt_de_imagen); 
							$hacerConsulta->bindParam(":descripcionDeImagen", $descripcion_de_imagen);
							$hacerConsulta->bindParam(":imagenDePortada", $imagen_de_portada);
							$hacerConsulta->bindParam(":estadoDeImagen", $estado_de_imagen);
							$hacerConsulta->bindParam(":ordenDeImagen", $orden_de_imagen);
							$hacerConsulta->execute(); // Se ejecuta la consulta.
							$hacerConsulta->closeCursor(); // Se libera el recurso.

						?>
		    
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">.<img src="../imagenes/info.jpg" alt="info" class="img-rounded"></div>
							<div class="col-md-10 col-sm-8 col-xs-12">
								<br />
								<?php echo "<h2>Se han grabado correctamente los cambios en la im&aacute;gen.</h2>"; ?>
							</div>
						</div>
						
						<div class="row">&nbsp;</div>
						
						<div class="row">
							<form action="editar_trabajo.php" name="formularioDeSalto" id="formularioDeSalto" method="post">
								<input type="hidden" name="id_de_trabajo" id="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>" />
								<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
								<button type="submit" class="btn btn-success">Aceptar</button>
							</form>
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
	
  </body>
</html>