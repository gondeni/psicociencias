<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "editar_trabajo.php";
	
	/* Se recogen la variables que vienen del formulario anterior */
	$id_de_trabajo = $_POST["id_de_trabajo"];
	$id_de_foto = $_POST["id_de_foto"];
	
	/* Se identifica la imagen que hay que eliminar en la bd */
	$matrizDeFotos = array();
	$consulta = "SELECT id_de_foto, nombre_de_foto, nombre_de_mini ";
	$consulta .= "FROM maestro_de_imagenes ";
	$consulta .= "WHERE id_de_foto = :idDeFoto;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeFoto", $id_de_foto); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeFotos = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.	
	$foto = $matrizDeFotos["nombre_de_foto"]; 
	$mini = $matrizDeFotos["nombre_de_mini"]; 
	
	/* Se traslada las imagenes a una carpeta llamada papelera. */
	$ruta_de_origen = "../../images/galeria/fotos/";
	$ruta_de_destino = "../../images/galeria/papelera/";
	$nombre_de_foto = $ruta_de_origen.$foto;
	$nombre_de_mini = $ruta_de_origen.$mini;
	$nombre_de_destino_de_foto = $ruta_de_destino.$foto;
	$nombre_de_destino_de_mini= $ruta_de_destino.$mini;
	@copy ($nombre_de_foto, $nombre_de_destino_de_foto);
	@copy ($nombre_de_mini, $nombre_de_destino_de_mini);
	@unlink($nombre_de_foto);	
	@unlink($nombre_de_mini);	
	
	/* Se marca el resgitro de la base de datos como inactico (papelera) */
	$consulta = "UPDATE maestro_de_imagenes ";
	$consulta .= "SET estado_de_imagen=:estadoDeImagen ";
	$consulta .= "WHERE id_de_foto=:idDeFoto;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":estadoDeImagen", "I"); 
	$hacerConsulta->bindParam(":idDeFoto", $id_de_foto); 
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
                <h3>Eliminaci&oacute;n de imagen</h3>
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
					<?php echo "<h2>La imagen se ha borrado correctamente.</h2>"; ?>
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
		<input type="hidden" name="id_de_trabajo" id="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>" />
	</form>
  </body>
</html>