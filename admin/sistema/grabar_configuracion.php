<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "configuraci—n.php";
	
	/* Se recogen las variables que vienen de la p‡gina de alta */
	$id_de_sistema = $_POST["id_de_sistema"];
	$valor = htmlentities($_POST["valor"]);
		
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
                <h3>Editar configuraci&oacute;n: grabaci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
	
		<?php
			/* Se define la consulta SQL */
			$consulta = "UPDATE maestro_de_sistema ";
			$consulta .= "SET valor=:valor ";
			$consulta .= "WHERE id_de_sistema=:idDeSistema;";
			$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
			$hacerConsulta->bindParam(":valor", $valor); 
			$hacerConsulta->bindParam(":idDeSistema", $id_de_sistema); 
			$hacerConsulta->execute(); // Se ejecuta la consulta.
			$hacerConsulta->closeCursor(); // Se libera el recurso.
		?>
		    
			<div class="row">
				<div class="col-md-2 col-sm-4 col-xs-12">.<img src="../imagenes/info.jpg" alt="info" class="img-rounded"></div>
				<div class="col-md-10 col-sm-8 col-xs-12">
					<br />
					<?php echo "<h2>Se ha grabado correctamente la configuraci&oacute;n.</h2>"; ?>
				</div>
			</div>
			<div class="row">
                                <br /><br /><br />&nbsp;&nbsp;<a href="configuracion.php" class="btn btn-primary">Aceptar</a>
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
  </body>
</html>