<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "editar_trabajo.php";
	
	/* Se recogen las variables que vienen de la p‡gina de alta */
	$nombre_de_trabajo = htmlentities($_POST["nombre_de_trabajo"]);
	$id_de_seccion = $_POST["id_de_seccion"];
	$kcliente_de_trabajo = $_POST["cliente_de_trabajo"];
	$descripcion_de_trabajo = $_POST["descripcion_de_trabajo"];
	$estado_de_trabajo = $_POST["estado_de_trabajo"];
	$orden_de_trabajo = $_POST["orden_de_trabajo"];
	$keywords_de_trabajo = $_POST["keywords_de_trabajo"];
		
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
                <h3>Nuevo trabajo del portfolio: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
	
					<?php
						/* Se inserta el resgitro en la bd */
						$fecha_de_creacion = date("Y-m-d");
						$usuario_de_creacion = $_SESSION["id_de_usuario"];
						$consulta = "INSERT INTO maestro_de_portfolio (";
						$consulta .= "nombre_de_trabajo, id_de_seccion, cliente_de_trabajo, descripcion_de_trabajo, ";
						$consulta .= "estado_de_trabajo, orden_de_trabajo, keywords_de_trabajo, fecha_de_creacion, usuario_de_creacion";
						$consulta .= ") VALUES (";
						$consulta .= ":nombreDeTrabajo, :idDeSeccion, :clienteDeTrabajo, :descripcionDeTrabajo, ";
						$consulta .= ":estadoDeTrabajo, :ordenDeTrabajo, :keywordsDeTrabajo, :fechaDeCreacion, :usuarioDeCreacion);";
						$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
						$hacerConsulta->bindParam(":nombreDeTrabajo", $nombre_de_trabajo); 
						$hacerConsulta->bindParam(":idDeSeccion", $id_de_seccion); 
						$hacerConsulta->bindParam(":clienteDeTrabajo", $kcliente_de_trabajo); 
						$hacerConsulta->bindParam(":descripcionDeTrabajo", $descripcion_de_trabajo); 
						$hacerConsulta->bindParam(":estadoDeTrabajo", $estado_de_trabajo); 
						$hacerConsulta->bindParam(":ordenDeTrabajo", $orden_de_trabajo); 
						$hacerConsulta->bindParam(":keywordsDeTrabajo", $keywords_de_trabajo); 
						$hacerConsulta->bindParam(":fechaDeCreacion", $fecha_de_creacion); 
						$hacerConsulta->bindParam(":usuarioDeCreacion", $usuario_de_creacion); 
						$hacerConsulta->execute(); // Se ejecuta la consulta.
						$hacerConsulta->closeCursor(); // Se libera el recurso.
						
						/* Se recupera el id del trabajo guardado para poder acceder a su edicion y a–adir imagnes y dem‡s */
						$consulta = "SELECT id_de_trabajo ";
						$consulta .= "FROM maestro_de_portfolio ";
						$consulta .= "ORDER BY id_de_trabajo DESC;";
						$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
						$hacerConsulta->execute(); // Se ejecuta la consulta.
						$matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
						$hacerConsulta->closeCursor(); // Se libera el recurso.
						
						/* Ahora vamos a la pagina de edicion con el registro reciuen guardado */
						$id_de_trabajo = $matriz["id_de_trabajo"];
									
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
						&nbsp;&nbsp;<a href="portfolio.php" class="btn btn-success">Aceptar</a>
						&nbsp;&nbsp;<a href="javascript:retornar();" class="btn btn-primary">Insertar im&aacute;genes</a>
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
	
    <script>
		/* Scripts personalizados */
		// La siguiente funcion se ejecutara si se pulsa el boton Cancelar
		function retornar(){
			document.getElementById("formRetorno").submit();
		}
    </script>
    
	<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
	<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post" >
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
		<input type="hidden" name="id_de_trabajo" id="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>" />
	</form>
  </body>
</html>