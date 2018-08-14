<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    
    /* Se establece la página de retorno */
    $paginaDeRetorno = "usuarios.php";
    
    /* Se recoge el id de la seccion a eliminar */
    $id_de_usuario = $_POST["id_de_usuario"];


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
    <!-- Scripts personalizados -->
    <script language="javascript" type="text/javascript">
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
                <h3>Eliminar usuario</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
		    
		    <?php
			/* No se permite borrar al usuario id=1 */
			if ($id_de_usuario != 1) {
				$consulta = "DELETE FROM maestro_de_usuarios ";
				$consulta .= "WHERE id_de_usuario=:idDeUsuario;";
				$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
				$hacerConsulta->bindParam(":idDeUsuario", $id_de_usuario); 
				$hacerConsulta->execute(); // Se ejecuta la consulta.
				$hacerConsulta->closeCursor(); // Se libera el recurso.
				$resultado = "<h2>Se ha eliminado correctamente el usuario.</h2>";
			} else {
				$resultado = "<h2>El usuario root no puede ser borrado del sistema.</h2>";
			}
		    ?>		    
		    
		    <div class="row">
			<div class="col-md-2 col-sm-4 col-xs-12">.<img src="../imagenes/info.jpg" alt="info" class="img-rounded"></div>
			<div class="col-md-10 col-sm-8 col-xs-12">
				<br />
				<?php echo $resultado; ?>
			</div>
		    </div>
		    <div class="row">
			    <br /><br /><br />&nbsp;&nbsp;<a href="usuarios.php" class="btn btn-primary">Aceptar</a>
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
    <form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post">
	    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
    </form>
    <!-- /El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
    </form>
  </body>
</html>