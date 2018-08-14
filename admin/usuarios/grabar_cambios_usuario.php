<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	include_once ("../includes/funciones_auxiliares.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "usuarios.php";
	
	/* Se recogen las variables que vienen de la p‡gina de alta. */
	$id_de_usuario = $_POST["id_de_usuario"];
	$nombre_de_usuario = $_POST["nombre_de_usuario"];
	$apellidos_de_usuario = $_POST["apellidos_de_usuario"];
	$tipo_de_usuario = $_POST["tipo_de_usuario"];
	$login_de_usuario = str_replace("'", "«", $_POST["login_de_usuario"]);
	$password_de_usuario = codificaClave($_POST["password_de_usuario"]);
	$estado_de_usuario = $_POST["estado_de_usuario"];
	
	/* Se define la consulta SQL */
	$consulta = "UPDATE maestro_de_usuarios ";
	$consulta .= "SET nombre_de_usuario=:nombreDeUsuario, apellidos_de_usuario=:apellidosDeUsuario, tipo_de_usuario=:tipoDeUsuario, ";
	$consulta .= "login_de_usuario=:loginDeUsuario, password_de_usuario=:passDeUsuario, estado_de_usuario=:estadoDeUsuario ";
	$consulta .= "WHERE id_de_usuario=:idDeUsuario;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":nombreDeUsuario", $nombre_de_usuario); 
	$hacerConsulta->bindParam(":apellidosDeUsuario", $apellidos_de_usuario);
	$hacerConsulta->bindParam(":tipoDeUsuario", $tipo_de_usuario); 
	$hacerConsulta->bindParam(":loginDeUsuario", $login_de_usuario); 
	$hacerConsulta->bindParam(":passDeUsuario", $password_de_usuario); 
	$hacerConsulta->bindParam(":estadoDeUsuario", $estado_de_usuario); 
	$hacerConsulta->bindParam(":idDeUsuario", $id_de_usuario); 
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
    <!-- Scripts personalizados -->
    <script language="javascript" type="text/javascript">
	function inicializar(){
	}
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
                <h3>Editar usuario: grabaci&oacute;n</h3>
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
					<?php echo "<h2>Se ha grabado correctamente el usuario.</h2>"; ?>
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